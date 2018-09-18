<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyList extends Model
{
     use SoftDeletes;
    protected $table = "propertys";

    protected $fillable = ['property_code','user_id','name','category_id','type_id','prize','building_area','building_unit_id','land_area','land_unit_id','bedroom','bathroom']; 

    protected $dates = ['deleted_at'];

    public function property_category() {
        return $this->belongsTo("Modules\Properties\Entities\PropertyCategory","category_id","id");
    }

    public function property_type() {
        return $this->belongsTo("Modules\Properties\Entities\PropertyType","type_id","id");
    }

    public function users() {
        return $this->belongsTo("Modules\Users\Entities\Users","user_id","id");
    }

    public function buildingunits(){

         return $this->belongsTo("Modules\Properties\Entities\BuildingUnits","building_unit_id","id");
    }
    public function landunits(){

         return $this->belongsTo("Modules\Properties\Entities\LandUnits","land_unit_id","id");
    }

    public function property_created_amenities(){

         return $this->hasMany("Modules\Properties\Entities\PropertyAmineties","property_id","id");
    }

    public function property_created_neighbourhoods(){

         return $this->hasMany("Modules\Properties\Entities\PropertyNeighbourhoods","property_id","id");
    }

    public function amineties(){
        return $this->belongsToMany("Modules\Properties\Entities\Amenities","amenities4property","property_id","amenity_id") ;
    }

    public function neighbourhoods(){

         return $this->belongsToMany("Modules\Properties\Entities\Neighbourhood","neighbourhood4property","property_id","neighbourhood_id")->withPivot('kilometer');
    }
    public function countrylangs(){

         return $this->belongsToMany("Modules\Properties\Entities\PropertyCountryLangs","countrylanguages4property","property_id","language_id")->withPivot('country_id','description','latitude','longitude','location');
    }
    public function images4property(){
        return $this->belongsToMany("Modules\Properties\Entities\PropertyImages","images4property","property_id","image")->withPivot('is_featured');
    }

    public function property_image(){
        return $this->belongsTo("Modules\Properties\Entities\PropertyImages","property_id","id");
    }
    
}
