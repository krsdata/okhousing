<?php

namespace Modules\Module\Entities;

use Illuminate\Database\Eloquent\Model;

class ModuleCountry extends Model
{
     protected $table = "module_country";
    protected $fillable = ['module_id','country_id'];

    public function created_modules() 
    {
        return $this->belongsTo("Modules\Module\Entities\Modules","module_id","id");
    } 
}
