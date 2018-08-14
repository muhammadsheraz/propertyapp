<?php

namespace App\Http\Controllers\Backend\Auth\Broker;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Auth\BrokerRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

/**
 * Class UserConfirmationController.
 */
class BrokerConfirmationController extends Controller
{
    /**
     * @var BrokerRepository
     */
    protected $brokerRepository;

    /**
     * @param BrokerRepository $brokerRepository
     */
    public function __construct(BrokerRepository $brokerRepository)
    {
        $this->brokerRepository = $brokerRepository;
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function sendConfirmationEmail(User $user, ManageUserRequest $request)
    {
        // Shouldn't allow users to confirm their own accounts when the application is set to manual confirmation
        if (config('access.users.requires_approval')) {
            return redirect()->back()->withFlashDanger(__('alerts.backend.users.cant_resend_confirmation'));
        }

        if ($user->isConfirmed()) {
            return redirect()->back()->withFlashSuccess(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.users.confirmation_email'));
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function confirm(User $user, ManageUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $this->brokerRepository->confirm($user);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.confirmed'));
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function unconfirm(User $user, ManageUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $this->brokerRepository->unconfirm($user);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.unconfirmed'));
    }
}
