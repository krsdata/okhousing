<?php

namespace Modules\Projects\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Projects\Entities\Landarea;
use Modules\Countries\Entities\Countrylangs;
use Yajra\DataTables\DataTables;
use \Validator;
use \Illuminate\Support\Facades\Session;

use Modules\Countries\Entities\Countries;


class AdminLandAreaController extends Controller
{

/**
    * Display a listing of the resource.
    * @return Response
*/

    public function index()
    {
        
        return view('projects::admin.landarea.index');
    }

/**
    * Display a listing of the resource.
    * @return Response
*/
	public function allprojectarea()
	{
		return Datatables::of(Landarea::with('created_language')->where('language_id',1)->orderBy('id', 'DESC')->get())->make(true);
	}

/**
    * Show the form for creating a new resource.
    * @return Response
*/

    public function create()
    {
		$countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $languages = Countrylangs::with('languages')->where('language_id','!=',1)->get();
        return view('projects::admin.landarea.create',compact('languages','countries'));
        
    }

/**
    * Store a newly created resource in storage.
    * @param  Request $request
    * @return Response
*/

    public function store(Request $request)
    {
       // $this->validate($request, ['area_en' => 'required|unique:project_land_area,land_area']);

        $desc_language = $request->desc_language;
        $title_entrys= 'area_'.$request->desc_language[0];
        $desc_entrys= 'slug_'.$request->desc_language[0];
        
        $project_area = new Landarea;
        $project_area->language_id  = $desc_language[0];
        $project_area->country_id   = $request->countries;
        $project_area->land_area    = $_POST[$title_entrys];
        $project_area->slug         = $_POST[$desc_entrys];   
        $project_area->status       = $request->status_en;
        try {
           // $units = $request->unit;
            $project_area->save();
            $id = $project_area->id;

            if($request->desc_language){
                for($i=1;$i< count($desc_language); $i++)
                {
                            $unit_entry = 'area_'.$desc_language[$i];
                            $slug_entry = 'slug_'.$desc_language[$i];
                            

                            $project_area = new Landarea;
                            $project_area->parent_id = $id;
                            $project_area->language_id = $desc_language[$i];
                            $project_area->land_area = $_POST[$unit_entry];
                            $project_area->slug =$_POST[$slug_entry];
                            $project_area->status = $request->status_en;
                            $project_area->country_id = $request->countries;
                            $project_area->save();

                }
            }

             
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Project area created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/projects/area/'),'csrf' => csrf_token()]);
        }
        catch (\Exception $e) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Project area not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
   
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $land_area = Landarea::with('types')->find($id);
        if($land_area==null){return redirect('/o4k/404');}
        else{
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
            $languages=Countrylangs::with('languages')->where('created_country_id',$land_area->country_id)->orderBy('language_id', 'ASC')->get()->toArray();

            return view('projects::admin.landarea.edit',compact('languages','land_area','countries'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        $landarea = Landarea::find($id);

        if($landarea==null){ 
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Project Area not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        else
        {
            $desc_language = $request->desc_language;
            $title_entrys= 'area_'.$request->desc_language[0];
            $desc_entrys= 'slug_'.$request->desc_language[0];

            $landarea->language_id = $desc_language[0];
            $landarea->country_id = $request->countries;
            $landarea->land_area = $_POST[$title_entrys];
            $landarea->slug = $_POST[$desc_entrys];   
            $landarea->status = $request->status_en;

            try
            {
                $landarea->save();
                
                Landarea::where('parent_id',$id)->get()->each->delete();

                if($request->desc_language){
                for($i=1;$i< count($desc_language); $i++)
                {
                            $area_entry = 'area_'.$desc_language[$i];
                            $slug_entry = 'slug_'.$desc_language[$i];
                            
                            $landarea = new landarea;
                            $landarea->parent_id = $id;
                            $landarea->language_id = $desc_language[$i];
                            $landarea->area = $_POST[$area_entry];
                            $landarea->slug =$_POST[$slug_entry];
                            $landarea->status = $request->status_en;
                            $landarea->country_id = $request->countries;
                            $landarea->save();

                }
            }
                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Project Area updated successfully !");
                return response()->json(['status'=>true,'url'=>URL('/o4k/projects/area/'),'csrf' => csrf_token()]);
            }
            catch (\Exception $e) {
               $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Project Area not updated successfully.".$e->getMessage()); 
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
        $landarea = Landarea::find($id);
        if($landarea==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $landarea->delete(); 
                Landarea::where('parent_id',$id)->get()->each->delete(); 
                Session::flash('val', 1);
                Session::flash('msg', "Project Area deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('/o4k/projects/area');
        }
    }

/**
    * Activate resource.
    * @return Response
*/

    public function activate($id)
    {
        $landarea = Landarea::find($id);
        if($landarea==null){return redirect('/o4k/404');}
        else
        { 
            try
            {  
                $landarea->status=1;
                $landarea->save();  
                 $list = Landarea::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = Landarea::find($l->id);
                    $amenities->status=1;
                    $amenities->save();
                } 
                Session::flash('val', 1);
                Session::flash('msg', "Project Area activated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('/o4k/projects/area');
        }
            
    }

/**
    * Deactivate resource.
    * @return Response
*/

    public function deactivate($id)
    {
        $landarea =  Landarea::find($id);
        if($landarea==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $landarea->status=0;
                $landarea->save(); 

                $list = Landarea::where('parent_id',$id)->get();
                foreach($list as $l)
                {
                    $amenities = Landarea::find($l->id);
                    $amenities->status=0;
                    $amenities->save();
                } 

                Session::flash('val', 1);
                Session::flash('msg', "Project Area deactivated successfully !");
            }catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('/o4k/projects/area');
        }
    }


    public function getlanguage($countryid,Request $request)
    {
        if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->orderBy('language_id', 'ASC')->get()->toArray();
            if(!empty($languages))
            {  

                 $returnHTML = (String) view('projects::admin.landarea.section.dynamic',compact('languages'));
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

                 $returnHTML = (String) view('projects::admin.landarea.section.dynamic_edit',compact('languages','parent_id'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }
}
