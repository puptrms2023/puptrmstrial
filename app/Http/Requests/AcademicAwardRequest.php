<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AcademicAwardRequest extends FormRequest
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
        $bannedWords = ['required', 'string', 'max:255', 'regex:/^(?!(?:CIVIC WELFARE TRAINING SERVICE 1|CWTS|NSTP|PHYSICAL FITNESS AND SELF-TESTING ACTIVITIES|RHYTHMIC ACTIVITIES|INDIVIDUAL\/DUAL\/COMBATIVE SPORTS|TEAM SPORTS)$)/i'];
        $commonRules = ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])];

        return [
            'user_id' => 'required',
            'app_id' => 'nullable',
            'subjects.*' => $bannedWords,
            'subjects1.*' => $bannedWords,
            'grades.*' =>  $commonRules,
            'grades1.*' =>  $commonRules,
            'units.*' => 'required|integer|min:1',
            'units1.*' => 'required|integer|min:1',
            'term' => 'required',
            'term1' => 'required',
            'total.*' => 'nullable',
            'total1.*' => 'nullable',
            'year_level' => 'required|string||max:255',
            'image' => 'required|mimes:jpeg,png,jpg',
            'course_id' => 'required|string|max:255',
            'gwa_1st' => 'required',
            'gwa_2nd' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subjects.*.regex' => 'The :input is not allowed',
            'subjects1.*.regex' => 'The :input is not allowed',
            'units.*.min' => 'Enter valid number for units',
            'units1.*.min' => 'Enter valid number for units',
            'units9.*.min' => 'Enter valid number for units',
            'grades.*.lt' => 'Sorry, you have grades lower than 2.50.',
            'grades.*.in' => 'Sorry, you have enter invalid grade input in 1st Semester.',
            'grades1.*.lt' => 'Sorry, you have grades lower than 2.50.',
            'grades1.*.in' => 'Sorry, you have enter invalid grade input in 2nd Semester.',
            'grades9.*.in' => 'Sorry, you have enter invalid grade input in Summer.',
            'grades9.*.lt' => 'Sorry, you have grades lower than 2.50 in Summer.',
            'gwa_1st.required' => 'Field for 1st Semester is required',
            'gwa_2nd.required' => 'Field for 2nd Semester is required',
            'gwa_1st.between' => 'Your 1st Semester GWA did not meet the grade requirement.',
            'gwa_2nd.between' => 'Your 2nd Semester GWA did not meet the grade requirement.',
            'gwa_1st.max' => 'Your 1st Semester GWA did not meet the grade requirement.',
            'gwa_2nd.max' => 'Your 2nd Semester GWA did not meet the grade requirement.',
        ];
    }

    public function withValidator(Validator $validator)
    {
        // $validator->sometimes('gwa_1st', 'required|numeric|max:1.75', function ($input) {
        //     return $input->award_applied == '1';
        // });
        // $validator->sometimes('gwa_2nd', 'required|numeric|max:1.75', function ($input) {
        //     return $input->award_applied == '1';
        // });
        // $validator->sometimes('gwa_1st', 'required|numeric|between:1.00,1.75', function ($input) {
        //     return $input->award_applied == '2';
        // });
        // $validator->sometimes('gwa_2nd', 'required|numeric|between:1.00,1.75', function ($input) {
        //     return $input->award_applied == '2';
        // });
        // $validator->sometimes('gwa_1st', 'required|numeric|between:1.00,1.50', function ($input) {
        //     return $input->award_applied == '3';
        // });
        // $validator->sometimes('gwa_2nd', 'required|numeric|between:1.00,1.50', function ($input) {
        //     return $input->award_applied == '3';
        // });
    }
}
