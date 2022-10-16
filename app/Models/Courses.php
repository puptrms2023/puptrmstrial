<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'courses';

    protected $fillable = ['course_code', 'course'];

    public function applicants()
    {
        return $this->hasMany(StudentApplicant::class, 'course_id');
    }
}
