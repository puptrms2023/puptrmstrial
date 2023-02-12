<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryAcadExcell extends Model
{
    use HasFactory;
    protected $table = 'summary_ae';

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
