<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SIS extends Model
{
    protected $table = 'awardees';
    protected $fillable = ['stud_num', 'first_name', 'last_name', 'course', 'gwa_1st', 'gwa_2nd', 'avg'];
}
