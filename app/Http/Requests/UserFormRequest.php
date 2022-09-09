<?php

namespace App\Http\Requests;

use App\Rules\StrMustContain;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'middle_name' => 'nullable|max:255|regex:/^([^0-9]*)$/',
            'last_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'course_id' => 'required|integer',
            'stud_num' => ['required', 'unique:users,stud_num', 'max:15', new StrMustContain('TG')],
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'role_as' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'stud_num.unique' => 'The student number has already been taken.',
            'course_id.required' => 'Please select a course.',
        ];
    }
}
