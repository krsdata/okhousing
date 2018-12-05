<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    protected $table = "role_permissions";
    protected $fillable = ['role_id','permission_id'];

}
