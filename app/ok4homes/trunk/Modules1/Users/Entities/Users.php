<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes;
    
    protected $table = "users";

    protected $fillable = ['name','email','password','image','phone'];

    protected $hidden = ['password']; 

    protected $dates = ['deleted_at'];
	
    //fetch data from user modules based on userid and module id.
	public function types() {
        return $this->belongsToMany("Modules\Users\Entities\UserModules","user_modules","user_id","module_id");
    }

    //fetch data from user modules based on userid and module id.
    public function user_details() {
        return $this->belongsToMany("Modules\Users\Entities\UserDetails","users_details","language_id")
        ->withPivot('name','about_us');
    }

    //fetch all usermodules based on userid.
    public function modules() {
        return $this->hasMany("Modules\Modules\Entities\Allusermodules","user_id","id");
    }

    public function created_types() {
        return $this->hasMany("Modules\Users\Entities\UserModules","user_id","id");
    }

    public function created_usercountries() {
        return $this->hasMany("Modules\Users\Entities\UserCountry","user_id","id");
    }

    //fetch builder details based on user
    public function created_builders() {
        return $this->hasMany("Modules\Users\Entities\Builders","user_id","id");
    }

    //fetch properties based on user
    public function created_properties() {
        return $this->hasMany("Modules\Properties\Entities\PropertyList","user_id","id");
    }



    public function create_builder() {
        return $this->belongsToMany("Modules\Users\Entities\Users","builders","user_id","builder_name")->withPivot('mobile','established_year','builder_logo','street_name','post_code','location');
    }

    
	
   
}
