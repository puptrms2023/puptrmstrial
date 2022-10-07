<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\NonAcademicAwardRequest;
use App\Models\NonAcadAward;
use App\Models\NonAcademicApplicant;
use App\Models\StudentOrganization;
use Illuminate\Http\Request;

class NonAcademicAwardController extends Controller
{
    public function index()
    {
        $organization = StudentOrganization::pluck('name', 'id');
        $award = NonAcadAward::pluck('name', 'id');
        return view('user.non-academic-form.index', compact('organization', 'award'));
    }

    public function store(NonAcademicAwardRequest $request)
    {
        $data = $request->validated();
        $award = new NonAcademicApplicant();

        $award->user_id = $data['user_id'];
        $award->course_id = $data['course_id'];
        $award->school_year = $data['school_year'];
        $award->year_level = $data['year_level'];
        $award->nonacad_id = $data['nonacad_id'];
        $award->org_id = $data['org_id'];
        $award->sports = $data['sports'];
        $award->subject_name = $data['subject'];
        $award->thesis_title = $data['thesis'];
        $award->competition_name = $data['competition'];
        $award->placement = $data['placement'];
        $award->designated_office = $data['designation'];
        $award->remarks = $data['remarks'];

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
            $award->image = $filename;
        }

        $award->save();

        return redirect('user/dashboard')->with('success', 'Your application is received');
    }
}
