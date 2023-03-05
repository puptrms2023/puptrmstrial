<?php

namespace App\Http\Controllers\User\Form;

use App\Models\User;
use App\Models\NonAcadAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudentOrganization;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\NonAcademicAwardRequest;
use App\Models\Academic;
use App\Models\Interview;

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
        $users = User::where('role_as', '2')->get();
        $user_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $data = $request->validated();
        $award = new NonAcademicApplicant();

        $award->user_id = $data['user_id'];
        $award->course_id = $data['course_id'];
        $award->school_year =  getAcademicYear();
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
        $award->nonacad_app_id = generateApplicationIdNA();

        if (!empty($data['others'])) {
            $award->others = $data['others'];
        }

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
            $award->image = $filename;
        }

        if ($request->file('file')) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $award->file_name = time() . '_' . $request->file->getClientOriginalName();
            $award->file_path = '/storage/' . $filePath;
        }

        $award->save();
        $lastid = $award->id;

        if ($request->nonacad_id == '1') {

            $record = new Academic;
            $record->n_id = $lastid;
            $record->first_year_first = $data['first_year_first'];
            $record->first_year_second = $data['first_year_second'];
            $record->second_year_first = $data['second_year_first'];
            $record->second_year_second = $data['second_year_second'];
            $record->third_year_first = $data['third_year_first'];
            $record->third_year_second = $data['third_year_second'];
            $record->fourth_year_first = $data['fourth_year_first'];
            $record->fourth_year_second = $data['fourth_year_second'];
            $record->fifth_year_first = $data['fifth_year_first'];
            $record->fifth_year_second = $data['fifth_year_second'];
            $record->save();

            foreach ($request->projects as $key => $project) {
                DB::table('projects')->insert([
                    'n_id' => $lastid,
                    'projects' => $project,
                    'sponsors' => $data['sponsors'][$key],
                    'inclusive_date' => $data['inclusive_date'][$key],
                    'inclusive_level' => $data['inclusive_level'][$key],
                    'beneficiaries' => $data['beneficiaries'][$key],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            foreach ($request->organization as $key => $organizations) {
                DB::table('officership')->insert([
                    'n_id' => $lastid,
                    'organization' => $organizations,
                    'position_held' => $data['position_held'][$key],
                    'date_received' => $data['date_received'][$key],
                    'level' => $data['level'][$key],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }


            foreach ($request->award as $key => $awards) {
                DB::table('awards')->insert([
                    'n_id' => $lastid,
                    'awards' => $awards,
                    'awarded_by' => $data['awarded_by'][$key],
                    'date_received' => $data['date_received_off'][$key],
                    'level' => $data['level_off'][$key],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }


            foreach ($request->projects_com as $key => $project) {
                DB::table('community_outreach')->insert([
                    'n_id' => $lastid,
                    'projects' => $project,
                    'involvement' => $data['involvement'][$key],
                    'sponsored_by' => $data['sponsored_by'][$key],
                    'inclusive_dates' => $data['inclusive_date_com'][$key],
                    'level' => $data['level_comm'][$key],

                ]);
            }


            if ($request->has('interview')) {
                $file_int = $request->file('interview');
                $fileName = time() . '_' . $file_int->getClientOriginalName();
                $filePath = $request->file('interview')->storeAs('uploads', $fileName, 'public');

                $interview = new Interview;
                $interview->n_id = $lastid;
                $interview->file_name = time() . '_' . $file_int->getClientOriginalName();
                $interview->file_path = '/storage/' . $filePath;
                $interview->save();
            }
        }


        Notification::send($users, new AdminNotification($user_name, $lastid, $award->nonacad->nonacad_code));

        return redirect('user/dashboard')->with('success', 'Your application is received');
    }
}
