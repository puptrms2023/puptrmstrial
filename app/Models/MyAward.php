<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyAward extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'award_acronym', 'award_name', 'school_year'];
}
