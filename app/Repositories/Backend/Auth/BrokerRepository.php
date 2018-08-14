<?php

namespace App\Repositories\Backend\Auth;

use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Events\Frontend\Auth\UserConfirmed;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Events\Backend\Auth\User\UserRestored;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Events\Backend\Auth\User\UserUnconfirmed;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Notifications\Backend\Auth\UserAccountActive;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Notifications\Backend\Auth\UserAccountCreated;
use App\Notifications\Backend\Auth\UserAccountInActive;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Notifications\Backend\Auth\BrokerAccountUpdate;

/**
 * Class UserRepository.
 */
class BrokerRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return mixed
     */
    public function getUnconfirmedCount() : int
    {
        return $this->model
            ->where('confirmed', 0)
            ->count();
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data, $image = false) : User
    {
        return DB::transaction(function () use ($data, $image) {
            $user = parent::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'city_id' => $data['city_id'],
                'district_id' => $data['district_id'],
                'nearest_landmark' => array_get($data, 'nearest_landmark', ''),
                'company_name' => $data['company_name'],
                'tax_no' => $data['tax_no'],
                'phone_no' => array_get($data, 'phone_no', ''),
                'mobile_no' => array_get($data, 'mobile_no', ''),
                'avatar_type' => array_get($data, 'avatar_type', ''),
                'timezone' => $data['timezone'],
                'password' => Hash::make($data['password']),
                'active' => isset($data['active']) && $data['active'] == '1' ? 1 : 0,
                'property_limit' => isset($data['property_limit']) ? $data['property_limit'] : 15,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'commission_sale_landlord' => array_get($data, 'commission_sale_landlord', 0),
                'commission_sale_buyer' => array_get($data, 'commission_sale_buyer', 0),
                'commission_rent_landlord' => array_get($data, 'commission_rent_landlord', 0),
                'commission_rent_tenant' => array_get($data, 'commission_rent_tenant', 0),                
                'confirmed' => isset($data['confirmed']) && $data['confirmed'] == '1' ? 1 : 0,
                'is_default' => isset($data['is_default']) && $data['is_default'] == '1' ? 1 : 0,
            ]);

            // See if adding any additional permissions
            if (! isset($data['permissions']) || ! count($data['permissions'])) {
                $data['permissions'] = [];
            }

            if ($user) {
                ## Generating and Saving Broker No 
                $broker_no = 'B' . str_pad($user->id,config('app.broker_no_padding_size'),"0",STR_PAD_LEFT);
                $user->broker_no = $broker_no;
                
                ## Saving Avatar Image/Profile Photo
                $user->avatar_type = $data['avatar_type'];
                if ($image) {
                    $user->avatar_location = $image->store('/avatars', 'public');
                }
                
                $user->save();
                // User must have at least one role
                if (! count($data['roles'])) {
                    throw new GeneralException(__('exceptions.backend.access.users.role_needed_create'));
                }

                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);

                //Send confirmation email if requested and account approval is off
                // if (isset($data['confirmation_email']) && $user->confirmed == 0 && ! config('access.users.requires_approval')) {
                //     $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                // }
                ## Admin Notification
                // $administrator = User::role('administrator')->get();
                // \Notification::send($administrator, new UserAccountCreated($user));

                ## User Notification
                // $user->notify(new UserAccountCreated($user));


                event(new UserCreated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @return User
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(User $user, array $data, $image = false) : User
    {
        $this->checkUserByEmail($user, $data['email']);
        
        // See if adding any additional permissions
        if (! isset($data['permissions']) || ! count($data['permissions'])) {
            $data['permissions'] = [];
        }

        ## Sending Notification
        // if (!empty($data['active'])) {
        //     if ($user->active != $data['active']) {
        //         ## Notification for User itself
        //         $user->notify(new UserAccountActive($user));

        //         $administrator = User::role('administrator')->get();
        //         \Notification::send($administrator, new UserAccountActive($user));              
        //     }
        // } else {
        //     if (!empty($user->active) AND !isset($data['active'])) {
        //         ## Notification for User itself
        //         $user->notify(new UserAccountInActive($user));

        //         $administrator = User::role('administrator')->get();
        //         \Notification::send($administrator, new UserAccountInActive($user)); 
        //     }                         
        // }
        
        return DB::transaction(function () use ($user, $data, $image) {
            $user_data = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'active' => isset($data['active']) && $data['active'] == '1' ? 1 : 0,
                'confirmed' => isset($data['active']) && $data['active'] == '1' ? 1 : 0, ## Confirmed field is changing along with active
                'is_default' => isset($data['is_default']) && $data['is_default'] == '1' ? 1 : 0,
                'timezone' => $data['timezone'],
                'city_id' => $data['city_id'],
                'district_id' => $data['district_id'],
                'nearest_landmark' => array_get($data, 'nearest_landmark', ''),
                'company_name' => $data['company_name'],
                'tax_no' => $data['tax_no'],
                'phone_no' => array_get($data, 'phone_no', ''),
                'mobile_no' => array_get($data, 'mobile_no', ''),
                'contract_confirmed' => array_get($data, 'contract_confirmed', 0),
                'property_limit' => isset($data['property_limit']) ? $data['property_limit'] : 15,
                'commission_sale_landlord' => array_get($data, 'commission_sale_landlord', 0),
                'commission_sale_buyer' => array_get($data, 'commission_sale_buyer', 0),
                'commission_rent_landlord' => array_get($data, 'commission_rent_landlord', 0),
                'commission_rent_tenant' => array_get($data, 'commission_rent_tenant', 0),
                'avatar_type' => array_get($data, 'avatar_type', ''),
            ];

            if (!empty($data['contract_confirmed']) AND empty($user->contract_confirmed)) {
                $user_data['contract_confirmed_at'] = date('Y-m-d H:i:s');
            }

            if (!empty($data['active']) AND empty($user->active)) {
                $user_data['activated_at'] = date('Y-m-d H:i:s');
            }

            if ($user->update($user_data)) {
                ## Saving Avatar Image/Profile Photo
                if ($image) {
                    $user->avatar_location = $image->store('/avatars', 'public');
                }
                
                $user->save();  

                // Add selected roles/permissions
                $user->syncRoles($data['roles']);
                $user->syncPermissions($data['permissions']);

                event(new UserUpdated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * @param User $user
     * @param      $input
     *
     * @return User
     * @throws GeneralException
     */
    public function updatePassword(User $user, $input) : User
    {
        $user->password = Hash::make($input['password']);

        if ($user->save()) {
            event(new UserPasswordChanged($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param User $user
     * @param      $status
     *
     * @return User
     * @throws GeneralException
     */
    public function mark(User $user, $status) : User
    {
        if (auth()->id() == $user->id && $status == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->active = $status;

        switch ($status) {
            case 0:
                event(new UserDeactivated($user));
            break;

            case 1:
                event(new UserReactivated($user));
            break;
        }

        if ($user->save()) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function confirm(User $user) : User
    {
        if ($user->confirmed == 1) {
            throw new GeneralException(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->active = 1;
        $user->confirmed = 1;
        $confirmed = $user->save();

        if ($confirmed) {
            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('access.users.requires_approval')) {
                $user->notify(new UserAccountActive($user));

                $administrator = User::role('administrator')->get();
                \Notification::send($administrator, new UserAccountActive($user));                              
            }

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_confirm'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function unconfirm(User $user) : User
    {

        if ($user->confirmed == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.not_confirmed'));
        }

        if ($user->id == 1) {
            // Cant un-confirm admin
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_admin'));
        }

        if ($user->id == auth()->id()) {
            // Cant un-confirm self
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_self'));
        }

        $user->active = 0;
        $user->confirmed = 0;
        $unconfirmed = $user->save();

        if ($unconfirmed) {
            event(new UserUnconfirmed($user));

            $user->notify(new UserAccountInActive($user));

            $administrator = User::role('administrator')->get();
            \Notification::send($administrator, new UserAccountInActive($user));   

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(User $user) : User
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($user) {
            // Delete associated relationships
            $user->providers()->delete();

            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(User $user) : User
    {
        if (is_null($user->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param User $user
     * @param      $email
     *
     * @throws GeneralException
     */
    protected function checkUserByEmail(User $user, $email)
    {
        //Figure out if email is not the same
        if ($user->email != $email) {
            //Check to see if email exists
            if ($this->model->where('email', '=', $email)->first()) {
                throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
            }
        }
    }
}
