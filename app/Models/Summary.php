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
        'app_id',
        'term',
        'subjects',
        'units',
        'grades',
        'sy'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function status()
    {
        return $this->hasMany(StudentApplicant::class);
    }
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
