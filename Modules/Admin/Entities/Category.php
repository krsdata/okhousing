<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = "categories"; 
    protected $fillable = ['title','master_category_id','status'];

    //get all languages
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }

    //get created category based on it's parent id.
    public function types() {
    return $this->hasMany("Modules\Admin\Entities\Category","parent_id");
    }

    //get category Type
    public function created_type() {
        return $this->belongsTo("Modules\Admin\Entities\CategoryType","master_category_id","id");
    }

}
