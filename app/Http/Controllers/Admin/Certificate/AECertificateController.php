<?php

namespace App\Http\Controllers\Admin\Certificate;

use App\Models\Courses;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Models\AcademicExcellence;
use App\Http\Controllers\Controller;
use App\Models\Signature;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AECertificateController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu send certificate', ['only' => ['index', 'view', 'sendEmail', 'showCertificate']]);
    }
    public function index()
    {
        $courses = Courses::all();
        return view('admin.send-awardees-certificates.academic-excellence-award.index', compact('courses'));
    }

    public function view($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        //count
        $count = AcademicExcellence::where('certificate_status', '1')->where('status', '1')->where('award_applied', '4')->where('course_id', $courses->id)->count();
        $total = AcademicExcellence::where('status', '1')->where('award_applied', '4')->where('course_id', $courses->id)->count();

        $awardees = AcademicExcellence::where('award_applied', '4')
            ->where('course_id', $courses->id)
            ->where('status', '1')
            ->orderBy('gwa', 'asc')
            ->get();
        return view('admin.send-awardees-certificates.academic-excellence-award.view', compact('courses', 'awardees', 'count', 'total'));
    }

    public function sendEmail(Request $request)
    {
        $name1 = Signature::where('certificate', '1')->first();
        $name2 = Signature::where('certificate', '1')->skip(1)->take(1)->first();
        $name3 = Signature::where('certificate', '1')->skip(2)->take(1)->first();
        $name4 = Signature::where('certificate', '1')->skip(3)->take(1)->first();

        $users = AcademicExcellence::whereIn("id", $request->ids)->get();
        foreach ($users as $user) {
            $data = [
                'app_id' => shortUrl() . '/verify-award/' . $user->ae_app_id,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'gwa'  => $user->gwa,
                'award'  => $user->award->acad_code,
                'award_name'  => $user->award->name,
                'sy'  => $user->school_year,
                'summer' => $user->gwa9,
                'fifth_1' => $user->gwa10,
                'fifth_2' => $user->gwa11,
                'totalwithSummer' => ($user->gwa1 + $user->gwa2 + $user->gwa3 + $user->gwa4 + $user->gwa5 + $user->gwa6 + $user->gwa7 + $user->gwa8 + $user->gwa9) / 9,
                'totalwith5thYear' => ($user->gwa1 + $user->gwa2 + $user->gwa3 + $user->gwa4 + $user->gwa5 + $user->gwa6 + $user->gwa7 + $user->gwa8 + $user->gwa10 + $user->gwa11) / 10,
                'totalwith5thAndSummer' => ($user->gwa1 + $user->gwa2 + $user->gwa3 + $user->gwa4 + $user->gwa5 + $user->gwa6 + $user->gwa7 + $user->gwa8 + $user->gwa9 + $user->gwa10 + $user->gwa11) / 11,
                'name1' => $name1->rep_name,
                'position1' => $name1->position,
                'signature1' => $name1->signature,

                'name2' => $name2->rep_name,
                'position2' => $name2->position,
                'signature2' => $name2->signature,

                'name3' => $name3->rep_name,
                'position3' => $name3->position,
                'signature3' => $name3->signature,

                'name4' => $name4->rep_name,
                'position4' => $name4->position,
                'signature4' => $name4->signature
            ];
            $details = ['email' => $user->users->email];
            SendEmailJob::dispatch($details, $data, $data['app_id']);
        }
        AcademicExcellence::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully']);
    }

    public function showCertificate($course_code, $id)
    {
        $stud = AcademicExcellence::with('users')->find($id);
        $data = [
            'fname' => $stud->users->first_name,
            'mname' => $stud->users->middle_name,
            'lname' => $stud->users->last_name,
            'gwa'  => $stud->gwa,
            'award'  => $stud->award_applied,
            'sy'  => $stud->school_year,
            'totalwithSummer' => ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa9) / 9,
            'totalwith5thYear' => ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa10 + $stud->gwa11) / 10,
            'totalwith5thAndSummer' => ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa9 + $stud->gwa10 + $stud->gwa11) / 11
        ];

        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate(shortUrl() . '/verify-award/' . $stud->ae_app_id));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.academic-excellence-award.show', $data, compact('stud', 'qrcode'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($stud->users->last_name . ',' . $stud->users->first_name . '-cert.pdf');
    }
}
