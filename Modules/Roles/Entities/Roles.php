<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;
    protected $table = "roles"; 
    protected $fillable = ['name','slug','status'];
	protected $dates = ['deleted_at'];

	//save data to role permissions table 
	public function add_permissions(){
        return $this->belongsToMany("Modules\Permissions\Entities\Permissions","role_permissions","role_id","permission_id") ;
    }
}
