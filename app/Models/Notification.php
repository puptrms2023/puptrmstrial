<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public function notif_award()
    {
        return $this->belongsTo(AcadAward::class, 'data', 'acad_code');
    }
}
