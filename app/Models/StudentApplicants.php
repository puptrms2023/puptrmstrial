<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplicants extends Model
{
    use HasFactory;

    protected $table = 'student_applicants';
    protected $fillable = [
        'user_id',
        'gwa_1st',
        'gwa_2nd',
        'school_year',
        'year_level',
        'image',
        'award_applied',
    ];
}
