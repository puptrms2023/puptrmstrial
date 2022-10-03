<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'permission_category';

    public function permission()
    {
        return $this->hasMany(Permission::class, 'category_id', 'id');
    }
}
