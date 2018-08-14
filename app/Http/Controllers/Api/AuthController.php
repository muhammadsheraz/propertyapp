<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Auth\ApiRegisterRequest;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;

use DB;

class AuthController extends ApiController
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
	}
	
    public function login(Request $request)	{

        
    	return response()->json([
			'data' => [
				'message'=>'success'
			]
        ]);

	}

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(ApiRegisterRequest $request)
    {
        // $this->validate($request);     
		
		$customer_data = $request->only('first_name', 'last_name', 'email', 'phone_no', 'country_id', 'password');
		$customer_data['role'] = 'customer';
		
		$user = $this->userRepository->create($customer_data);

        // If the user must confirm their email or their account requires approval,
		// create the account but don't log them in.
		/*
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            $administrator = User::role('administrator')->get();
            ## Broker Created
            \Notification::send($administrator, new BrokerRegistered($user));            

            return redirect($this->redirectPath())->withFlashSuccess(
                config('access.users.requires_approval') ?
                    __('exceptions.frontend.auth.confirmation.created_pending') :
                    __('exceptions.frontend.auth.confirmation.created_confirm')
            );
        } else {
            auth()->login($user);

            event(new UserRegistered($user));

            return redirect($this->redirectPath());
        }
		*/

    	return response()->json([
			'data' => [
				'message'=>'success',
				'customer'=>$user->toArray()
			]
        ]);		
    }

    public function get_user(Request $request)
    {
        $user = User::findOrFail($request->input('broker_id'));
        
        echo '<pre>'; print_r($user->toArray()); echo '</pre>'; die;

    	return response()->json([
			'data' => [
				'message'=>'success',
				'broker'=>$user->toArray()
			]
        ]);    
    }

}
