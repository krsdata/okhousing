<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Request;
use Response;


class Admin extends Authenticatable
{
    use SoftDeletes;
    protected $table = "admin_users";
    protected $fillable = ['name','email','password','image'];
    protected $hidden = ['password']; 
    protected $dates = ['deleted_at'];
    
    
    public static function uploadImage($request,$location,$fileName){

    	try {
            if ($request->file($fileName)) {
                $photo = $request->file($fileName);
                $destinationPath = storage_path('uploads/'.$location); 
                $photo->move($destinationPath, time() . $photo->getClientOriginalName());
                $photo_name = time() . $photo->getClientOriginalName();
                
                return  'storage/uploads/'.$location.'/' . $photo_name;
            //$request->merge(['photo'=>$photo_name]);
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
     
}
