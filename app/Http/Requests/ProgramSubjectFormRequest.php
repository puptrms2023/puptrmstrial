<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramSubjectFormRequest extends FormRequest
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
            'fy_fs.*.subjects1' => 'required|integer',
            'fy_fs.*.units1' => 'required|numeric',
            'semester1' => 'required|string',
            'year_level' => 'required|string',
            'fy_ss.*.subjects2' => 'required|integer',
            'fy_ss.*.units2' => 'required|numeric',
            'semester2' => 'required|string',

            'sy_fs.*.subjects3' => 'required|integer',
            'sy_fs.*.units3' => 'required|numeric',
            'semester3' => 'required|string',
            'year_level2' => 'required|string',
            'sy_ss.*.subjects4' => 'required|integer',
            'sy_ss.*.units4' => 'required|numeric',
            'semester4' => 'required|string',
        ];
    }
}
