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
        $name1 = Signature::where('id', '2')->value('rep_name');
        $pos1 = Signature::where('id', '2')->value('position');
        $name_sig1 = Signature::where('id', '2')->value('signature');

        $pos2 = Signature::where('id', '3')->value('position');
        $name2 = Signature::where('id', '3')->value('rep_name');
        $name_sig2 = Signature::where('id', '3')->value('signature');

        $pos3 = Signature::where('id', '4')->value('position');
        $name3 = Signature::where('id', '4')->value('rep_name');
        $name_sig3 = Signature::where('id', '4')->value('signature');

        $pos4 = Signature::where('id', '5')->value('position');
        $name4 = Signature::where('id', '5')->value('rep_name');
        $name_sig4 = Signature::where('id', '5')->value('signature');

        $users = AcademicExcellence::whereIn("id", $request->ids)->get();
        foreach ($users as $user) {
            $data = [
                'studnum' => $user->users->stud_num,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'gwa'  => $user->gwa,
                'award'  => $user->award_applied,
                'award_name'  => $user->award->name,
                'sy'  => $user->school_year,
                'name1' => $name1,
                'position1' => $pos1,
                'signature1' => $name_sig1,

                'name2' => $name2,
                'position2' => $pos2,
                'signature2' => $name_sig2,

                'name3' => $name3,
                'position3' => $pos3,
                'signature3' => $name_sig3,

                'name4' => $name4,
                'position4' => $pos4,
                'signature4' => $name_sig4
            ];
            $details = ['email' => $user->users->email];
        }
        SendEmailJob::dispatch($details, $data, $data['studnum']);
        AcademicExcellence::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully']);
    }

    public function showCertificate($course_code, $id)
    {
        $sig = Signature::orderBy('id', 'asc')->get();
        $stud = AcademicExcellence::with('users')->find($id);
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
        $pdf->loadView('admin.send-awardees-certificates.academic-excellence-award.show', $data, compact('qrcode', 'sig'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($stud->users->last_name . ',' . $stud->users->first_name . '-cert.pdf');
    }
}
