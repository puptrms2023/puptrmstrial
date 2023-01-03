<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AcademicExcellenceRequest extends FormRequest
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
        $bannedWords1 = ['nullable', 'string', 'max:255', 'regex:/^(?!(?:CIVIC WELFARE TRAINING SERVICE 1|CWTS|NSTP|PHYSICAL FITNESS AND SELF-TESTING ACTIVITIES|RHYTHMIC ACTIVITIES|INDIVIDUAL\/DUAL\/COMBATIVE SPORTS|TEAM SPORTS)$)/i'];
        $commonRules = ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])];
        $commonRules1 = ['nullable', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])];
        return [
            'user_id' => 'required',
            'app_id' => 'nullable',
            'subjects.*' => $bannedWords,
            'subjects1.*' => $bannedWords,
            'subjects3.*' => $bannedWords,
            'subjects4.*' => $bannedWords,
            'subjects5.*' => $bannedWords,
            'subjects6.*' => $bannedWords,
            'subjects7.*' => $bannedWords,
            'subjects8.*' => $bannedWords,
            'subjects9.*' => $bannedWords1,
            'subjects10.*' => $bannedWords1,
            'subjects11.*' => $bannedWords1,
            'grades.*' => $commonRules,
            'grades1.*' => $commonRules,
            'grades3.*' => $commonRules,
            'grades4.*' => $commonRules,
            'grades5.*' => $commonRules,
            'grades6.*' => $commonRules,
            'grades7.*' => $commonRules,
            'grades8.*' => $commonRules,
            'grades9.*' => $commonRules1,
            'grades10.*' => $commonRules1,
            'grades11.*' => $commonRules1,
            'units.*' => 'required|integer|min:1',
            'units1.*' => 'required|integer|min:1',
            'units3.*' => 'required|integer|min:1',
            'units4.*' => 'required|integer|min:1',
            'units5.*' => 'required|integer|min:1',
            'units6.*' => 'required|integer|min:1',
            'units7.*' => 'required|integer|min:1',
            'units8.*' => 'required|integer|min:1',
            'units9.*' => 'nullable|integer|min:1',
            'units10.*' => 'nullable|integer|min:1',
            'units11.*' => 'nullable|integer|min:1',
            'term' => 'required',
            'term1' => 'required',
            'term3' => 'required',
            'term4' => 'required',
            'term5' => 'required',
            'term6' => 'required',
            'term7' => 'required',
            'term8' => 'required',
            'term9' => 'nullable',
            'term10' => 'nullable',
            'term11' => 'nullable',
            'total10.*' => 'nullable',
            'total1.*' => 'nullable',
            'total3.*' => 'nullable',
            'total4.*' => 'nullable',
            'total5.*' => 'nullable',
            'total6.*' => 'nullable',
            'total7.*' => 'nullable',
            'total8.*' => 'nullable',
            'total9.*' => 'nullable',
            'total10.*' => 'nullable',
            'total11.*' => 'nullable',
            'year_level' => 'required|string',
            'gwa1' => 'required|lte:1.75',
            'gwa2' => 'required|lte:1.75',
            'gwa3' => 'required|lte:1.75',
            'gwa4' => 'required|lte:1.75',
            'gwa5' => 'required|lte:1.75',
            'gwa6' => 'required|lte:1.75',
            'gwa7' => 'required|lte:1.75',
            'gwa8' => 'required|lte:1.75',
            'gwa9' => 'nullable|lte:1.75',
            'gwa10' => 'nullable|lte:1.75',
            'gwa11' => 'nullable|lte:1.75',
            'course_id' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->sometimes('gwa10', 'required', function ($input) {
            return $input->year_level == '5th Year';
        });
        $validator->sometimes('gwa11', 'required', function ($input) {
            return $input->year_level == '5th Year';
        });
        $validator->sometimes('gwa9', 'required', function ($input) {
            return $input->summerchk == 'on';
        });
    }

    public function messages()
    {
        return [
            'subjects.*.regex' => 'The :input is not allowed',
            'subjects1.*.regex' => 'The :input is not allowed',
            'subjects2.*.regex' => 'The :input is not allowed',
            'subjects3.*.regex' => 'The :input is not allowed',
            'subjects4.*.regex' => 'The :input is not allowed',
            'subjects5.*.regex' => 'The :input is not allowed',
            'subjects6.*.regex' => 'The :input is not allowed',
            'subjects7.*.regex' => 'The :input is not allowed',
            'subjects8.*.regex' => 'The :input is not allowed',
            'subjects9.*.regex' => 'The :input is not allowed',
            'subjects10.*.regex' => 'The :input is not allowed',
            'subjects11.*.regex' => 'The :input is not allowed',
            'units.*.min' => 'Enter valid number for units',
            'units1.*.min' => 'Enter valid number for units',
            'units3.*.min' => 'Enter valid number for units',
            'units4.*.min' => 'Enter valid number for units',
            'units5.*.min' => 'Enter valid number for units',
            'units6.*.min' => 'Enter valid number for units',
            'units7.*.min' => 'Enter valid number for units',
            'units8.*.min' => 'Enter valid number for units',
            'units9.*.min' => 'Enter valid number for units',
            'units10.*.min' => 'Enter valid number for units',
            'units11.*.min' => 'Enter valid number for units',
            'grades.*.lt' => 'Sorry, you have grades lower than 2.75 in First Year - 1st Semester.',
            'grades1.*.lt' => 'Sorry, you have grades lower than 2.75 in First Year - 2nd Semester.',
            'grades3.*.lt' => 'Sorry, you have grades lower than 2.75 in Second Year - 1st Semester.',
            'grades4.*.lt' => 'Sorry, you have grades lower than 2.75 in Second Year - 2nd Semester.',
            'grades5.*.lt' => 'Sorry, you have grades lower than 2.75 in Third Year - 1st Semester.',
            'grades6.*.lt' => 'Sorry, you have grades lower than 2.75 in Third Year - 2nd Semester.',
            'grades7.*.lt' => 'Sorry, you have grades lower than 2.75 in Fourth Year - 1st Semester.',
            'grades8.*.lt' => 'Sorry, you have grades lower than 2.75 in Fourth Year - 2nd Semester.',
            'grades9.*.lt' => 'Sorry, you have grades lower than 2.75 in Summer.',
            'grades10.*.lt' => 'Sorry, you have grades lower than 2.75 in Fifth Year - 1st Semester.',
            'grades11.*.lt' => 'Sorry, you have grades lower than 2.75 in Fifth Year - 2nd Semester.',
            'grades.*.in' => 'Sorry, you have enter invalid grade input in First Year - 1st Semester.',
            'grades1.*.in' => 'Sorry, you have enter invalid grade input in First Year - 2nd Semester.',
            'grades3.*.in' => 'Sorry, you have enter invalid grade input in Second Year - 1st Semester.',
            'grades4.*.in' => 'Sorry, you have enter invalid grade input in Second Year - 2nd Semester.',
            'grades5.*.in' => 'Sorry, you have enter invalid grade input in Third Year - 1st Semester.',
            'grades6.*.in' => 'Sorry, you have enter invalid grade input in Third Year - 2nd Semester.',
            'grades7.*.in' => 'Sorry, you have enter invalid grade input in Fourth Year - 1st Semester.',
            'grades8.*.in' => 'Sorry, you have enter invalid grade input in Fourth Year - 2nd Semester.',
            'grades9.*.in' => 'Sorry, you have enter invalid grade input in Summer.',
            'grades10.*.in' => 'Sorry, you have enter invalid grade input in Fifth Year - 1st Semester.',
            'grades11.*.in' => 'Sorry, you have enter invalid grade input in Fifth Year - 2nd Semester.',
            'gwa1.required' => 'Field for First Year - 1st Semester is required',
            'gwa2.required' => 'Field for First year - 2nd Semester is required',
            'gwa3.required' => 'Field for Second Year - 1st Semester is required',
            'gwa4.required' => 'Field for Second year - 2nd Semester is required',
            'gwa5.required' => 'Field for Third Year - 1st Semester is required',
            'gwa6.required' => 'Field for Third year - 2nd Semester is required',
            'gwa7.required' => 'Field for Fourth Year - 1st Semester is required',
            'gwa8.required' => 'Field for Fourth year - 2nd Semester is required',
            'gwa9.required' => 'Field for Summer is required',
            'gwa10.required' => 'Field for Fifth Year - 1st Semester is required',
            'gwa11.required' => 'Field for Fifth year - 2nd Semester is required',
            'gwa1.lte' => 'Your First Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa2.lte' => 'Your First Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa3.lte' => 'Your Second Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa4.lte' => 'Your Second Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa5.lte' => 'Your Third Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa6.lte' => 'Your Third Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa7.lte' => 'Your Fourth Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa8.lte' => 'Your Fourth Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa9.lte' => 'Your Summer GWA did not meet the grade requirement.',
            'gwa10.lte' => 'Your Fifth Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa11.lte' => 'Your Fifth Year - 2nd Semester GWA did not meet the grade requirement.',
        ];
    }
}
