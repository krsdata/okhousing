<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countries extends Model
{
    use SoftDeletes;
    protected $table = "countries"; 
    protected $dates = ['deleted_at']; 
    protected $fillable = ['country_id','status'];

    /*
     * Listing the admin created countiresonly.
     * @return Response
     */

    // fetch all countries based on relation
    public function created_countries() {
        return $this->belongsTo("Modules\Countries\Entities\Allcountries","country_id","id");
    }

    // fetch  roles based on relation with country
    public function created_roles() {
        return $this->hasMany("Modules\Roles\Entities\Roles","country_id","id");
    }

    // fetch data from country language table based on countrry ID.
    public function created_country_language() {
        return $this->hasMany("Modules\Countries\Entities\Countrylangs","created_country_id","id");
    }

    // save data to pivot table.
    public function countrylangs(){

         return $this->belongsToMany("Modules\Countries\Entities\Countrylangs","country_language","created_country_id","language_id")->withPivot('isDefault','font_path','is_active');
    }
}
