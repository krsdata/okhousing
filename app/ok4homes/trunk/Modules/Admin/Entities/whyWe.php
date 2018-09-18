<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class whyWe extends Model
{
    protected $table = "why_we"; 
    protected $fillable = ['title','subt_title','image'];

    //get all languages
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }

    //get created  Category Type  based on it's parent id.
    public function types() {
    return $this->hasMany("Modules\Admin\Entities\whyWe","parent_id");
    }

}
