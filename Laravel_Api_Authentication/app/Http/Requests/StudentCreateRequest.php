<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'majors' => ['required', 'max:255'],
            'phone' => ['required', 'max:100'],
            'email' => ['required', 'max:255', 'email', 'unique:students,email', [ 'email.unique' => 'This email address is already in use.']],
            'address' => ['required', 'max:225'],
        ];
    }
}
