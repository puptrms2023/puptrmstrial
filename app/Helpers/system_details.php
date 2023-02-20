<?php

use App\Http\Controllers\Admin\Applicant\AEApplicantsController;
use App\Models\AcademicExcellence;
use App\Models\NonAcademicApplicant;
use App\Models\Setting;
use App\Models\Signature;
use App\Models\StudentApplicant;
use Illuminate\Support\Str;

function getSystemAcronym()
{
    return Setting::where('id', 1)->value('system_title');
}
function getSystemName()
{
    return Setting::where('id', 1)->value('system_name');
}
function getAcademicYear()
{
    return Setting::where('id', 1)->value('session_year');
}
function getPhone()
{
    return Setting::where('id', 1)->value('phone');
}
function getLogo()
{
    $photo = Setting::where('id', 1)->value('logo');
    return $photo;
}
function getFavicon()
{
    $photo = Setting::where('id', 1)->value('icon');
    return $photo;
}
function getSignature()
{
    return Signature::pluck('name');
}
function name1Report()
{
    return Signature::where('report', '1')->first();
}
function name2Report()
{
    return Signature::where('report', '1')->skip(1)->take(1)->first();
}
function name3Report()
{
    return Signature::where('report', '1')->skip(2)->take(1)->first();
}
function name4Report()
{
    return Signature::where('report', '1')->skip(3)->take(1)->first();
}
function name1Certificate()
{
    return Signature::where('certificate', '1')->first();
}
function name2Certificate()
{
    return Signature::where('certificate', '1')->skip(1)->take(1)->first();
}
function name3Certificate()
{
    return Signature::where('certificate', '1')->skip(2)->take(1)->first();
}
function name4Certificate()
{
    return Signature::where('certificate', '1')->skip(3)->take(1)->first();
}

function generateApplicationId()
{
    $id = 'PUPT-' . mt_rand(1000000000, 9999999999);
    if (applicationIdExists($id)) {
        return generateApplicationId();
    }
    return $id;
}
function applicationIdExists($id)
{
    return StudentApplicant::where('stud_app_id', $id)->exists();
}
function generateApplicationIdAE()
{
    $id = 'PUPT-' . mt_rand(1000000000, 9999999999);
    if (applicationIdExistsAE($id)) {
        return generateApplicationIdAE();
    }
    return $id;
}
function applicationIdExistsAE($id)
{
    return AcademicExcellence::where('ae_app_id', $id)->exists();
}
function generateApplicationIdNA()
{
    $id = 'PUPT-' . mt_rand(1000000000, 9999999999);
    if (applicationIdExistsNA($id)) {
        return generateApplicationIdNA();
    }
    return $id;
}
function applicationIdExistsNA($id)
{
    return NonAcademicApplicant::where('nonacad_app_id', $id)->exists();
}
function shortUrl()
{
    return config('app.url');
}
function expectedHeadings()
{
    return [
        'email_address',
        'surname',
        'first_name',
        'middle_name',
        'course',
        'year_level',
        'contact_number',
        'gwa_1st',
        'gwa_2nd',
        'applying_for',
        'gen_avg',
        'remarks',
        'comments'
    ];
}


function format_decimal($number)
{
    if (substr((string) $number, -1) >= 5) {
        return number_format($number, 3);
    } else {
        return number_format($number, 2);
    }
}

function awardIcon($award)
{
    if ($award == 'AA' || $award == 'DL' || $award == 'PL' || $award == 'AE') {
        return '<img src="https://img.icons8.com/color/48/null/medal.png" />';
    } else if ($award == 'LA') {
        return '<img src="https://img.icons8.com/color/48/null/leadership--v2.png"/>';
    } else if ($award == 'AYA') {
        return '<img src="https://img.icons8.com/color/48/null/trophy.png"/>';
    } else if ($award == 'OOA') {
        return '<img src="https://img.icons8.com/color/48/null/conference-foreground-selected.png"/>';
    } else if ($award == 'BTA') {
        return '<img src="https://img.icons8.com/color/48/null/signing-a-document.png"/>';
    } else if ($award == 'GOP') {
        return '<img src="https://img.icons8.com/color/48/null/podium-with-speaker.png"/>';
    } else if ($award == 'GSA') {
        return '<img src="https://img.icons8.com/color/48/null/yours.png"/>';
    } else if ($award == 'OC') {
        return '<img src="https://img.icons8.com/color/48/null/contest.png"/>';
    } else if ($award == 'GPDT') {
        return '<img src="https://img.icons8.com/color/48/null/tango.png"/>';
    } else if ($award == 'GPCG') {
        return '<img src="https://img.icons8.com/color/48/null/choir--v2.png"/>';
    }
}
