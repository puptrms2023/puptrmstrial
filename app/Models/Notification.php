<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Notification extends Model
{
    use HasFactory, HasJsonRelationships;

    // protected $casts = [
    //     'data' => 'json'
    // ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'data->user_id', 'id');
    // }
}
