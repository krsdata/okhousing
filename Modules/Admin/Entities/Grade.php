<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    protected $table = "project_grades"; 
    protected $fillable = ['name','country','description','status','description_th','name_th','country','contents'];
}
