<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Neighborhood extends Model
{
    protected $table = "project_neighborhoods"; 
    protected $fillable = ['name','country','distance','status','distance_th','name_th','country','contents'];
}
