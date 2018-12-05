<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route; 
use URL;
use View;
use Redirect;
use Config;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        if (!Auth::guard($guard)->check()) 
        {
            if ($request->ajax()) 
            { 
                return response([
                    'error' => 'unauthorized',
                    'error_description' => 'Failed authentication.',
                    'data' => [],
                ], 401);
            } 
            else 
            {
                return redirect('/o4k');
            }

        }

        $property = ['neighborhood','amenities','CategoryType','property_category','building_unit','land_unit','property_list'];



        if(Auth::guard($guard)->check() && !$request->ajax()){
            $user_id =   Auth::guard($guard)->user()->id;

            $user = Auth::guard($guard)->user();
            $role = $user->role_details;
            if($role){

                $data    = json_decode($user->role_details);
                $cid     = \Session::get('country')->country_id;
                $role_id = ($data->countries)->$cid;
                
                $permission = \DB::table('role_permissions')->where('role_id',$role_id )->pluck('permission_id');
                $all_permission_module = \DB::table('permissions')->whereIn('id',$permission )->pluck('slug')->toArray();
           //    dd($all_permission_module);
                $controllerAction          = (Route::getCurrentRoute());
           //   dd($controllerAction);
                $Modules = \DB::table('modules')->pluck('module_name','slug');  
                 //   $country_id = \DB::table('countries')->where('id',$cid )->first();
                 //   $country = \DB::table('all_countries')->where('id',$country_id->country_id)->first();
                    
                $url    = $request->getpathInfo();
                $m      = explode('/', $url);
                
                $modules_name = isset($m[2])?$m[2]:'';


                if(!isset($m[3])){
                    $validate_module = 'view';
                }

                if(isset($m[3])){
                     $validate_module = $m[3];
                }

                if(isset($m[3]) && $m[3]=='user'){
                    return $next($request);
                }

                if(in_array($modules_name, $property)){
                    $modules_name = 'property';
                }

                //dd($modules_name);
                $action = [];
                foreach ($all_permission_module as $key => $value) {

                    $arr = explode('-', $value);
                   
                      if(in_array($modules_name, $arr) || in_array(rtrim($modules_name,'s'), $arr)){
                        $view=1;
                        $action[] = $arr[0];
                        
                    }
                }

                if(!empty($action) && !in_array($validate_module, $action)){
                    
                     $pu = URL::previous();
                    
                }
              }
            if(isset($pu)){
                return Redirect::back()->with('permission_msg', 'Your are not allowed to perform this action!');
            }
        }

        return $next($request);
    }
}
