<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    protected $table = "projects"; 
//  protected $fillable = ['name','image_size','features','status'];


    public function getCategory(){

    	return $this->belongsTo('Modules\Projects\Entities\PropertyCategory','category');
    }


    public function getPlan(){

    	return $this->belongsTo('Modules\Admin\Entities\Plan','plan');
    }

    public function getBuilderName(){

    	return $this->belongsTo('Modules\Admin\Entities\Builder','builder_code');
    }


    public function getAmenities(){

    	return $this->belongsTo('Modules\Admin\Entities\Builder','amenities');
    }

    public function getNeighbourhood(){

    	return $this->belongsTo('Modules\Admin\Entities\Builder','neighbourhood');
    }

    public function getFinishes(){

    	return $this->belongsTo('Modules\Admin\Entities\Builder','finishes');
    }

    public function getgrade(){

    	return $this->belongsTo('Modules\Admin\Entities\Builder','grade');
    }
 

    
}
