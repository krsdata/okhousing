<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SliderOrder extends Model
{
    protected $table = "slider_order"; 
    protected $fillable = ['row','column','page'];
}
