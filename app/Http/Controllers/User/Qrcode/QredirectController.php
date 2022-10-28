<?php

namespace App\Http\Controllers\User\Qrcode;

use App\Http\Controllers\Controller;
use App\Models\AcademicExcellence;
use App\Models\NonAcademicApplicant;
use App\Models\StudentApplicant;
use Illuminate\Http\Request;

class QredirectController extends Controller
{
    public function redirect($id)
    {
        $user_sa = StudentApplicant::where('stud_app_id', $id)->where('status', '1')->first();
        $user_ae = AcademicExcellence::where('ae_app_id', $id)->where('status', '1')->first();
        $user_na = NonAcademicApplicant::where('nonacad_app_id', $id)->where('status', '1')->first();

        return view('user.check-qr.stud-app', compact('user_sa', 'user_ae', 'user_na'));
    }
}
