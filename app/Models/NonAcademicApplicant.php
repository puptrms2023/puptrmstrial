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
    public function academics()
    {
        return $this->hasOne(Academic::class, 'n_id', 'id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'n_id');
    }
    public function officership()
    {
        return $this->hasMany(Officership::class, 'n_id');
    }
    public function awards()
    {
        return $this->hasMany(Award::class, 'n_id');
    }
    public function community_outreach()
    {
        return $this->hasMany(Community_Outreach::class, 'n_id');
    }
    public function interviews()
    {
        return $this->hasOne(Interview::class, 'n_id');
    }
    public function leadership_criteria()
    {
        return $this->hasOne(Leadership_Criteria::class, 'n_id');
    }
}
