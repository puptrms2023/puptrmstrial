<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Mail\CertificateEmail;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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
        $awardees = StudentApplicants::where('award_applied', '1')
            ->where('course_id', $courses->id)
            ->where('status', '1')
            ->orderBy('gwa', 'asc')
            ->get();
        return view('admin.send-awardees-certificates.view', compact('courses', 'awardees'));
    }

    public function sendEmail(Request $request)
    {
        $users = StudentApplicants::whereIn("id", $request->ids)->get();
        foreach ($users as $key => $user) {
            Mail::to($user->users->email)->send(new CertificateEmail($user));
        }
        $users1 = StudentApplicants::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully. Refresh the page']);
    }

    public function showCertificate($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::with('users')->find($id);
        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate($students->users->stud_num));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.certificate', array('students' => $students), array('qrcode' => $qrcode));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($students->users->last_name . ',' . $students->users->first_name . '-cert.pdf');
    }
}
