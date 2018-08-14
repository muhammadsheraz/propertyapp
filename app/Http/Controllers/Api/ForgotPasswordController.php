<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\PasswordResetCode;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Requests\Api\User\UpdateProfileRequest;

use App\Mail\Api\PasswordReset\ResetCodeSend;
use Illuminate\Support\Facades\Mail;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends ApiController
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyEmail(Request $request)
    {
        try {
            $this->validateEmail($request);

            $customer = User::where('email', $request->input('email'))->first();
            
            
            if (!empty($customer)) {
                $reset_code = rand(1000,9999);
                $email = $customer->email;
                $messages = __('strings.backend.emails.messages.password_reset_code', ['code'=>$reset_code]);
                $subject = __('strings.backend.emails.subject.password_reset_code');

                ## Removing all previous codes for this user
                PasswordResetCode::where('user_id', $customer->id)->delete();

                ## Generating new code and Sending email
                $password_reset_code = new PasswordResetCode();
                $password_reset_code->user_id = $customer->id;
                $password_reset_code->code = $reset_code;
                $password_reset_code->created_at = date('Y-m-d H:i:s');
                $password_reset_code->save();

                if ($password_reset_code->save()) {
                    $request->request->add([
                        'reset_code' => $reset_code,
                        'customer' => $customer
                    ]);  

                    Mail::send(new ResetCodeSend($request));

                    $data['messages'] = 'verification code ' . $reset_code . ' has been sent to your email.';
                    $data['status'] = 'success';

                    return response()->json([
                        'data' => $data
                        ], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);                      
                } else {
                    $data['messages'] = 'unable to generate the code';
                    $data['status'] = 'fail';

                    return response()->json([
                        'data' => $data
                        ], 422, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); 
                }          

            }

            $data['messages'] = 'customer not found, either deleted or deactivated';
            $data['status'] = 'error';

            return response()->json([
                'data' => $data
                ], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            $data['messages'] = 'Error occurred: ' . $e->getMessage() . ' at line: ' . $e->getLine();
            $data['status'] = 'error';

            return response()->json([
                'data' => $data
                ], 500, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
    }

    public function verifyCode(Request $request)
    {
        $code = $request->input('verification_code');
        $customer = User::where('email', $request->input('email'))->first();

        $code = PasswordResetCode::where([
            'user_id' => $customer->id,
            'code' => $code,
        ]);

        if ($code->count()) {
            if ($customer) {
                $code->delete();

                $data['messages'] = 'code verified';
                $data['status'] = 'success';

                return response()->json([
                    'data' => $data
                ], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); 
            } else {
                $data['messages'] = 'customer not found, either deleted or deactivated';
                $data['status'] = 'error';
            }
        } else {
            $data['messages'] = 'verification code invalid or already used.';
            $data['status'] = 'error';
        }

        return response()->json([
            'data' => $data
            ], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);        
    }

    public function changePassword(UpdateProfileRequest $request)
    {
        if (!empty($request->input('password')) AND !empty($request->input('email'))) {
            $customer = User::where('email', $request->input('email'))->first();
            $customer->password = \Hash::make($request->input('password'));

            if ($customer->save()) {
                $http = new \GuzzleHttp\Client;
                $response = $http->post(url('/oauth/token'), [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => '8',
                        'client_secret' => 'csn83AHr525auIAHrj1svaVzlSEM3WkDMN5qBWjE',
                        'username' => $customer->email,
                        'password' => $request->input('password'),
                        'email' => $customer->email,
                        'scope' => '*',
                    ],
                ]);

                $auth = json_decode((string) $response->getBody(), true);
                
                $data['token_type'] = $auth['token_type'];
                $data['expires_in'] = $auth['expires_in'];
                $data['access_token'] = $auth['access_token'];
                $data['refresh_token'] = $auth['refresh_token'];

                $data['messages'] = 'password changed successfully';
                $data['status'] = 'success';  

                return response()->json([
                    'data' => $data
                    ], 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); 
            }
        } else {
            $data['messages'] = 'Email and Password are required';
            $data['status'] = 'error';

            return response()->json([
                'data' => $data
                ], 404, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);        
        }  
    }
    
    private function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }    
}
