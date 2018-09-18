<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyImages extends Model
{
    use SoftDeletes;
    protected $table = "images4property"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = ['property_id','image'];
}
