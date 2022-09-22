<?php

namespace App\Http\Controllers\User;

use App\Models\Summary;
use Illuminate\Http\Request;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicExcellenceRequest;
use App\Models\AeApplicant;

class AEAwardApplicationController extends Controller
{
    public function index()
    {
        return view('user.application-form-ae.index');
    }

    public function store(AcademicExcellenceRequest $request)
    {
        $data = $request->validated();
        $award = new AeApplicant();

        $award->user_id = $data['user_id'];
        $award->course_id = $data['course_id'];
        $award->school_year = $data['school_year'];
        $award->year_level = $data['year_level'];
        $award->gwa1 = $data['gwa1'];
        $award->gwa2 = $data['gwa2'];
        $award->gwa3 = $data['gwa3'];
        $award->gwa4 = $data['gwa4'];
        $award->gwa5 = $data['gwa5'];
        $award->gwa6 = $data['gwa6'];
        $award->gwa7 = $data['gwa7'];
        $award->gwa8 = $data['gwa8'];

        $award->save();
        $lastid = $award->id;

        foreach ($request->subjects as $key => $subjects) {
            $sum = new Summary();
            $sum->subjects = $subjects;
            $sum->units = $data['units'][$key];
            $sum->grades = $data['grades'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }

        foreach ($request->subjects1 as $key => $subjects1) {
            $sum = new Summary();
            $sum->subjects = $subjects1;
            $sum->units = $data['units1'][$key];
            $sum->grades = $data['grades1'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term1'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }
        foreach ($request->subjects3 as $key => $subjects3) {
            $sum = new Summary();
            $sum->subjects = $subjects3;
            $sum->units = $data['units3'][$key];
            $sum->grades = $data['grades3'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term3'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }
        foreach ($request->subjects4 as $key => $subjects4) {
            $sum = new Summary();
            $sum->subjects = $subjects4;
            $sum->units = $data['units4'][$key];
            $sum->grades = $data['grades4'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term4'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }
        foreach ($request->subjects5 as $key => $subjects5) {
            $sum = new Summary();
            $sum->subjects = $subjects5;
            $sum->units = $data['units5'][$key];
            $sum->grades = $data['grades5'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term5'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }
        foreach ($request->subjects6 as $key => $subjects6) {
            $sum = new Summary();
            $sum->subjects = $subjects6;
            $sum->units = $data['units6'][$key];
            $sum->grades = $data['grades6'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term6'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }
        foreach ($request->subjects7 as $key => $subjects7) {
            $sum = new Summary();
            $sum->subjects = $subjects7;
            $sum->units = $data['units7'][$key];
            $sum->grades = $data['grades7'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term7'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }
        foreach ($request->subjects8 as $key => $subjects8) {
            $sum = new Summary();
            $sum->subjects = $subjects8;
            $sum->units = $data['units8'][$key];
            $sum->grades = $data['grades8'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term8'];
            $sum->sy = $data['school_year'];
            $sum->app_id = $lastid;
            $sum->save();
        }

        return redirect('user/dashboard')->with('message', 'Your application is received');
    }
}
