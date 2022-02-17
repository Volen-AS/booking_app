<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRegistrationRequest extends FormRequest
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
                'first_name' => ['required', 'string', 'min:3', 'max:128'],
                'middle_name' => ['required', 'string', 'min:3', 'max:128'],
                'last_name' => ['required', 'string', 'min:3', 'max:128'],
                'birth_date' => ['required', 'string'],
                'phone' =>['required', 'string', 'max:32', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];
    }
}
