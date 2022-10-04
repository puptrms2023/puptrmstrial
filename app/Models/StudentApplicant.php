<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentApplicant extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'gwa_1st',
        'gwa_2nd',
        'school_year',
        'year_level',
        'image',
        'award_applied',
    ];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function grades()
    {
        return $this->belongsTo(Summary::class, 'user_id', 'user_id');
    }
}
