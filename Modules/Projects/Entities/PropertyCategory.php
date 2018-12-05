<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyCategory extends Model
{
     use SoftDeletes;
    protected $table = "project_category"; 
    protected $fillable = ['language_id','name','slug','icon']; 
    protected $dates = ['deleted_at'];

    public function created_language()
    {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }
    public function types()
    {
        return $this->hasMany("Modules\Projects\Entities\PropertyCategory","parent_id");
    }
     //get category Type
    public function created_type() {
        return $this->belongsTo("Modules\Admin\Entities\CategoryType","master_category_id","id");
    }


}
