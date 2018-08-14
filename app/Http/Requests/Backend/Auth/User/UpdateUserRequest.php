<?php

namespace App\Http\Requests\Backend\Auth\User;
namespace App\Http\Requests\Backend\Auth\Broker;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest.
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:191',
            'first_name'  => 'required|max:191',
            'last_name'  => 'required|max:191',
            'phone_no'   => ['required', 'string', 'max:25', Rule::unique('users')],
            'timezone' => 'required|max:191',
            'roles' => 'required|array',
        ];
    }
}
