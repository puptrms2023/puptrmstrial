<?php

namespace App\Models;

use App\Models\Permission as ModelsPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    use HasFactory;

    public function permissions()
    {
        return $this->belongsToMany(ModelsPermission::class, 'roles_permissions');
    }
}
