<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'middle_name' => 'nullable|max:255|regex:/^([^0-9]*)$/',
            'last_name' => 'required|max:255|regex:/^([^0-9]*)$/',
            'contact' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'roles' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $this->id,
            'email' => 'required|email:rfc,dns|unique:users,email,' . $this->id,

        ];
    }
}
