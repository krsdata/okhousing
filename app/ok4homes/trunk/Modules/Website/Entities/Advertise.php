<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertise extends Model
{
    protected $table = "advertise"; 
    protected $fillable = ['name','email','phone','message'];
}
