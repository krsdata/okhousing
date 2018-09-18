<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\Amenities;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

class AdminAmenitiesController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('properties::admin.amenities.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function allamenities()
    {
        return Datatables::of(Amenities::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('properties::admin.amenities.create',compact('languages'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        $this->validate($request, ['name_en' => 'required|unique:property_amenities,name,NULL,id','slug_en' => 'required|unique:property_amenities,slug,NULL,id']);

        $amenities = new Amenities;
        if($request->file('image')){
        $extension = $request->file('image')->getClientOriginalExtension();
        $iconname = time().'.'.$extension;
        $destinationPath = public_path() . "/images/amenities/";
        $request->file('image')->move($destinationPath, $iconname);
        $amenities->icon = $iconname;
        }
        $amenities->language_id = $request->language_en;
        $amenities->name = $request->name_en;
        $amenities->slug = $request->slug_en;   
        $amenities->status = $request->status_en;
        try {
            $names = $request->name;
            $amenities->save();
            $id = $amenities->id;
            if(!empty($names) && $names!=''){
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($names as $key => $value):
                    $amenities = new Amenities;
                    $amenities->parent_id = $id;
                    $amenities->language_id = $languages[$key];
                    $amenities->name = $names[$key];
                    $amenities->slug = $slugs[$key];
                    $amenities->icon ='';
                    $amenities->status = $request->status_en;
                    $amenities->save();
                endforeach;
            }
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Amenities created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/amenities/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {

            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Amenities not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }

/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
        $amenities = Amenities::with('types')->find($id);
        if($amenities==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
            return view('properties::admin.amenities.edit', compact('languages','amenities'));
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
            'name_en' => "required|unique:property_amenities,name,$id,id",'slug_en' => "required|unique:property_amenities,slug,$id,id", 
        ]);
        
        $amenities = Amenities::find($id);
        if($amenities==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Amenities not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $amenities->language_id = $request->language_en;
            $amenities->name = $request->name_en;
            $amenities->slug = $request->slug_en;
            $amenities->status = $request->status_en;
            if($request->file('image')){
                $extension = $request->file('image')->getClientOriginalExtension();
                $iconname = time().'.'.$extension;
                $destinationPath = public_path() . "/images/amenities/";
                $request->file('image')->move($destinationPath, $iconname);
                $amenities->icon = $iconname;
            }
            try
            {
                $amenities->save();
                $ids = $request->ids;
                $names = $request->name;
                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    $slugs = $request->slug;
                    foreach($ids as $key => $value):
                        $amenities = Amenities::find($value);
                        $amenities->parent_id = $id;
                        $amenities->language_id = $languages[$key];
                        $amenities->name = $names[$key];
                        $amenities->slug = $slugs[$key];
                        $amenities->status = $request->status_en;
                        $amenities->save();
                    endforeach;
                }
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Amenities updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/amenities/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e) {

                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Amenities not updated successfully.".$e->getMessage()); 
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
		$amenities = Amenities::find($id);
		if($amenities==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $amenities->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Amenities deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/amenities');
        }
    }

/**
    * Activate resource.
    * @return Response
*/

	public function activate($id)
	{
		$amenities = Amenities::find($id);
		if($amenities==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$amenities->status=1;
				$amenities->save();
				Session::flash('val', 1);
                Session::flash('msg', "Amenities activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/amenities');
        }
			
	}

/**
    * Deactivate resource.
    * @return Response
*/

	public function deactivate($id)
	{
		$amenities = Amenities::find($id);
		if($amenities==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$amenities->status=0;
				$amenities->save();
				Session::flash('val', 1);
                Session::flash('msg', "Amenities deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/amenities');
        }
	}
    
}
