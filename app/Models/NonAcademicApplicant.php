<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NonAcademicApplicant extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];

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
    public function reasons()
    {
        return $this->belongsTo(Reason::class, 'reason', 'id');
    }
}
