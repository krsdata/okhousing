<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuildingUnits extends Model
{
    use SoftDeletes;
    protected $table = "project_building_units"; 
    protected $fillable = ['language_id','name','slug'];  
    protected $dates = ['deleted_at']; 
    
    //FETCH LANGUAGES BASED ON ID.
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
    
    //FETCH BUILDING UNITS  BASED ON IT'S PARENT ID.
    public function types() {
    return $this->hasMany("Modules\Projects\Entities\BuildingUnits","parent_id");
    }

    
}
