<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AeApplicant extends Model
{
    use HasFactory;
    protected $table = 'ae_applicants';
    protected $fillable = [
        'user_id',
        'course_id',
        'gwa1',
        'gwa2',
        'gwa3',
        'gwa4',
        'gwa5',
        'gwa6',
        'gwa7',
        'gwa8',
        'image',
        'year_level',
        'award_applied',
    ];

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
}
