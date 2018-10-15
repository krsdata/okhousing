<?php

namespace Modules\Permissions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Permissions\Entities\Permissions;
use Modules\Module\Entities\Modules;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

class AdminPermissionController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('permissions::admin.index');
    }

    public function allPermissions()
    {
        return Datatables::of(
        Permissions::with(array('modules'=>function($query){$query->select('modules.id','modules.module_name');})
        )->where('permissions.deleted_at',NULL)
        ->whereHas('modules', function ($query){$query->where('modules.status', '1');$query->where('modules.deleted_at',null);}))
        ->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
		$modules = Modules::where('status',1)->get();
        return view('permissions::admin.create',compact('modules'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        $this->validate($request, ['permission_name' => 'required|unique:permissions,name,NULL,id','permission_slug' => 'required|unique:permissions,slug,NULL,id']);

        $permission             =   new Permissions;
        $permission->name       =   $request->permission_name;
        $permission->module_id  =   $request->module_id;
        $permission->slug       =   $request->permission_slug; 
        $permission->status     =   $request->status;
		$permission->description=	$request->descriptions;
        try
        {
            $permission->save();

            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Permission created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/permissions/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e)
        {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Module not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }

/**
    * Show the specified resource.
    * @return Response
*/

    public function show()
    {
        return view('permissions::show');
    }

/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
		
        $permission = Permissions::find($id);
        if($permission==null){return redirect('/o4k/404');}
        else{
            $modules = Modules::where('status',1)->get();
            return view('permissions::admin.edit',compact('permission','modules'));
        }
        
    }

/**
    * Update the specified resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function update($id,Request $request)
    {
		$this->validate($request, [
            'permission_name' => "required|unique:permissions,name,$id,id",'permission_slug' => "required|unique:permissions,slug,$id,id", 
        ]);
		$permission    =   Permissions::find($id);
        if($permission==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Module not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $permission->name       =   $request->permission_name;
            $permission->module_id  =   $request->module_id;
            $permission->slug       =   $request->permission_slug; 
            $permission->status     =   $request->status;
            $permission->description=	$request->descriptions;
            try
            {
                $permission->save();

                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Permission updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/permissions/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Module not updated successfully.".$e->getMessage()); 
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
		$permissions=Permissions::find($id);

        if($permissions==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $permissions->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Permission deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/permissions');
        }
    }


}
	
