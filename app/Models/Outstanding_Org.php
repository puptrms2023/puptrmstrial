<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outstanding_Org extends Model
{
    use HasFactory;
    protected $table = 'outstanding_org';
    protected $fillable = [
        'n_id',
        'projects_initiated',
        'awards_received',
        'community_involvement',
        'affiliation',
        'financial_statement'
    ];
}
