<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchieversAwardRequest extends FormRequest
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
            'app_id' => 'nullable',
            'subjects.*' => 'required|string',
            'subjects1.*' => 'required|string',
            'school_year' => 'required',
            'grades.*' => 'required|lt:2.50',
            'grades1.*' => 'required|lt:2.50',
            'units.*' => 'required|integer|min:1',
            'units1.*' => 'required|integer|min:1',
            'term' => 'required',
            'term1' => 'required',
            'total.*' => 'nullable',
            'total1.*' => 'nullable',
            'gwa_1st' => 'required|lte:1.75',
            'gwa_2nd' => 'required|lte:1.75',
            'year_level' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg',
            'award_applied' => 'required|string',
            'course_id' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'units.*.min' => 'Enter valid number for units',
            'units1.*.min' => 'Enter valid number for units',
            'grades.*.lt' => 'Sorry, you have grades lower than 2.50.',
            'grades1.*.lt' => 'Sorry, you have grades lower than 2.50.',
            'gwa_1st.required' => 'Field for 1st Semester is required',
            'gwa_2nd.required' => 'Field for 2nd Semester is required',
            'gwa_1st.lte' => 'Your 1st Semester GWA did not meet the grade requirement.',
            'gwa_2nd.lte' => 'Your 2nd Semester GWA did not meet the grade requirement.',
        ];
    }
}
