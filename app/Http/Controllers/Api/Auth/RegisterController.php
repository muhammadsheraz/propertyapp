<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Requests\RegisterRequest;
use App\Helpers\Frontend\Auth\Socialite;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Auth\ApiRegisterRequest;
use App\Repositories\Api\Auth\UserRepository;



use Illuminate\Foundation\Auth\AuthenticatesUsers;
/**
 * Class RegisterController.
 */
class RegisterController extends ApiController
{
    use RegistersUsers;

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
     * @param ApiRegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(ApiRegisterRequest $request)
    {
        try {
            $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email', 'phone_no', 'mobile_no', 'password', 'city_id', 'district_id', 'other_city'));
            // $token = $user->createToken("user_" . $user->id .  "_token")->accessToken;
            // if (!empty($user->accessToken)) {

            // }

            // $tokenRequest = Request::create('/oauth/token', 'post', [
            //      "grant_type"     => 'password',
            //      "username"     => $request->input('email'),
            //      "password"     => $request->input('password'),
            //      "client_id"     => $request->input('client_id'),
            //      "client_secret"     => $request->input('client_secret'),
            //      "scope"     => '*',
            // ]);

            // $response = Route::dispatch($tokenRequest);
            
            // If the user must confirm their email or their account requires approval,
            // create the account but don't log them in.
            // if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
                // event(new UserRegistered($user));

                // $administrator = User::role('administrator')->get();
                ## Broker Created
                // \Notification::send($administrator, new BrokerRegistered($user));    
            
                // $request->request->add(['username', $request->input('email')]);
                // $request->request->add(['client_id', '11']);
                // $request->request->add(['client_secret', '6U7QK00mj4lO4o2pmMB3gNLIlNt9bA4M9zAegi9c']);
                // $request->request->add(['grant_type', 'password']);
                // $request->request->add(['scope', '*']);

                
            //     // {"username":"mtpixels@gmail.com","password":"Money123@","client_id":11,"client_secret":"6U7QK00mj4lO4o2pmMB3gNLIlNt9bA4M9zAegi9c","email":"mtpixels@gmail.com","grant_type":"password","scope":"*"}
            // $response = $this->login($request);
            // echo '<pre>'; print_r($response); echo '</pre>'; die;

            $http = new \GuzzleHttp\Client;
            $response = $http->post(url('/oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '8',
                    'client_secret' => 'csn83AHr525auIAHrj1svaVzlSEM3WkDMN5qBWjE',
                    'username' => $request->input('email'),
                    'password' => $request->input('password'),
                    'email' => $request->input('email'),
                    'scope' => '*',
                ],
            ]);
    
            
            // $response = \Route::dispatch($response);  
            $response2 = json_decode((string) $response->getBody(), true);

            // echo '<pre>'; print_r($response->token_type); echo '</pre>'; die;
            // return $response;
            
            return response()->json([
                'data' => [
                    'status'=>'success',
                    'message'=>'customer created',
                    'customer'=>$user->toArray(),
                    'token_type'=> $response2['token_type'],
                    'expires_in'=> $response2['expires_in'],
                    'access_token'=> $response2['access_token'],
                    'refresh_token'=> $response2['refresh_token']
                ]
            ]);	

                // return redirect($this->redirectPath())->withFlashSuccess(
                //     config('access.users.requires_approval') ?
                //         __('exceptions.frontend.auth.confirmation.created_pending') :
                //         __('exceptions.frontend.auth.confirmation.created_confirm')
                // );
            // } else {
            //     auth()->login($user);
            //     event(new UserRegistered($user));
            //     return redirect($this->redirectPath());
            // }
        } catch (\Exception $e) {
            return response()->json([
                'data' => [
                    'status'=>'error',
                    'message'=>$e->getMessage() . ' at ' . $e->getLine(),
                ]
            ]);	
        }
    }

        /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        return $this->sendLoginResponse($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

       /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function messages()
    {
        return [
            'captcha.captcha' => 'This is incorrect',
        ];
    }    

    protected function hasTooManyLoginAttempts(Request $request)
    {
        ## Limiting invalid login attempts upto 3 maximum and locking out session of 60 minutes
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 3, 60
        );
    }    
}
