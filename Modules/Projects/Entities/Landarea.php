<?php
namespace Modules\Projects\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class Landarea extends Model
{
    use SoftDeletes;
    protected $table = "project_land_area"; 
    protected $fillable = ['language_id','land_area','slug','country_id','parent_id'];  
    protected $dates = ['deleted_at'];

    //FETCH LAND UNITS BASED ON IT'S PARENT ID.
    public function types() {
        return $this->hasMany("Modules\Projects\Entities\Landarea","parent_id");
    }
    
    //FETCH CREATED LANGUAGES BASED ON LANGUAGE ID.
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
}
