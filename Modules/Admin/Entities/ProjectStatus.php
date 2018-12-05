<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectStatus extends Model
{
    protected $table = "project_status";
    protected $fillable = ['name','country','status','name_th','contents'];

 

}
