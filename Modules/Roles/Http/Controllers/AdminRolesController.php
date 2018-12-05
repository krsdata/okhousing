<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Roles\Entities\Roles;
use Modules\Countries\Entities\Countries;
use Modules\Roles\Entities\ModuleCountries;
use Modules\Roles\Entities\RolePermissions;
use Modules\Module\Entities\Modules;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

class AdminRolesController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/
    
    public function index()
    {
        return view('roles::admin.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function allRoles()
    {
        return Datatables::of(Roles::orderBy('id', 'DESC')->get())->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
    	$countries=Countries::with('created_countries')->where('status',1)->get();
        return view('roles::admin.create',compact('countries'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {  
       $validate =  $this->validate($request, 
                [
                    'role_name' => 'required|unique:roles,name,NULL,id',
                    'country' => 'required'
                ]
            );

     //  dd( $request->all());

        $role = new Roles;
        $role->name = $request->role_name;
        $role->slug = $request->role_slug;
        $role->country_id = $request->country_id;
        $role->description = $request->description;
        $role->status = $request->status;
        try
        {
            $role->save();
            $id = $role->id;
            $role->add_permissions()->attach($request->input('permissions'));
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Role created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/roles/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e)
        {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Role not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
		
    }

/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
        $role = Roles::find($id);
        if($role==null){return redirect('/o4k/404');}
        else{

            $countries=Countries::with('created_countries')->where('status',1)->get();
            $modulecountry=ModuleCountries::where('country_id',$role->country_id)->get()->toArray();
            $resultArray=array();
                for($j=0;$j<count($modulecountry);$j++){
                    $modules=Modules::with('permissions')->where('status',1)->where('id',$modulecountry[$j]['module_id'])->first();
                    if($modules['permissions']){
                        $resultArray[$j]['module_id']=$modules->id;
                        $resultArray[$j]['module_name']=$modules->module_name;
                        $resultArray[$j]['permissions']=$modules->permissions;
                    }
                             
            }   
            foreach ($resultArray as $key => $value) {
                if(empty($value['permissions'][0]['id'])){
                    unset($resultArray[$key]);
                }
            }
            
            $resultArray = array_values($resultArray);
            $selectedpermsn=RolePermissions::where('role_id',$id)->get();
            return view('roles::admin.edit',compact('countries','role','resultArray','selectedpermsn'));
    
        }

    }

/**
    * Update the specified resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'role_name' => "required|unique:roles,name,$id,id",'role_slug' => "required|unique:roles,slug,$id,id", 
        ]);

        $role = Roles::find($id);
        if($role==null)
        {    $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Role not created successfully."); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else{
            $role->name = $request->role_name;
            $role->slug = $request->role_slug;
            $role->country_id = $request->country_id;
            $role->description = $request->description;
            $role->status = $request->status;
            try
            {
                $role->save();
                $id = $role->id;
                $role->add_permissions()->attach($request->input('permissions'));
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Role created successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/roles/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Role not created successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
       
            }
        }
        
    }

/**
    * Remove the specified resource from storage.
    * @return Response
*/

    public function destroy($id)
    {
		$roles = Roles::find($id);
		if($roles==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $roles->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Role deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/roles');
        }
    }

/**
    * Fetch permissions based on country id.
    * @return Response
*/

    public function getpermissions($countryId)
    {
    	$modulecountry=ModuleCountries::where('country_id',$countryId)->get()->toArray();
        $resultArray=array();
            for($j=0;$j<count($modulecountry);$j++){
                
                $modules=Modules::with('permissions')->where('status',1)->where('id',$modulecountry[$j]['module_id'])->first();


                if($modules['permissions']){
                    $resultArray[$j]['module_id']=$modules->id;
                    $resultArray[$j]['module_name']=$modules->module_name;
                    $resultArray[$j]['permissions']=$modules->permissions;
                }
                         
        }   
        foreach ($resultArray as $key => $value) {
            if(empty($value['permissions'][0]['id'])){
                unset($resultArray[$key]);
            }
        }
        
        $resultArray = array_values($resultArray);

       // print_r($resultArray);

    	return response()->json($resultArray);

    }

}
