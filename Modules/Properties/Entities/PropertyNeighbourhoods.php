<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyNeighbourhoods extends Model
{
    use SoftDeletes;
    protected $table = "neighbourhood4property"; 
    protected $dates = ['deleted_at']; 

    protected $fillable = ['property_id','neighbourhood_id','kilometer'];
}
