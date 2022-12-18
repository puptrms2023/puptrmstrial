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
            'subjects9.*' => 'nullable',
            'subjects10.*' => 'nullable',
            'subjects11.*' => 'nullable',
            'grades.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades1.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades3.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades4.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades5.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades6.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades7.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades8.*' => ['required', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades9.*' => ['nullable', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades10.*' => ['nullable', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'grades11.*' => ['nullable', 'numeric', 'lt:2.75', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
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
