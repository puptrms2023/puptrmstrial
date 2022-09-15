<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'csv_file' => 'required|mimes:csv,txt'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
