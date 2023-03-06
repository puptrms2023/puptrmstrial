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
            'interview' => 'nullable|mimes:pdf,doc,docx|max:25600',
            // 'image' => 'required|mimes:jpeg,png,jpg',
            'file' => 'nullable|mimes:csv,txt,xlx,xls,pdf,doc,docx,zip|max:25600',
            'first_year_first' => $this->nullableNumericValidation(),
            'first_year_second' => $this->nullableNumericValidation(),
            'second_year_first' => $this->nullableNumericValidation(),
            'second_year_second' => $this->nullableNumericValidation(),
            'third_year_first' => $this->nullableNumericValidation(),
            'third_year_second' => $this->nullableNumericValidation(),
            'fourth_year_first' => $this->nullableNumericValidation(),
            'fourth_year_second' => $this->nullableNumericValidation(),
            'fifth_year_first' => $this->nullableNumericValidation(),
            'fifth_year_second' => $this->nullableNumericValidation()
        ];
    }

    private function nullableNumericValidation()
    {
        return ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,3})?$/'];
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

        $validator->sometimes('image', 'nullable|mimes:jpeg,png,jpg', function ($input) {
            return $input->nonacad_id == '4' || $input->nonacad_id == '3';
        });

        $validator->sometimes('financial', 'required|mimes:pdf,doc,docx|max:25600', function ($input) {
            return $input->nonacad_id == '3';
        });

        //leadership validation
        $validator->sometimes('projects.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('sponsors.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('inclusive_date.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('inclusive_level.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('beneficiaries.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });

        $validator->sometimes('organization.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('position_held.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('date_received.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('level.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });

        $validator->sometimes('award.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('awarded_by.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('date_received_off.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('level_off.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });

        $validator->sometimes('projects_com.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('involvement.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('sponsored_by.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('inclusive_date_com.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('level_comm.*', 'required', function ($input) {
            return $input->nonacad_id == '1';
        });
        $validator->sometimes('interview', 'nullable|mimes:pdf,doc,docx|max:25600', function ($input) {
            return $input->nonacad_id == '1';
        });

        //outstanding
        $validator->sometimes('oprojects.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('osponsors.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('oinclusive_date.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('oinclusive_level.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('obeneficiaries.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });

        $validator->sometimes('oaward.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('oawarded_by.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('odate_received_off.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('olevel_off.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });

        $validator->sometimes('oprojects_com.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('oinvolvement.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('osponsored_by.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('oinclusive_date_com.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('olevel_comm.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
        });
        $validator->sometimes('affiliation.*', 'required', function ($input) {
            return $input->nonacad_id == '3';
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
