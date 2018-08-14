<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Auth\Auth;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\Frontend\Auth\UserSessionRepository;
use Illuminate\Support\Facades\Cache;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Models\Auth\User;

use App\Http\Controllers\ApiController;

/**
 * Class LoginController.
 */
class LoginController extends ApiController
{
    use AuthenticatesUsers;

    protected function validateLogin(Request $request)
    {
        $login_attempt = Cache::get('login_attempt_exceeded');

        // $rule[$this->username()] = 'required|string';
        // $rule['phone_no'] = 'required|string';
        $rule['password'] = 'required|string';
        
        if ( $login_attempt) {
            $this->validate($request, ['captcha' => 'required|captcha']);
        }

        $this->validate($request, $rule);
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        $use_captcha = false;
        $login_attempt = Cache::get('login_attempt_exceeded');

        if ( $login_attempt) {
            $use_captcha = true;
        }

        $data['use_captcha'] = $use_captcha;

        return view('frontend.auth.login', $data)
            ->withSocialiteLinks((new Socialite)->getSocialLinks());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function authenticated(Request $request, $user)
    {

        if (! $user->isCustomer()) {
            auth()->logout();

				return response()->json([
					'data' => [
							'message'=>__('strings.frontend.user.user_role_login_not_allowed'),
							'status'=>'error'
						]
					], 401, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);            

        } elseif (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail
            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['user_uuid' => $user->{$user->getUuidName()}]));
        } elseif (! $user->isActive()) {
            auth()->logout();
            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        Cache::forget('login_attempt_exceeded');
        event(new UserLoggedIn($user));

        // If only allowed one session at a time
        if (config('access.users.single_login')) {
            resolve(UserSessionRepository::class)->clearSessionExceptCurrent($user);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        return response()->json([
			'data' => [
				'status'=>'success',
				'message'=>'POST : At User Logout Endpoint. In progress.'
			]
        ]);	
        /*
         * Remove the socialite session variable if exists
         */
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        /*
         * Remove any session data from backend
         */
        app()->make(Auth::class)->flushTempSession();

        /*
         * Fire event, Log out user, Redirect
         */
        event(new UserLoggedOut($request->user()));

        /*
         * Laravel specific logic
         */
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }


    public function login(Request $request)
    {
        // die('On Login Screen');
        // $this->validateLogin($request);

        // $phone_no = $request->input('phone_no');
        // $record_matched = User::where('phone_no', $phone_no)->first();
        // $email_attr = ['email'=>''];

        // if ($record_matched) {
        //     $email_attr = ['email' => $record_matched->email];
        // }

        // $request->request->add($email_attr);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            
            Cache::add('login_attempt_exceeded', true, 60);

            // return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (! auth()->user()->isCustomer()) {
                auth()->logout();

                    return response()->json([
                        'data' => [
                                'message'=>__('strings.backend.user_role_login_not_allowed'),
                                'status'=>'error'
                            ]
                        ], 401, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);            

            }

            $tokenRequest = Request::create('/oauth/token', 'post');

            $response = \Route::dispatch($tokenRequest);  
            
            return $response;
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }    

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (! auth()->user()) {
            return redirect()->route('frontend.auth.login');
        }

        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            app()->make(Auth::class)->flushTempSession();

            // Re-login admin
            auth()->loginUsingId((int) $admin_id);

            // Redirect to backend user page
            return redirect()->route('admin.auth.user.index');
        } else {
            app()->make(Auth::class)->flushTempSession();

            // Otherwise logout and redirect to login
            auth()->logout();

            return redirect()->route('frontend.auth.login');
        }
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        ## Limiting invalid login attempts upto 3 maximum and locking out session of 60 minutes
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 3, 60
        );
    }    
}
