<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobileapp extends Model
{
    protected $table = "mobileapp"; 
    protected $fillable = ['title','sub_title','image'];

    //get all languages
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }

    //get created menu based on it's parent id.
    public function types() {
    return $this->hasMany("Modules\Admin\Entities\Mobileapp","parent_id");
    }

}
