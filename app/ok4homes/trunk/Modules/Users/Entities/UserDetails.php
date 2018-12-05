<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    
    protected $table = "users_details";
    
    protected $fillable = ['user_id','language_id']; 

    protected $dates = ['deleted_at'];

}
