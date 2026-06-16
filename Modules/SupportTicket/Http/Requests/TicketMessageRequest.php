<?php

namespace Modules\SupportTicket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'message'=>'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'message.required' => trans('Message is required'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
