<?php
namespace Modules\Projects\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class LandUnits extends Model
{
    use SoftDeletes;
    protected $table = "project_land_units"; 
    protected $fillable = ['language_id','land_unit','slug'];  
    protected $dates = ['deleted_at'];

    //FETCH LAND UNITS BASED ON IT'S PARENT ID.
    public function types() {
        return $this->hasMany("Modules\Projects\Entities\LandUnits","parent_id");
    }
    
    //FETCH CREATED LANGUAGES BASED ON LANGUAGE ID.
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
}
