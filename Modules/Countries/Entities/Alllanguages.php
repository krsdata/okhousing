<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;

class Alllanguages extends Model
{
    protected $table = "all_languages";
    protected $fillable = ['name','code'];

    public function created_language() 
    {
        return $this->belongsTo("Modules\Countries\Entities\Countrylangs","id","language_id");
    } 

}
