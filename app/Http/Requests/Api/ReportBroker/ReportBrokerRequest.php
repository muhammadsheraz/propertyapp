<?php

namespace App\Http\Requests\Api\ReportBroker;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ReportBrokerRequest.
 */
class ReportBrokerRequest extends FormRequest
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
            'broker_id' => 'required',
            'broker_name' => 'required',
            'message' => 'required',
        ];
    }
}
