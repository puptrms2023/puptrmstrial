<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_id',
        'subject_id',
        'units',
        'year_level',
        'semester'
    ];
}
