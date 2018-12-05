<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModules extends Model
{
    use SoftDeletes;
    
    protected $table = "user_modules";
    
    protected $fillable = ['user_id','module_id']; 

    protected $dates = ['deleted_at'];

    public function user_types() {
        return $this->belongsTo("Modules\Module\Entities\Modules","module_id","id");
    }

    //fetch users based on module id.
    public function created_users() {
        return $this->belongsTo("Modules\Users\Entities\Users","user_id","id");
    }

    //fetch users based on module id.
    public function created_userdetails() {
        return $this->belongsTo("Modules\Users\Entities\UserDetails","user_id","id");
    }

    

}
