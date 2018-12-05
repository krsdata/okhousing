<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\AdminCountries;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
use Modules\Countries\Entities\Countries;
use Modules\Admin\Entities\BackgroundImage;

class AdminController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('admin::admin.admin_user_index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function allList()
    {
         return Datatables::of(Admin::orderBy('id', 'DESC')->get())->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
        $countries=Countries::with(array('created_countries'=>function($query){$query->where('status', 1);},'created_roles'))->get(); 
        return view('admin::admin.create',compact('countries'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        $this->validate($request, [ 'email' => 'required|unique:admin_users,email,NULL,id,deleted_at,NULL', ]);
      
        $admin = new Admin;
        $admin->name = $request->admin_name;
        $admin->email = $request->email;
        if($request->file('image'))
            $admin->image = $request->file('image')->store('admin_pics');
        else
            $admin->image = "";
        $admin->password = bcrypt($request->password);
        $admin->status = $request->status;
        try
        {
            $admin->save(); 
            $id = $admin->id;
            if($request->has('countries'))
            {
                foreach ($request->countries as $key => $value) {

                    $collection = new AdminCountries;
                    $collection->admin_id = $id;
                    $collection->country_id = $value;
                    $collection->role_id = $value;
                    $collection->save();
                }
            }
        
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Admin user created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/view'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e)
        {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Admin user not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
   
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $admin=Admin::find($id);
        if($admin==null){return redirect('/o4k/404');}
        else{
            $countries=Countries::with(array('created_countries'=>function($query){$query->where('status', 1);},'created_roles'))->get(); 
            $adminuser_countries = AdminCountries::where('admin_id',$id)->get();
            return view('admin::admin.edit',compact('countries','admin','adminuser_countries'));
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
            'email' => "required|unique:admin_users,email,$id,id", 
        ]);
      
        $admin = Admin::find($id);
        if($admin==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Admin User not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {           
            $admin->name = $request->admin_name;
            $admin->email = $request->email;
            if($request->file('image'))
                $admin->image = $request->file('image')->store('admin_pics');
            else
                $admin->image = "";
                $admin->password = bcrypt($request->password);
                $admin->status = $request->status;
            try
            {
                $admin->save(); 
                $id = $admin->id;
                if($request->has('countries'))
                {
                    foreach ($request->countries as $key => $value) {
                        $collection = new AdminCountries;
                        $collection->admin_id = $id;
                        $collection->country_id = $value;
                        $collection->role_id = $value;
                        $collection->save();
                        }
                }
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Admin user created successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/view'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e)
            {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Admin user not created successfully.".$e->getMessage()); 
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
        $admin = Admin::find($id);
        if($admin==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $admin->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Admin User deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/view');
        }
    }

/**
    * Enable the resources.
    * @return Response
*/

    public function activate($id)
    {
        $admin = Admin::find($id);
        if($admin==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $admin->status=1;
                $admin->save();
                Session::flash('val', 1);
                Session::flash('msg', "Admin User activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/view');
        }
            
    }

/**
    * Disable the resources.
    * @return Response
*/

    public function deactivate($id)
    {
        $admin = Admin::find($id);
        if($admin==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $admin->status=0;
                $admin->save();
                Session::flash('val', 1);
                Session::flash('msg', "Admin User deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/view');
        }
    }



     /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function background()
    {
        $image=BackgroundImage::first();
         return view('admin::admin.background',compact('image'));  
       
    }

      /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function storebackgroundimg(Request $request)
    {
        if($request->file('image')){
                $extension = $request->file('image')->getClientOriginalExtension();
                $imagename = time().'.'.$extension;
                $destinationPath = public_path() . "/images/Background/";
                $request->file('image')->move($destinationPath, $imagename);
                
                $query=BackgroundImage::find($request->id);
                $query->image = $imagename;
                $query->save();
                $request->session()->flash('val', 1);
            
                $request->session()->flash('msg', "Home : Background image updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/background/'),'csrf' => csrf_token()]);
       }
    }


}
