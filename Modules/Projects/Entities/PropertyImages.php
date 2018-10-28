<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyImages extends Model
{
    use SoftDeletes;
    protected $table = "images4project"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = ['property_id','image'];
}
