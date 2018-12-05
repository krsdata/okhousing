<?php

namespace Modules\Projects\Entities;

use Illuminate\Database\Eloquent\Model;

class SliderPageOrder extends Model
{
    protected $table = "slider_page_order"; 
    protected $fillable = ['slider_id','row','column','page'];
}
