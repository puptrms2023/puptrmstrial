<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'event_name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'eventRadio' => 'required',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->sometimes('all_day', 'required|after_or_equal:today', function ($input) {
            return $input->eventRadio == 'allday_radio';
        });
        $validator->sometimes('start_long_event', 'required|after_or_equal:today', function ($input) {
            return $input->eventRadio == 'longevent_radio';
        });
        $validator->sometimes('end_long_event', 'required|after_or_equal:today|after:start_long_event', function ($input) {
            return $input->eventRadio == 'longevent_radio';
        });
        $validator->sometimes('all_day_event_duration', 'required|after_or_equal:today', function ($input) {
            return $input->eventRadio == 'allday_duration';
        });
        $validator->sometimes('start_time_duration', 'required|after_or_equal:today', function ($input) {
            return $input->eventRadio == 'time_duration';
        });
        $validator->sometimes('end_time_duration', 'required|after_or_equal:today|after:start_time_duration', function ($input) {
            return $input->eventRadio == 'time_duration';
        });
    }
}
