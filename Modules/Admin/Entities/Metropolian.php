<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metropolian extends Model
{
    protected $table = "metropolian"; 
    

    //get all countries
    public function created_metropolian() {
        return $this->belongsTo("Modules\Countries\Entities\Allcountries","country_id","id");
    }

}
