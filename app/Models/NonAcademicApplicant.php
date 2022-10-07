<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonAcademicApplicant extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function orgs()
    {
        return $this->belongsTo(StudentOrganization::class, 'org_id', 'id');
    }
    public function nonacad()
    {
        return $this->belongsTo(NonAcadAward::class, 'nonacad_id', 'id');
    }
}
