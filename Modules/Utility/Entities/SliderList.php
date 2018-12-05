<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderList extends Model
{
    protected $table = "slider"; 
    protected $fillable = ['slider_element_id','slider_element_type','page_type'];


    public function property_data() {
        return $this->belongsTo("Modules\Properties\Entities\PropertyList","slider_element_id","id");
    }

    //fetch slider utility based on module id.
    public function utility_data() {
        return $this->belongsTo("Modules\Users\Entities\UserModules","slider_element_id","id");
    }

   
}
