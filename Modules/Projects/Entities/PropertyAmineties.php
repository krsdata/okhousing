<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyAmineties extends Model
{
    use SoftDeletes;
    protected $table = "amenities4project"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = ['property_id','amenity_id'];
}
