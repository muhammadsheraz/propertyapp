<?php

namespace App\Models\Auth;

use App\Models\Traits\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\SendUserPasswordReset;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Attribute\BrokerAttribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use Laravel\Passport\HasApiTokens;
use Cmgmyr\Messenger\Traits\Messagable;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use HasRoles,
        Notifiable,
        SendUserPasswordReset,
        SoftDeletes,
        UserAttribute,
        BrokerAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        HasApiTokens,
        Uuid,
        Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broker_no',
        'first_name',
        'last_name',
        'email',
        'phone_no',
        'mobile_no',
        'avatar_type',
        'avatar_location',
        'password',
        'password_changed_at',
        'active',
        'commission_sale_landlord',	
        'commission_sale_buyer',	
        'commission_rent_landlord',	
        'commission_rent_tenant',        
        'confirmation_code',
        'contract_confirmed',
        'contract_confirmed_at',
        'property_limit',
        'activated_at',
        'confirmed',
        'city_id',
        'other_city',
        'district_id',
        'nearest_landmark',
        'company_name',
        'tax_no',
        'is_default',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name'];


    public static function getAllBrokers () {
        $records = User::role('broker');

        if (!auth()->user()->hasRole('administrator')) {
            $records->active();
            $records->confirmed();
        }

        return $records;
    }  

    public static function getAllCustomers () {
        $records = User::role('customer');

        if (!auth()->user()->hasRole('administrator')) {
            $records->active();
            $records->confirmed();
        }

        return $records;
    }  

    public static function getAllBrokersForSelect () {
        $records = self::getAllBrokers()->get();
        $select_data = [];

        if (!empty($records->count())) {
            foreach ($records as $record) {
                $select_data[$record->id] = $record->full_name;
            }
        }

        return $select_data;
    }    

    public static function getAllCustomersForSelect () {
        $records = self::getAllCustomers()->get();
        $select_data = [];

        if (!empty($records->count())) {
            foreach ($records as $record) {
                $select_data[$record->id] = $record->full_name;
            }
        }

        return $select_data;
    }    

    public function getUserData () {
        $user_data = User::find($this->id); 
        $user_data = array_merge($user_data->toArray(), [
            'avatar_abs_url' => !empty($user_data->avatar_location) ? \Storage::url($user_data->avatar_location) : '',
            'contract_file_abs_url' => !empty($user_data->contract_file) ? \Storage::url($user_data->contract_file) : '',
        ]);

        return $user_data;
    }    
}
