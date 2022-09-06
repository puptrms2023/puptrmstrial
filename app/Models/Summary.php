<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $table = 'summary';
    protected $fillable = [
        'user_id',
        'term',
        'subjects',
        'units',
        'grades',
        'sy'
    ];
}
