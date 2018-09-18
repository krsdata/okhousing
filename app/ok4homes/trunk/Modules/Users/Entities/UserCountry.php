<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCountry extends Model
{
    use SoftDeletes;
    
    protected $table = "user_countries";
    
    protected $fillable = ['mobile_number','location']; 

    protected $dates = ['deleted_at'];

    public function user_details() {
        return $this->belongsToMany("Modules\Users\Entities\UserCountry","users_details","user_countries_id","language_id")->withPivot('name','about_us','created_ip');
    }

    //fetch users based on module id.
    public function created_users() {
        return $this->belongsTo("Modules\Users\Entities\Users","user_id","id");
    }

    //fetch users based on module id.
    public function created_userdetails() {
        return $this->hasmany("Modules\Users\Entities\UserDetails","user_countries_id","id");
    }
}
