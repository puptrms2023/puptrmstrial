<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Courses;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\StudentApplicant;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AACertificateController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu send certificate', ['only' => ['index', 'view', 'sendEmail', 'showCertificate']]);
    }
    public function index()
    {
        $courses = Courses::all();
        return view('admin.send-awardees-certificates.achievers-award.index', compact('courses'));
    }

    public function view($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        //count
        $count = StudentApplicant::where('certificate_status', '1')->where('status', '1')->where('award_applied', '1')->count();
        $total = StudentApplicant::where('status', '1')->where('award_applied', '1')->count();

        $awardees = StudentApplicant::where('award_applied', '1')
            ->where('course_id', $courses->id)
            ->where('status', '1')
            ->orderBy('gwa', 'asc')
            ->get();
        return view('admin.send-awardees-certificates.achievers-award.view', compact('courses', 'awardees', 'count', 'total'));
    }

    public function sendEmail(Request $request)
    {
        $users = StudentApplicant::whereIn("id", $request->ids)->get();

        foreach ($users as $key => $user) {
            $data = [
                'studnum' => $user->users->stud_num,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'gwa'  => $user->gwa,
                'award'  => $user->award_applied,
                'sy'  => $user->school_year
            ];
            $details = ['email' => $user->users->email];
            SendEmailJob::dispatch($details, $data, $data['studnum']);
        }
        $users1 = StudentApplicant::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully. Refresh the page']);
    }

    public function showCertificate($course_code, $id)
    {
        $stud = StudentApplicant::with('users')->find($id);
        $data = [
            'fname' => $stud->users->first_name,
            'mname' => $stud->users->middle_name,
            'lname' => $stud->users->last_name,
            'gwa'  => $stud->gwa,
            'award'  => $stud->award_applied,
            'sy'  => $stud->school_year
        ];

        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate($stud->users->stud_num));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.achievers-award.show', $data, array('qrcode' => $qrcode));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($stud->users->last_name . ',' . $stud->users->first_name . '-cert.pdf');
    }
}
