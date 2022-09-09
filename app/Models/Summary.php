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
        return $this->hasMany(StudentApplicants::class);
    }
}
