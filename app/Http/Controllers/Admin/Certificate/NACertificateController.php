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
        $nonacad = NonAcadAward::find($id);
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

        $users = NonAcademicApplicant::whereIn("id", $request->ids)->get();
        foreach ($users as $user) {
            $data = [
                'studnum' => $user->users->stud_num,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'award'  => $user->nonacad_id,
                'award_name'  => $user->nonacad->name,
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
        NonAcademicApplicant::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully']);
    }
}
