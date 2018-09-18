<?php

namespace Modules\Permissions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permissions extends Model
{
	
    use SoftDeletes;
    protected $table = "permissions"; 
    protected $fillable = ['name','slug','status','description'];
	protected $dates = ['deleted_at'];
	
	// fetch data from modules based on related module id.
	public function modules() {
        return $this->belongsTo("Modules\Module\Entities\Modules","module_id","id");
    }
    
	
}
