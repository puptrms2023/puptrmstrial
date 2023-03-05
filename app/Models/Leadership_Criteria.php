<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leadership_Criteria extends Model
{
    use HasFactory;
    protected $table = 'leadership_criteria';
    protected $fillable = [
        'n_id',
        'academic_performance',
        'projects_initiated',
        'officership',
        'awards_received',
        'community_outreach',
        'interview'
    ];
}
