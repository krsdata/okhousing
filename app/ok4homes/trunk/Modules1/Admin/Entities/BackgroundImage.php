<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BackgroundImage extends Authenticatable
{
    protected $table = "background_image";
    protected $fillable = ['image'];
   
}
