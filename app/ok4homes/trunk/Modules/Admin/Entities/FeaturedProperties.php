<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturedProperties extends Model
{
    protected $table = "featured_property"; 
    protected $fillable = ['property_id','amount','start','end','payment'];


    public function property_data() {
        return $this->belongsTo("Modules\Properties\Entities\PropertyList","property_id","id");
    }

    public function property_image_data() {
        return $this->belongsTo("Modules\Properties\Entities\PropertyImages","property_id","property_id");
    }

    //fetch slider utility based on module id.
    public function utility_data() {
        return $this->belongsTo("Modules\Users\Entities\UserModules","property_id","id");
    }

    //fetch slider utility based on module id.
    public function created_users() {
        return $this->belongsTo("Modules\Users\Entities\UserModules","property_id","id");
    }


}
