<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Module\Entities\Modules;
use Modules\Countries\Entities\Countries;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminModuleController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('module::admin.index');
    }
    
/**
    * Display a listing of the user resource.
    * @return Response
*/

    public function user_index()
    {
        return view('module::admin.user_index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function AllAdminModules()
    {
        return Datatables::of(Modules::orderBy('id', 'DESC')->where('module_type',2)->get())->make(true);
    }

/**
    * Display a listing of the user Modules.
    * @return Response
*/

    public function UserModulesList()
    {
        return Datatables::of(Modules::orderBy('id', 'DESC')->where('module_type','!=',2)->get())->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $module= Modules::select('id','module_name')->where('module_type',2)->orderBy('id', 'ASC')->get();
        return view('module::admin.create',compact('countries','module'));
    }
/**
    * Show the form for creating a new user Modules.
    * @return Response
*/

    public function user_create()
    {
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $module= Modules::select('id','module_name')->where('module_type','!=',2)->orderBy('id', 'ASC')->get();
        return view('module::admin.user_create',compact('countries','module'));
    }
    
/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        $this->validate($request, ['module_name' => 'required|unique:modules,module_name,NULL,id','module_slug' => 'required|unique:modules,slug,NULL,id'],['module_name.unique' => 'Module name has already taken on admin module or user module']);
        
        $module                 = new Modules;
        $module->module_name    = $request->module_name;
        $module->slug           = $request->module_slug;
        $module->module_type    = 2;
        $module->status         = $request->status;
        if(trim($request->module_Code) != ' ')
            $module->short_code     = trim($request->module_Code);
        
        if(trim($request->icon) != ' ')
            $module->icon     = trim($request->icon);
            $i=0;
        if ($request->parent_module != 'select')
        {
            $modules=Modules::find($request->parent_module);
            if($modules != null){ $module->parent = $request->parent_module; $i=1;}
        }else{$i=1;}
        
        if($i==1)
        {
            try
            {
                $module->save();
                $module->module_Countries()->attach($request->input('countries'));
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Module created successfully !");
                return response()->json(['status'=>true,'url'=>URL('o4k/modules/'),'csrf' => csrf_token()]);
            
            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Module not created successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
       
            }
        }
        else
        {
            return response()->json(['status'=>false,'parent'=>1,'csrf' => csrf_token(),'msg' =>  'You have selected a wrong parent']); 
        }
         
    }
    
/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function user_store(Request $request) 
    {
      
        $this->validate($request, ['module_name' => 'required|unique:modules,module_name,NULL,id',
                'module_slug' => 'required|unique:modules,slug,NULL,id'],
                    ['module_name.unique' => 'Module name has already taken on admin module or user module',
                    'module_slug.unique' => 'Module Slug has already taken on admin module or user module']
        );
        $module                 = new Modules;
        $module->module_name    = $request->module_name;
        $module->slug           = $request->module_slug;
        $module->module_type    = $request->module_type;
        $module->status         = $request->status;
        if(trim($request->module_Code) != ' ')
            $module->short_code     = trim($request->module_Code);

        if(trim($request->icon) != ' ')
            $module->icon     = trim($request->icon);

            $i=0;
        if ($request->parent_module != 'select')
        {
            $modules=Modules::find($request->parent_module);
            if($modules != null){ $module->parent = $request->parent_module; $i=1;}
        }else{$i=1;}

        if($i==1)
        {
            try
            {
                $module->save();
                $module->module_Countries()->attach($request->input('countries'));
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Module created successfully !");
                return response()->json(['status'=>true,'url'=>URL('o4k/modules/user'),'csrf' => csrf_token()]);

            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Module not created successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);

            }
        }
        else
        {
            return response()->json(['status'=>false,'parent'=>1,'csrf' => csrf_token(),'msg' =>  'You have selected a wrong parent']); 
        }   
    }


/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
        $module = Modules::with('module_Countries')->find($id);
        if($module==null || $module->module_type != 2) {  return redirect('/o4k/404'); }
        else
        {
            $allmodule= Modules::select('id','module_name')->where('module_type',2)->orderBy('id', 'ASC')->get();
            $countries=Countries::with(['created_countries'=>function($query) { $query->where('status', 1);  }])->get(); 
        }

	        return view('module::admin.edit',compact('module','countries','allmodule'));
    }
    
/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function user_edit($id)
    {
        $module = Modules::with('module_Countries')->find($id);
        if($module==null || $module->module_type == 2) {  return redirect('/o4k/404'); }
        else
        {
            $allmodule= Modules::select('id','module_name')->where('module_type','!=',2)->orderBy('id', 'ASC')->get();
            $countries=Countries::with(['created_countries'=>function($query) { $query->where('status', 1);  }])->get(); 
            return view('module::admin.user_edit',compact('module','countries','allmodule'));
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
            'module_name' => "required|unique:modules,module_name,$id,id",'module_slug' => "required|unique:modules,slug,$id,id", 
        ],
                    ['module_name.unique' => 'Module name has already taken on admin module or user module',
                    'module_slug.unique' => 'Module Slug has already taken on admin module or user module']
                );
        $module                 = Modules::find($id);
        $module->module_name    = $request->module_name;
        $module->slug           = $request->module_slug;
        $module->module_type    = 2;
        $module->status         = $request->status;
        if(trim($request->module_Code) != ' ')
            $module->short_code     = trim($request->module_Code);
        
        if(trim($request->icon) != ' ')
			
            $module->icon     = trim($request->icon);
            $i=0;
        if ($request->parent_module != 'select')
        {
            $modules=Modules::find($request->parent_module);
            if($modules != null){ $module->parent = $request->parent_module; $i=1;}
         }else{$i=1;}
        
        if($i==1)
        { 
            try
            {
                $module->save();
                $module->module_Countries()->sync($request->input('countries'));
    			
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Module updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('o4k/modules/'),'csrf' => csrf_token()]);
            
            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Module not updated successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
       
            }
        }
        else
        {
            return response()->json(['status'=>false,'parent'=>1,'csrf' => csrf_token(),'msg' =>  'You have selected a wrong parent']); 
        }
		
    }
    
/**
    * Update the specified resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function user_update($id,Request $request)
    {
            $this->validate($request, [
                'module_name' => "required|unique:modules,module_name,$id,id",'module_slug' => "required|unique:modules,slug,$id,id",],
                ['module_name.unique' => 'Module name has already taken on admin module or user module','module_slug.unique' => 'Module Slug has already taken on admin module or user module']
            );
            
            $module    =    Modules::find($id); 
            if($module==null || $module->module_type == 2) 
            {  
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Module not updated successfully.You are doing some some unauthorized activities"); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }else
            {
                
                $module->module_name    = $request->module_name;
                $module->slug           = $request->module_slug;
                $module->module_type    = $request->module_type;
                $module->status         = $request->status;
                if(trim($request->module_Code) != ' ')
                $module->short_code     = trim($request->module_Code);

                if(trim($request->icon) != ' ')

                $module->icon     = trim($request->icon);

                $i=0;
                if ($request->parent_module != 'select')
                {
                    $modules=Modules::find($request->parent_module);
                    if($modules != null){ $module->parent = $request->parent_module; $i=1;}
                 }
                 else{$i=1;}

                if($i==1)
                { 
                    try
                    {
                        $module->save();
                        $module->module_Countries()->sync($request->input('countries'));

                        $request->session()->flash('val', 1);
                        $request->session()->flash('msg', "Module updated successfully !");
                        return response()->json(['status'=>true,'url'=>URL('o4k/modules/user/'),'csrf' => csrf_token()]);

                    }
                    catch (\Exception $e)
                    {
                        $request->session()->flash('val', 0);
                        $request->session()->flash('msg', "Module not updated successfully.".$e->getMessage()); 
                        return response()->json(['status'=>false,'csrf' => csrf_token()]);

                    }
                }
                else
                {
                    return response()->json(['status'=>false,'parent'=>1,'csrf' => csrf_token(),'msg' =>  'You have selected a wrong parent']); 
                }
                
            }
    }

/**
    * Remove the specified resource from storage.
    * @return Response
*/

    public function destroy($id)
    {
	    $modules=Modules::find($id);
        if($modules==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $modules->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Module deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/modules');
        }
		
        
    }
    
/**
    * Remove the specified resource from storage.
    * @return Response
*/

    public function user_destroy($id)
    {
	   $modules=Modules::find($id);
        if($modules==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $modules->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Module deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/modules/user');
        }
		
        
    }
    
}
