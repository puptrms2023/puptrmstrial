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
        $form = NonAcademicApplicant::where('nonacad_id', $id)->where('status', '1')->get();
        $count = NonAcademicApplicant::where('certificate_status', '1')->where('nonacad_id', $id)->count();
        return view('admin.send-awardees-certificates.non-academic-award.view', compact('count', 'nonacad', 'form'));
    }

    public function showCertificate($nonacad_id, $id)
    {
        $sig = Signature::where('certificate', '1')->orderBy('id', 'asc')->get();
        $stud = NonAcademicApplicant::with('users')->find($id);
        $data = [
            'fname' => $stud->users->first_name,
            'mname' => $stud->users->middle_name,
            'lname' => $stud->users->last_name,
            'award'  => $stud->nonacad_id,
            'award_name'  => $stud->nonacad->name,
            'sy'  => $stud->school_year
        ];

        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate(shortUrl() . '/verify-award/' . $stud->nonacad_app_id));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.non-academic-award.show', $data, compact('qrcode', 'sig'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($stud->users->last_name . ',' . $stud->users->first_name . '-cert.pdf');
    }

    public function sendEmail(Request $request)
    {
        $name1 = Signature::where('certificate', '1')->first();
        $name2 = Signature::where('certificate', '1')->skip(1)->take(1)->first();
        $name3 = Signature::where('certificate', '1')->skip(2)->take(1)->first();
        $name4 = Signature::where('certificate', '1')->skip(3)->take(1)->first();

        $users = NonAcademicApplicant::whereIn("id", $request->ids)->get();
        foreach ($users as $user) {
            $data = [
                'app_id' => shortUrl() . '/verify-award/' . $user->nonacad_app_id,
                'fname' => $user->users->first_name,
                'mname' => $user->users->middle_name,
                'lname' => $user->users->last_name,
                'award'  => $user->nonacad->nonacad_code,
                'award_name'  => $user->nonacad->name,
                'sy'  => $user->school_year,
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
        NonAcademicApplicant::whereIn("id", $request->ids)->update(['certificate_status' => 1]);
        return response()->json(['success' => 'Send email successfully']);
    }
}
