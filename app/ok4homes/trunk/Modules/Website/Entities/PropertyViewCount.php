<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyViewCount extends Model
{
    protected $table = "property_view_count"; 
    protected $fillable = ['id','property_id'];
}
