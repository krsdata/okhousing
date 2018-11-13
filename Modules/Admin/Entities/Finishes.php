<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finishes extends Model
{
    protected $table = "project_finishes"; 
    protected $fillable = ['name','country','status','name_th','contents'];
}
