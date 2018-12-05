<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SearchRadius extends Model
{
    protected $table = "searchradius"; 
    protected $fillable = ['radius'];

    

}
