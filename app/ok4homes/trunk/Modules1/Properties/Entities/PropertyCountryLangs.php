<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyCountryLangs extends Model
{
    use SoftDeletes;
    protected $table = "countrylanguages4property"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = ['property_id','country_id','language_id','description']; 
    
    public function created_languages() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
    
}
