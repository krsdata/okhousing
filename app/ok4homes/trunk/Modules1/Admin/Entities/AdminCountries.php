<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminCountries extends Model
{
      use SoftDeletes;
    protected $table = "admin_country_role"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = ['admin_id','country_id','role_id'];
    
     
    
}
