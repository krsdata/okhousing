<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;

class ModuleCountries extends Model
{
    protected $table = "module_country";
    protected $fillable = ['module_id','country_id'];

    // fetch permissions based on module id.
    public function permissions() 
    {
        return $this->belongsTo("Modules\Permissions\Entities\Permissions","module_id","module_id");
    } 

    // fetch modules based on module id in relation table.
    public function modules() 
    {
        return $this->belongsTo("Modules\Module\Entities\Modules","module_id","id");
        
    } 

}
