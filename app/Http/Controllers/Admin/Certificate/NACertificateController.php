<?php

namespace App\Http\Controllers\Admin\Certificate;

use App\Jobs\SendEmailJob;
use App\Models\NonAcadAward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
use App\Models\Signature;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NACertificateController extends Controller
{
    public function index()
    {
        $nonacad = NonAcadAward::all();
        return view('admin.send-awardees-certificates.non-academic-award.index', compact('nonacad'));
    }

    public function show($id)
    {
        $nonacad = NonAcadAward::first();
        $form = NonAcademicApplicant::where('nonacad_id', $id)->get();
        $count = NonAcademicApplicant::where('certificate_status', '1')->where('nonacad_id', $id)->count();
        return view('admin.send-awardees-certificates.non-academic-award.view', compact('count', 'nonacad', 'form'));
    }

    public function showCertificate($nonacad_id, $id)
    {
        $sig = Signature::orderBy('id', 'asc')->get();
        $stud = NonAcademicApplicant::with('users')->find($id);
        $data = [
            'fname' => $stud->users->first_name,
            'mname' => $stud->users->middle_name,
            'lname' => $stud->users->last_name,
            'award'  => $stud->nonacad_id,
            'award_name'  => $stud->nonacad->name,
            'sy'  => $stud->school_year
        ];

        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate($stud->users->stud_num));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.non-academic-award.show', $data, compact('qrcode', 'sig'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($stud->users->last_name . ',' . $stud->users->first_name . '-cert.pdf');
    }

    public function sendEmail(Request $request)
    {
        $users = NonAcademicApplicant::whereIn("id", $request->ids)->get();
        foreach ($users as $key => $user) {
            $data = [
                'studnum' => $user->users->stud_num,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'award'  => $user->nonacad_id,
                'award_name'  => $user->nonacad->name,
                'sy'  => $user->school_year
            ];
            $details = ['email' => $user->users->email];
            SendEmailJob::dispatch($details, $data, $data['studnum']);
        }
        NonAcademicApplicant::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully. Refresh the page']);
    }
}
