<?php

namespace Modules\Module\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Modules extends Model
{
    use SoftDeletes;
    protected $table = "modules"; 
    protected $fillable = ['module_name','slug']; 
    protected $dates = ['deleted_at'];
	
    //fetch all countries based on country id
	public function created_countries() {
        return $this->belongsTo("Modules\Countries\Entities\Allcountries","country_id","id");
    }
    
    //add data to module_country
    public function module_Countries() 
    {
        return $this->belongsToMany("Modules\Countries\Entities\Countries","module_country","module_id","country_id");
    } 

    //fetch permissions based on module id.
    public function permissions() {
        return $this->hasMany("Modules\Permissions\Entities\Permissions","module_id","id");
    }
}
