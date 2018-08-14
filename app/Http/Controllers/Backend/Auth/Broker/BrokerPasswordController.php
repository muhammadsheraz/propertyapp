<?php

namespace App\Http\Controllers\Backend\Auth\Broker;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserPasswordRequest;

/**
 * Class UserPasswordController.
 */
class BrokerPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        return view('backend.auth.broker.change-password')
            ->withUser($user);
    }

    /**
     * @param User                      $user
     * @param UpdateUserPasswordRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $userRepository = new UserRepository();
		
        $userRepository->updatePassword($user, $request->only('password'));

        return redirect()->route('admin.auth.broker.index')->withFlashSuccess(__('alerts.backend.brokers.updated_password'));
    }
}
