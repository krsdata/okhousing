<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Builders extends Model
{
     use SoftDeletes;
    protected $table = "builders";

    protected $fillable = ['user_id','builder_name','mobile','established_year','post_code']; 

    protected $dates = ['deleted_at'];
}
