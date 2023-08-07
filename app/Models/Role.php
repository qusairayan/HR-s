<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

use Spatie\Permission\Traits\HasRoles;


class Role extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = 'roles';
     

    public function permissions()
    {
     
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

}
