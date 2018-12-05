<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\Neighbourhood;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

class AdminNeighborhoodController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/
    public function index()
    {
        return view('properties::admin.neighborhood.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

	public function allneighbors()
	{
		return Datatables::of(Neighbourhood::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
	}

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
		$languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('properties::admin.neighborhood.create',compact('languages'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/
    
    public function store(Request $request)
    {
        $this->validate($request, ['name_en' => 'required|unique:property_neighborhood,name,NULL,id','slug_en' => 'required|unique:property_neighborhood,slug,NULL,id']);
		$neighborhood =   new Neighbourhood;
		if($request->file('image')){
        $extension = $request->file('image')->getClientOriginalExtension();
        $iconname = time().'.'.$extension;
        $destinationPath = public_path() . "/images/neighborhoods/";
        $request->file('image')->move($destinationPath, $iconname);
        $neighborhood->icon		 = $iconname;
		 
        } 
		else{ $neighborhood->icon		 ='null';}
		$neighborhood->language_id = $request->language_en;
        $neighborhood->name		 = $request->name_en;
        $neighborhood->slug		 = $request->slug_en;
		$neighborhood->status 	 = $request->status_en;
		
        try
        {
            $neighborhood->save();
			$names = $request->name;
            $id = $neighborhood->id;
            if(!empty($names) && $names!=''){
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($names as $key => $value):
                    $neighborhood = new Neighbourhood;
                    $neighborhood->parent_id = $id;
                    $neighborhood->language_id = $languages[$key];
                    $neighborhood->name = $names[$key];
                    $neighborhood->slug = $slugs[$key];
					$neighborhood->icon	='';
                    $neighborhood->status = $request->status_en;
                    $neighborhood->save();
                endforeach;
            }
		
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Neighborhood created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/neighborhood/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e)
        {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Neighborhood not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token(),'msg'=>$e->getMessage()]);
   
        }
		 
		 
    }

/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
        $neighbourhood = Neighbourhood::with('types')->find($id);
        if($neighbourhood==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
            return view('properties::admin.neighborhood.edit',compact('languages','neighbourhood'));
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
            'name_en' => "required|unique:property_neighborhood,name,$id,id",'slug_en' => "required|unique:property_neighborhood,slug,$id,id", 
        ]);

        $neighbourhoods = Neighbourhood::find($id);
        if($neighbourhoods==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Neighbourhood not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $neighbourhoods->name = $request->name_en;
            $neighbourhoods->language_id = $request->language_en;
            $neighbourhoods->slug = $request->slug_en;
            $neighbourhoods->status = $request->status_en;
            if($request->file('image')){
                $extension = $request->file('image')->getClientOriginalExtension();
                $iconname = time().'.'.$extension;
                $destinationPath = public_path() . "/images/neighborhoods/";
                $request->file('image')->move($destinationPath, $iconname);
                $neighbourhoods->icon = $iconname;
            }
            try{
                $neighbourhoods->save();
                $ids = $request->ids;
                $names = $request->name;
                if(!empty($names) && $names!=''){
                    $languages = $request->language;
                    $slugs = $request->slug;
                    if($ids){
                        foreach($ids as $key => $value):
                            $neighbourhoods = Neighbourhood::find($value);
                            $neighbourhoods->parent_id = $id;
                            $neighbourhoods->language_id = $languages[$key];
                            $neighbourhoods->name = $names[$key];
                            $neighbourhoods->slug = $slugs[$key];
                            
                            $neighbourhoods->status = $request->status_en;
                            $neighbourhoods->save();
                        endforeach;
                    }
                    
                }

                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Neighborhood updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/neighborhood/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Neighborhood not updated successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token(),'msg'=>$e->getMessage()]);
            } 

        }

    }

/**
    * Remove the specified resource from storage.
    * @return Response
*/

    public function destroy($id)
	
    {
		$neighborhood = Neighbourhood::find($id);
		if($neighborhood==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $neighborhood->delete();

                Neighbourhood::where('parent_id',$id)->get()->each->delete();


                Session::flash('val', 1);
                Session::flash('msg', "Neighborhood deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/neighborhood');
        }
    }

/**
    * Activate resource.
    * @return Response
*/

	public function activate($id)
	{
		$neighborhood = Neighbourhood::find($id);
		if($neighborhood==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$neighborhood->status=1;
				$neighborhood->save();


                $list = Neighbourhood::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = Neighbourhood::find($l->id);
                    $amenities->status=1;
                    $amenities->save();
                }



				Session::flash('val', 1);
                Session::flash('msg', "Neighborhood activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/neighborhood');
        }
			
	}

/**
    * Deactivate resource.
    * @return Response
*/

	public function deactivate($id)
	{
		$neighborhood = Neighbourhood::find($id);
		if($neighborhood==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$neighborhood->status=0;
				$neighborhood->save();


                $list = Neighbourhood::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = Neighbourhood::find($l->id);
                    $amenities->status=0;
                    $amenities->save();
                }


				Session::flash('val', 1);
                Session::flash('msg', "Neighborhood deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/neighborhood');
        }
	}
    
}
