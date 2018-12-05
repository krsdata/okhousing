<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryType extends Model
{
    protected $table = "master_categories"; 
    protected $fillable = ['title','language_id','status'];

    //get all languages
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }

    //get created  Category Type  based on it's parent id.
    public function types() {
    return $this->hasMany("Modules\Admin\Entities\CategoryType","parent_id");
    }

}
