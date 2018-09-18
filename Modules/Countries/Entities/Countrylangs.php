<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Countrylangs extends Model
{
   use SoftDeletes;
    protected $table = "country_language";
	//protected $primaryKey = "id";
    protected $dates = ['deleted_at']; 

    protected $fillable = ['created_country_id','language_id'];
    
    /*
     * languages 
     */
    public function languages()
    {
    	return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
    
    /*
     * allcountries according to languages 
     */
    public function allcountries() {
        return $this->belongsTo("Modules\Countries\Entities\Allcountries","created_country_id","id");
    }

    // fetch all countries based on relation
    public function countries() {
        return $this->belongsTo("Modules\Countries\Entities\Countries","created_country_id","id");
    }

     


}
