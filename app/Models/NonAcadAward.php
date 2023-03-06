<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonAcadAward extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
    ];
    public function nonacad_applicants()
    {
        return $this->hasMany(NonAcademicApplicant::class, 'nonacad_id');
    }
}
