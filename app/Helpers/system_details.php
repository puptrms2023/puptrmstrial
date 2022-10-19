<?php

use App\Models\Setting;
use App\Models\Signature;

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
