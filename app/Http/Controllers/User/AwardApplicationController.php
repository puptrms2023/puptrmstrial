<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AwardFormRequest;

class AwardApplicationController extends Controller
{
    public function index()
    {
        return view('user.application-form.index');
    }

    public function store(AwardFormRequest $request)
    {
        $data = $request->validated();
        $award = new StudentApplicants();

        $award->user_id = $data['user_id'];
        $award->school_year = $data['school_year'];
        $award->gwa_1st = $data['gwa_1st'];
        $award->gwa_2nd = $data['gwa_2nd'];
        $award->year_level = $data['year_level'];

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
            $award->image = $filename;
        }

        $award->award_applied = $data['award_applied'];
        $award->save();
        return redirect('user/dashboard')->with('message', 'Your application is received');
    }
}
