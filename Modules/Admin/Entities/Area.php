<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table = "project_areas";
    protected $fillable = ['name','country','unit','unit_th','status','name_th','contents'];


    public function units() {
    	return $this->belongsTo("Modules\Projects\Entities\LandUnits","unit");
    }

    public function unitTh() {
    	return $this->belongsTo("Modules\Projects\Entities\LandUnits","unit_th");
    }

}
