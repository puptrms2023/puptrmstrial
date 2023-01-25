<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicExcellence extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'ae_applicants';

    protected $dates = ['deleted_at'];

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
    public function award()
    {
        return $this->belongsTo(AcadAward::class, 'award_applied', 'id');
    }
    public function reasons()
    {
        return $this->belongsTo(Reason::class, 'reason', 'id');
    }
}
