<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    protected $table = "menu"; 
    protected $fillable = ['title','link','status'];

    //get all languages
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }

    //get created menu based on it's parent id.
    public function types() {
    return $this->hasMany("Modules\Admin\Entities\Menu","parent_id");
    }

}
