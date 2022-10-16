<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Permission;
use App\Models\Permission as ModelsPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function permissions()
    {
        return $this->belongsToMany(ModelsPermission::class, 'roles_permissions');
    }
}
