<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketValidator extends FormRequest
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
            'subject' => 'required|min:3',
            'description' => 'required|min:10',
            'assignee' => 'required|integer',
            'contact' => 'required|email',
            'deadline' => 'nullable|date',
            'priority' => 'required',
        ];
    }
}
