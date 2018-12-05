<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;

class Allcountries extends Model
{
    protected $table = "all_countries";
    protected $fillable = ['name','flag','code','currency','currency_code','symbol'];
    /*
     * Listing the all countires in db.
     * @return Response
     */

    
    public function countries() 
    {
        return $this->belongsTo("Modules\Countries\Entities\Countries","id","country_id");
    } 
    
    
}
