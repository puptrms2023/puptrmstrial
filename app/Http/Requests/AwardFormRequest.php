<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AwardFormRequest extends FormRequest
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
            'user_id' => 'required',
            'gwa_1st' => 'required',
            'gwa_2nd' => 'required',
            'year_level' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg',
            'award_applied' => 'required|string'
        ];
    }
}
