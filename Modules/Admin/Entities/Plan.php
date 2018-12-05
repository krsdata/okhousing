<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    protected $table = "plans"; 
    protected $fillable = ['name','image_size','features','status','price_in_india','price_in_thailand','country','plan_image_th','contents'];
}
