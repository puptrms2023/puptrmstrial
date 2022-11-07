<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class NonAcademicAwardRequest extends FormRequest
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
            'course_id' => 'required',
            'school_year' => 'required',
            'year_level' => 'required',
            'nonacad_id' => 'required',
            'remarks' => 'nullable',
            'org_id' => 'nullable',
            'sports' => 'nullable',
            'subject' => 'nullable',
            'thesis' => 'nullable',
            'designation' => 'nullable',
            'competition' => 'nullable',
            'placement' => 'nullable',
            'image' => 'required|mimes:jpeg,png,jpg',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->sometimes('org_id', 'required', function ($input) {
            return $input->nonacad_id == '1' || $input->nonacad_id == '3' || $input->nonacad_id == '5' || $input->nonacad_id == '6' || $input->nonacad_id == '7';
        });
        $validator->sometimes('sports', 'required', function ($input) {
            return $input->nonacad_id == '2';
        });
        $validator->sometimes('subject', 'required', function ($input) {
            return $input->nonacad_id == '4';
        });
        $validator->sometimes('thesis', 'required', function ($input) {
            return $input->nonacad_id == '4';
        });
        $validator->sometimes('designation', 'required', function ($input) {
            return $input->nonacad_id == '6';
        });
        $validator->sometimes('competition', 'required', function ($input) {
            return $input->nonacad_id == '7';
        });
        $validator->sometimes('placement', 'required', function ($input) {
            return $input->nonacad_id == '7';
        });
        $validator->sometimes('others', 'required', function ($input) {
            return $input->org_id == '9';
        });
    }

    public function messages()
    {
        return [
            'nonacad_id.required' => 'The Non Academic Award field is required.',
            'org_id.required' => 'The Student Organization field is required.',
            'year_level.required' => 'The Academic Level field is requred',
            'thesis.required' => 'Thesis/Capstone Title field is requred',
            'subject.required' => 'Subject Name field is requred',
            'competition.required' => 'Competition Name field is requred',
            'designation.required' => 'Designated Office field is requred',
            'placement.required' => 'Award Received/Placements field is requred',
        ];
    }
}
