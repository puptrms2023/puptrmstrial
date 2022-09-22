<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        return [
            'user_id' => 'required',
            'school_year' => 'required',
            'app_id' => 'nullable',
            'subjects.*' => 'required|string',
            'subjects1.*' => 'required|string',
            'subjects3.*' => 'required|string',
            'subjects4.*' => 'required|string',
            'subjects5.*' => 'required|string',
            'subjects6.*' => 'required|string',
            'subjects7.*' => 'required|string',
            'subjects8.*' => 'required|string',
            'grades.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades1.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades3.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades4.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades5.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades6.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades7.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades8.*' => ['required', 'numeric', 'lt:2.50', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'units.*' => 'required|integer|min:1',
            'units1.*' => 'required|integer|min:1',
            'units3.*' => 'required|integer|min:1',
            'units4.*' => 'required|integer|min:1',
            'units5.*' => 'required|integer|min:1',
            'units6.*' => 'required|integer|min:1',
            'units7.*' => 'required|integer|min:1',
            'units8.*' => 'required|integer|min:1',
            'term' => 'required',
            'term1' => 'required',
            'term3' => 'required',
            'term4' => 'required',
            'term5' => 'required',
            'term6' => 'required',
            'term7' => 'required',
            'term8' => 'required',
            'total.*' => 'nullable',
            'total1.*' => 'nullable',
            'total3.*' => 'nullable',
            'total4.*' => 'nullable',
            'total5.*' => 'nullable',
            'total6.*' => 'nullable',
            'total7.*' => 'nullable',
            'total8.*' => 'nullable',
            'year_level' => 'required|string',
            'gwa1' => 'required|lte:1.75',
            'gwa2' => 'required|lte:1.75',
            'gwa3' => 'required|lte:1.75',
            'gwa4' => 'required|lte:1.75',
            'gwa5' => 'required|lte:1.75',
            'gwa6' => 'required|lte:1.75',
            'gwa7' => 'required|lte:1.75',
            'gwa8' => 'required|lte:1.75',
            'course_id' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'units.*.min' => 'Enter valid number for units',
            'units1.*.min' => 'Enter valid number for units',
            'units3.*.min' => 'Enter valid number for units',
            'units4.*.min' => 'Enter valid number for units',
            'units5.*.min' => 'Enter valid number for units',
            'units6.*.min' => 'Enter valid number for units',
            'units7.*.min' => 'Enter valid number for units',
            'units8.*.min' => 'Enter valid number for units',
            'grades.*.lt' => 'Sorry, you have grades lower than 2.50 in First Year - !st Semester.',
            'grades1.*.lt' => 'Sorry, you have grades lower than 2.50 in First Year - 2nd Semester.',
            'grades3.*.lt' => 'Sorry, you have grades lower than 2.50 in Second Year - !st Semester.',
            'grades4.*.lt' => 'Sorry, you have grades lower than 2.50 in Second Year - 2nd Semester.',
            'grades5.*.lt' => 'Sorry, you have grades lower than 2.50 in Third Year - !st Semester.',
            'grades6.*.lt' => 'Sorry, you have grades lower than 2.50 in Third Year - 2nd Semester.',
            'grades7.*.lt' => 'Sorry, you have grades lower than 2.50 in Fourth Year - !st Semester.',
            'grades8.*.lt' => 'Sorry, you have grades lower than 2.50 in Fourth Year - 2nd Semester.',
            'grades.*.in' => 'Sorry, you have enter invalid grade input in First Year - 1st Semester.',
            'grades1.*.in' => 'Sorry, you have enter invalid grade input in First Year - 2nd Semester.',
            'grades3.*.in' => 'Sorry, you have enter invalid grade input in Second Year - 1st Semester.',
            'grades4.*.in' => 'Sorry, you have enter invalid grade input in Second Year - 2nd Semester.',
            'grades5.*.in' => 'Sorry, you have enter invalid grade input in Third Year - 1st Semester.',
            'grades6.*.in' => 'Sorry, you have enter invalid grade input in Third Year - 2nd Semester.',
            'grades7.*.in' => 'Sorry, you have enter invalid grade input in Fourth Year - 1st Semester.',
            'grades8.*.in' => 'Sorry, you have enter invalid grade input in Fourth Year - 2nd Semester.',
            'gwa1.required' => 'Field for First Year - 1st Semester is required',
            'gwa2.required' => 'Field for First year - 2nd Semester is required',
            'gwa3.required' => 'Field for Second Year - 1st Semester is required',
            'gwa4.required' => 'Field for Second year - 2nd Semester is required',
            'gwa5.required' => 'Field for Third Year - 1st Semester is required',
            'gwa6.required' => 'Field for Third year - 2nd Semester is required',
            'gwa7.required' => 'Field for Fourth Year - 1st Semester is required',
            'gwa8.required' => 'Field for Fourth year - 2nd Semester is required',
            'gwa1.lte' => 'Your First Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa2.lte' => 'Your First Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa3.lte' => 'Your Second Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa4.lte' => 'Your Second Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa5.lte' => 'Your Third Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa6.lte' => 'Your Third Year - 2nd Semester GWA did not meet the grade requirement.',
            'gwa7.lte' => 'Your Fourth Year - 1st Semester GWA did not meet the grade requirement.',
            'gwa8.lte' => 'Your Fourth Year - 2nd Semester GWA did not meet the grade requirement.',
        ];
    }
}
