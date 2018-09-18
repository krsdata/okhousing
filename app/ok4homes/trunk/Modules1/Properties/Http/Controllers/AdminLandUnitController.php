<?php

namespace Modules\Properties\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\LandUnits;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;
class AdminLandUnitController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('properties::admin.landunits.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/
	public function alllandunits()
	{
		return Datatables::of(LandUnits::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
	}

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
		$languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('properties::admin.landunits.create',compact('languages'));
        
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
		$this->validate($request, ['unit_en' => 'required|unique:property_land_units,land_unit,NULL,id','slug_en' => 'required|unique:property_land_units,slug,NULL,id']);
        $landunits = new LandUnits;
        $landunits->language_id = $request->language_en;
        $landunits->land_unit = $request->unit_en;
        $landunits->slug = $request->slug_en;   
        $landunits->status = $request->status_en;
        try {
            $units = $request->unit;
            $landunits->save();
            $id = $landunits->id;
            if(!empty($units) && $units!=''){
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($units as $key => $value):
                    $landunits = new LandUnits;
                    $landunits->parent_id = $id;
                    $landunits->language_id = $languages[$key];
                    $landunits->land_unit = $units[$key];
                    $landunits->slug = $slugs[$key];
                    $landunits->status = $request->status_en;
                    $landunits->save();
                endforeach;
            }
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Land Unit created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/land_unit/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Land Unit not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $land_unit = LandUnits::with('types')->find($id);
        if($land_unit==null){return redirect('/o4k/404');}
        else{
            $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
            return view('properties::admin.landunits.edit',compact('languages','land_unit'));
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
            'unit_en' => "required|unique:property_land_units,land_unit,$id,id",'slug_en' => "required|unique:property_land_units,slug,$id,id", 
        ]);

        $landunits = LandUnits::find($id);
        if($landunits==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Neighbourhood not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $landunits->language_id = $request->language_en;
            $landunits->land_unit = $request->unit_en;
            $landunits->slug = $request->slug_en;
            $landunits->status = $request->status_en;  
            try
            {
                $landunits->save();
                $ids = $request->ids;
                $units = $request->unit;
                if(!empty($units) && $units!=''){
                    $languages = $request->language;
                    $slugs = $request->slug; 
                    foreach($ids as $key => $value):
                        $landunits = LandUnits::find($value);
                        $landunits->parent_id = $id;
                        $landunits->language_id = $languages[$key];
                        $landunits->land_unit = $units[$key];
                        $landunits->slug = $slugs[$key];
                        $landunits->status = $request->status_en;
                        $landunits->save();
                    endforeach;
                }
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Land Unit updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/land_unit/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e) {
               $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Land Unit not updated successfully.".$e->getMessage()); 
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
        $landunits = LandUnits::find($id);
        if($landunits==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $landunits->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Land Unit deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/land_unit');
        }
    }

/**
    * Activate resource.
    * @return Response
*/

    public function activate($id)
    {
        $landunits = LandUnits::find($id);
        if($landunits==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $landunits->status=1;
                $landunits->save();
                Session::flash('val', 1);
                Session::flash('msg', "Land Unit activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/land_unit');
        }
            
    }

/**
    * Deactivate resource.
    * @return Response
*/

    public function deactivate($id)
    {
        $landunits =  LandUnits::find($id);
        if($landunits==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $landunits->status=0;
                $landunits->save();
                Session::flash('val', 1);
                Session::flash('msg', "Land Unit deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/land_unit');
        }
    }

}
