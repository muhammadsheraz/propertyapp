<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Validation\Rule;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApiRegisterRequest.
 */
class ApiRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'           => 'required|string|max:191',
            'last_name'            => 'required|string|max:191',
            'email'                => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'phone_no'             => ['required', 'string', 'max:25', Rule::unique('users')],
            'password'             => 'required|string|min:6|confirmed',
        ];
    }
}
