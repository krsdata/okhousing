<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsUpdates extends Model
{
    protected $table = "news_updates"; 
    protected $fillable = ['title','content','image'];

    //get all languages
    public function created_language() {
        return $this->belongsTo("Modules\Countries\Entities\Alllanguages","language_id","id");
    }

    //get created NewsUpdates based on it's parent id.
    public function types() {
    return $this->hasMany("Modules\Admin\Entities\NewsUpdates","parent_id");
    }

  

}
