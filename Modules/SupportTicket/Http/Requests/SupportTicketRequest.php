<?php

namespace Modules\SupportTicket\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportTicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'subject'=>'required|max:255',
            'priority'=>'required|max:255',
            'message'=>'required',
        ];

        return $rules;

    }

    public function messages(): array
    {
        return [
            'subject.required' => trans('Subject is required'),
            'priority.required' => trans('Priority is required'),
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
