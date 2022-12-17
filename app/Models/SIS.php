<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SIS extends Model
{

    protected $table = 'awardees';
    protected $fillable = ['email_address', 'surname', 'first_name', 'middle_name', 'course', 'year_level', 'contact_number', 'gwa_1st', 'gwa_2nd', 'applying_for', 'gen_avg', 'remarks', 'comments'];
}
