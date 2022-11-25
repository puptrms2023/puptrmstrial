<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormReq extends Model
{
    use HasFactory;
    protected $table = 'form_req';
    protected $fillable = ['form_id', 'requirements'];
}
