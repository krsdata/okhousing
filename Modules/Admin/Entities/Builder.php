<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Builder extends Model
{
    protected $table = "builders"; 
//    protected $fillable = ['name','image_size','features','status'];
}
