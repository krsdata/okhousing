<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyCategory extends Model
{
     use SoftDeletes;
    protected $table = "property_category"; 
    protected $fillable = ['language_id','name','slug','icon']; 
    protected $dates = ['deleted_at'];

    public function created_language()
    {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
    public function types()
    {
        return $this->hasMany("Modules\Properties\Entities\PropertyCategory","parent_id");
    }


}
