<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdate extends FormRequest
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
            'system_title' => 'required|string',
            'system_name' => 'required|string',
            'session_year' => 'required|string',
            'address' => 'required|string',
            'email' => 'sometimes|email:rfc,dns',
            'phone' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            // 'term_ends' => 'required',
            // 'term_begins' => 'required',
            'logo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'system_title.required' => 'System acronym field is required.',
        ];
    }
}
