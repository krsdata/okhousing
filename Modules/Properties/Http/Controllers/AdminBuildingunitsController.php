<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\BuildingUnits;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

use Modules\Countries\Entities\Countries;


class AdminBuildingunitsController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        return view('properties::admin.building_units.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function allbuildingunits()
    {
        return Datatables::of(BuildingUnits::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
    }

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('properties::admin.building_units.create',compact('languages','countries'));
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
        //$this->validate($request, ['unit_en' => 'required|unique_building_unit:property_building_units']);

        $desc_language = $request->desc_language;
        $title_entrys= 'unit_'.$request->desc_language[0];
        $desc_entrys= 'slug_'.$request->desc_language[0];
        
        $buildingunits = new BuildingUnits;
        $buildingunits->language_id = $desc_language[0];
        $buildingunits->country_id = $request->countries;
        $buildingunits->unit = $_POST[$title_entrys];
        $buildingunits->slug = $_POST[$desc_entrys];   
        $buildingunits->status = $request->status_en;
        try {
            $units = $request->unit;
            $buildingunits->save();
            $id = $buildingunits->id;

            if($request->desc_language){
                for($i=1;$i< count($desc_language); $i++)
                {
                            $unit_entry = 'unit_'.$desc_language[$i];
                            $slug_entry = 'slug_'.$desc_language[$i];
                            

                            $buildingunits = new BuildingUnits;
                            $buildingunits->parent_id = $id;
                            $buildingunits->language_id = $desc_language[$i];
                            $buildingunits->unit = $_POST[$unit_entry];
                            $buildingunits->slug =$_POST[$slug_entry];
                            $buildingunits->status = $request->status_en;
                            $buildingunits->country_id = $request->countries;
                            $buildingunits->save();

                }
            }

            /*if(!empty($units) && $units!=''){
                $languages = $request->language;
                $slugs = $request->slug;
                foreach($units as $key => $value):
                    $buildingunits = new BuildingUnits;
                    $buildingunits->parent_id = $id;
                    $buildingunits->language_id = $languages[$key];
                    $buildingunits->unit = $units[$key];
                    $buildingunits->slug = $slugs[$key];
                    $buildingunits->status = $request->status_en;
                    $buildingunits->save();
                endforeach;
            }*/
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Building Unit created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/building_unit/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Building Unit not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }


/**
    * Show the form for editing the specified resource.
    * @return Response
*/

    public function edit($id)
    {
        $building_unit = BuildingUnits::with('types')->find($id);
        if($building_unit==null){return redirect('/o4k/404');}
        else{
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
            $languages=Countrylangs::with('languages')->where('created_country_id',$building_unit->country_id)->orderBy('language_id', 'ASC')->get()->toArray();
            return view('properties::admin.building_units.edit',compact('languages','building_unit','countries'));
        }
    }

/**
    * Update the specified resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function update($id, Request $request)
    {
       /* $this->validate($request, [
            'unit_en' => "required|unique_building_unit:property_building_units,unit,$id,id"
        ]);*/

        $buildingunits = BuildingUnits::find($id);
        if($buildingunits==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Building Unit not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            
            $desc_language = $request->desc_language;
            $title_entrys= 'unit_'.$request->desc_language[0];
            $desc_entrys= 'slug_'.$request->desc_language[0];
            
            $buildingunits->language_id = $desc_language[0];
            $buildingunits->country_id = $request->countries;
            $buildingunits->unit = $_POST[$title_entrys];
            $buildingunits->slug = $_POST[$desc_entrys];   
            $buildingunits->status = $request->status_en;


            try
            {
                $buildingunits->save();
                $ids = $request->ids; 
                $units = $request->unit;

                BuildingUnits::where('parent_id',$id)->get()->each->delete();

                if($request->desc_language){
                for($i=1;$i< count($desc_language); $i++)
                {
                            $unit_entry = 'unit_'.$desc_language[$i];
                            $slug_entry = 'slug_'.$desc_language[$i];
                            
                            $buildingunits = new BuildingUnits;
                            $buildingunits->parent_id = $id;
                            $buildingunits->language_id = $desc_language[$i];
                            $buildingunits->unit = $_POST[$unit_entry];
                            $buildingunits->slug =$_POST[$slug_entry];
                            $buildingunits->status = $request->status_en;
                            $buildingunits->country_id = $request->countries;
                            $buildingunits->save();

                }
            }

               /* if(!empty($units) && $units!=''){
                    $languages = $request->language;
                    $slugs = $request->slug;
                    foreach($ids as $key => $value):
                        $buildingunits = BuildingUnits::find($value);
                        $buildingunits->parent_id = $id;
                        $buildingunits->language_id = $languages[$key];
                        $buildingunits->unit = $units[$key];
                        $buildingunits->slug = $slugs[$key];
                        $buildingunits->status = $request->status_en;
                        $buildingunits->save();
                    endforeach;
                }*/
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Building Unit updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/building_unit/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e) {
               $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Building Unit not updated successfully.".$e->getMessage()); 
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
        $building_units = BuildingUnits::find($id);
        if($building_units==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $building_units->delete();

                BuildingUnits::where('parent_id',$id)->get()->each->delete();


                Session::flash('val', 1);
                Session::flash('msg', "Building Unit deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/building_unit');
        }
    }

/**
    * Activate resource.
    * @return Response
*/

    public function activate($id)
    {
        $building_units = BuildingUnits::find($id);
        if($building_units==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $building_units->status=1;
                $building_units->save();

                $list = BuildingUnits::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = BuildingUnits::find($l->id);
                    $amenities->status=1;
                    $amenities->save();
                }

                Session::flash('val', 1);
                Session::flash('msg', "Building Unit activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/building_unit');
        }
            
    }

/**
    * Deactivate resource.
    * @return Response
*/

    public function deactivate($id)
    {
        $building_units = BuildingUnits::find($id);
        if($building_units==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
            
                $building_units->status=0;
                $building_units->save();


                 $list = BuildingUnits::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = BuildingUnits::find($l->id);
                    $amenities->status=0;
                    $amenities->save();
                }


                Session::flash('val', 1);
                Session::flash('msg', "Building Unit deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/building_unit');
        }
    }


    public function getlanguage($countryid,Request $request)
    {
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->orderBy('language_id', 'ASC')->get()->toArray();
            if(!empty($languages))
            {  

                 $returnHTML = (String) view('properties::admin.building_units.section.dynamic',compact('languages'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }


    public function getlanguage_edit($countryid,$parent_id,Request $request)
    {
       
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->orderBy('id', 'ASC')->get()->toArray();
            if(!empty($languages))
            {  

                 $returnHTML = (String) view('properties::admin.building_units.section.dynamic_edit',compact('languages','parent_id'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }

}
