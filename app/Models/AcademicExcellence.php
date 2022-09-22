<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicExcellence extends Model
{
    use HasFactory;
    protected $table = 'ae_applicants';

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
