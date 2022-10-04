<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\StudentApplicant;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;


class CertificatesController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('admin.send-awardees-certificates.index', compact('courses'));
    }

    public function view($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $count = StudentApplicant::where('certificate_status', '1')->where('status', '1')->count();
        $total = StudentApplicant::where('status', '1')->count();
        $awardees = StudentApplicant::where('award_applied', '1')
            ->where('course_id', $courses->id)
            ->where('status', '1')
            ->orderBy('gwa', 'asc')
            ->get();
        return view('admin.send-awardees-certificates.view', compact('courses', 'awardees', 'count', 'total'));
    }

    public function sendEmail(Request $request)
    {
        $users = StudentApplicant::whereIn("id", $request->ids)->get();

        foreach ($users as $key => $user) {
            $data = [
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'gwa'  => $user->gwa,
                'award'  => $user->award_applied,
                'sy'  => $user->school_year
            ];
            $details = ['email' => $user->users->email];
            SendEmailJob::dispatch($details, $data);
        }
        $users1 = StudentApplicant::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully. Refresh the page']);
    }

    public function showCertificate($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $users = StudentApplicant::with('users')->find($id);
        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate($users->users->stud_num));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.certificate', array('users' => $users), array('qrcode' => $qrcode));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($users->users->last_name . ',' . $users->users->first_name . '-cert.pdf');
    }
}
