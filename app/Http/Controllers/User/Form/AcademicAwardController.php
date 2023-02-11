<?php

namespace App\Http\Controllers\User\Form;

use App\Models\User;
use App\Models\Summary;
use App\Models\ShortLink;
use Illuminate\Support\Str;
use App\Models\StudentApplicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminNotification;
use App\Http\Requests\AcademicAwardRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\Notification;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use AshAllenDesign\ShortURL\Models\ShortURL as ModelsShortURL;

class AcademicAwardController extends Controller
{
    public function index()
    {
        $sub = Subject::all();
        return view('user.application-form.index', compact('sub'));
        // dd($subjects);
    }

    public function store(AcademicAwardRequest $request)
    {
        $subjects = array_merge($request->subjects, $request->subjects1);
        $unique_subjects = array_unique($subjects);

        if (count($subjects) > count($unique_subjects)) {
            return redirect()->back()->with('error', 'Duplicate subjects in the input.');
        }

        $users = User::where('role_as', '2')->get();
        $user_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $data = $request->validated();
        $award = new StudentApplicant();
        $gwa = ($data['gwa_1st'] + $data['gwa_2nd']) / 2;

        $award->user_id = $data['user_id'];
        $award->school_year = getAcademicYear();
        $award->gwa_1st = $data['gwa_1st'];
        $award->gwa_2nd = $data['gwa_2nd'];
        $award->year_level = $data['year_level'];

        if ($data['year_level'] == '1st Year') {
            if ($gwa <= 1.75) {
                $award->award_applied = 1;
            } else {
                return redirect()->back()->with('error', 'Not eligible');
            }
        } else {
            if ($gwa >= 1.00 && $gwa <= 1.50) {
                $award->award_applied = 3;
            } else if ($gwa > 1.50 && $gwa <= 1.75) {
                $award->award_applied = 2;
            } else {
                return redirect()->back()->with('error', 'Not eligible');
            }
        }

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
            $award->image = $filename;
        }

        $award->course_id = $data['course_id'];
        $award->stud_app_id = generateApplicationId();

        $award->save();
        $lastid = $award->id;

        foreach ($request->subjects as $key => $subjects) {
            $sum = new Summary();
            $sum->subject_id = $subjects;
            $sum->units = $data['units'][$key];
            $sum->grades = $data['grades'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term'];
            $sum->sy = getAcademicYear();
            $sum->app_id = $lastid;
            $sum->save();
        }

        foreach ($request->subjects1 as $key => $subjects1) {
            $sum = new Summary();
            $sum->subject_id = $subjects1;
            $sum->units = $data['units1'][$key];
            $sum->grades = $data['grades1'][$key];
            $sum->user_id = $data['user_id'];
            $sum->term = $data['term1'];
            $sum->sy = getAcademicYear();
            $sum->app_id = $lastid;
            $sum->save();
        }
        Notification::send($users, new AdminNotification($user_name, $lastid, $award->award->acad_code));

        return redirect('user/dashboard')->with('success', 'Your application has been submitted');
    }
}
