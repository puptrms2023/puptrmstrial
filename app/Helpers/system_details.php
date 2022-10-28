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
function getSignatories()
{
    $names = Signature::all();
    return $names;
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
    return 'http://127.0.0.1:8000';
}
