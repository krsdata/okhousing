<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Properties\Entities\PropertyList;
use Modules\Countries\Entities\Countrylangs;
use Modules\Users\Entities\Users;
use Modules\Properties\Entities\PropertyType;
use Modules\Properties\Entities\PropertyCategory;
use Modules\Properties\Entities\PropertyCountryLangs;
use Modules\Countries\Entities\Countries;
use Modules\Properties\Entities\BuildingUnits;
use Modules\Properties\Entities\LandUnits;
use Modules\Properties\Entities\Amenities;
use Modules\Properties\Entities\Neighbourhood;
use Modules\Properties\Entities\PropertyImages;
use Yajra\DataTables\DataTables;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Module\Entities\Modules;
use Modules\Users\Entities\UserModules;

class PropertyListController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('properties::admin.property_lists.index');
    }

    public function allpropertylists()
    {
        return Datatables::of(PropertyList::with('property_category')->orderBy('id', 'DESC')->get())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $builderId=Modules::select('id')->where('slug','builders')->first();
        $agentId=Modules::select('id')->where('slug','agent')->first();
        $users = UserModules::with('created_users')->where('module_id',$agentId->id)->orWhere('module_id',$builderId->id)->get();

       
        $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>1))->get();
        $property_types = PropertyType::where(array('status'=>1,'language_id'=>1))->get();
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>1))->get();
        $landunits=LandUnits::where(array('status'=>1,'language_id'=>1))->get();
        $amineties=Amenities::where(array('status'=>1,'language_id'=>1))->get();
        $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>1))->get();
        return view('properties::admin.property_lists.create', compact('users','property_categories','property_types','countries','buildingunits','landunits','amineties','neighbourhoods'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

		$propertylists = new PropertyList;
        $propertylists->user_id = $request->user_id; 
        $propertylists->name =$request->property_name; 
        $propertylists->category_id =$request->category_id; 
        $propertylists->type_id =$request->type_id; 
        $propertylists->prize =$request->prize; 
		$propertylists->location =$request->location; 
        $propertylists->building_area =$request->building_area;
        $propertylists->building_unit_id=$request->building_unit; 
        $propertylists->land_area =$request->land_area; 
        $propertylists->land_unit_id=$request->land_unit; 
        $propertylists->bedroom =$request->bed_room; 
        $propertylists->bathroom =$request->bath_room; 
        
        
        $propertylists->status =$request->status;
        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."propertys'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
            $nextId = $tableStatus[0]->Auto_increment; 
            $propertylists->uid=(10000+$nextId);

            try{
            $propertylists->save();
            $id = $propertylists->id;
            if($request->input('aminety')){
             $propertylists->amineties()->attach($request->input('aminety'));
            }
            if($request->input('neighbourhood') && $request->input('in_km')){
                $kmvalue=array_filter($request->input('in_km'));
                $kmvalue=array_values($kmvalue);
                    foreach (array_combine($request->input('neighbourhood') , $kmvalue) as $neighbourhood => $km){
                        $propertylists->neighbourhoods()->attach($neighbourhood, ['kilometer' =>  $km]);
                    }        
            }
            if($request->has('countries')){
                foreach (array_combine($request->hidlang , $request->description ) as $language => $description){
                   $propertylists->countrylangs()->attach($language, ['country_id' => $request->countries,'description' =>  $description,'latitude' =>  $request->lat,'longitude' =>  $request->lng]);
                }
            }
            if($request->file('images')){
                $extension = $request->file('images')->getClientOriginalExtension();
                $imagename = time().'.'.$extension;
                $destinationPath = public_path() . "/images/properties/";
                $request->file('images')->move($destinationPath, $imagename);
                $propertylists->images4property()->attach($imagename, ['is_featured' => 1]);
            }
            if($request->file('gimage')){
                foreach ($request->file('gimage')  as $gimage) {
                    $extension = $gimage->getClientOriginalExtension();
                    $imagename = time().'_' . rand(100, 999) .'.'.$extension;
                    $destinationPath = public_path() . "/images/properties/";
                    $gimage->move($destinationPath, $imagename);
                    $propertylists->images4property()->attach($imagename, ['is_featured' => 0]);
                }
            }

            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property created successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_list/'),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Property not created successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
        }
       
    }


    /**
     * Return ajax response based on country id.
     * @return Response
     */

    public function getlanguage($countryid,Request $request)
    {
		if($request->ajax())
        {
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();
            if(!empty($languages))
            {  
                $returnHTML = (String) view('properties::admin.property_lists.section.dynamic',compact('languages'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token()]);
            }else{return response()->json(['status'=>false, 'message'=>'Oops something went wrong','csrf' => csrf_token()]);}
        }else{return redirect('/404');}
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('properties::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $property_lists = PropertyList::with('property_created_amenities','property_created_neighbourhoods')->find($id);

        if($property_lists==null) { return redirect('/o4k/404'); }
        else
        {
            $builderId=Modules::select('id')->where('slug','builders')->first();
            $agentId=Modules::select('id')->where('slug','agent')->first();
            $users = UserModules::with('created_users')->where('module_id',$agentId->id)->orWhere('module_id',$builderId->id)->get();

            $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>1))->get();
            $property_types = PropertyType::where(array('status'=>1,'language_id'=>1))->get();
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
            $buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>1))->get();
            $landunits=LandUnits::where(array('status'=>1,'language_id'=>1))->get();
            $amineties=Amenities::where(array('status'=>1,'language_id'=>1))->get();
            $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>1))->get();
            $langugeDetails = PropertyCountryLangs::with('created_languages')->where('property_id',$id)->get();
            $galleryimages=PropertyImages::where('property_id',$id)->get();
            return view('properties::admin.property_lists.edit', compact('users','property_categories','property_types','countries','buildingunits','landunits','amineties','neighbourhoods','property_lists','langugeDetails','galleryimages'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {
        $propertylists = PropertyList::find($id);
        $propertylists->user_id = $request->user_id; 
        $propertylists->name =$request->property_name; 
        $propertylists->category_id =$request->category_id; 
        $propertylists->type_id =$request->type_id; 
        $propertylists->prize =$request->prize; 
		$propertylists->location =$request->location;
        $propertylists->building_area =$request->building_area;
        $propertylists->building_unit_id=$request->building_unit; 
        $propertylists->land_area =$request->land_area; 
        $propertylists->land_unit_id=$request->land_unit; 
        $propertylists->bedroom =$request->bed_room; 
        $propertylists->bathroom =$request->bath_room; 
        $propertylists->status =$request->status;
        try{
            $propertylists->save();
            if($request->input('aminety')){
             $propertylists->amineties()->sync($request->input('aminety'));
            }
            if($request->input('neighbourhood') && $request->input('in_km')){
                $kmvalue=array_filter($request->input('in_km'));
                $kmvalue=array_values($kmvalue);
                    foreach (array_combine($request->input('neighbourhood') , $kmvalue) as $neighbourhood => $km){
                        $propertylists->neighbourhoods()->sync([$neighbourhood =>['kilometer' =>  $km]],false);
                    }        
            }

            if($request->has('countries')){
                foreach (array_combine($request->hidlang , $request->description) as $language => $description){
                   $propertylists->countrylangs()->sync([ $language =>['country_id' => $request->countries],$language=>['description' =>  $description]], false);
                }
            }

            if($request->file('images')){
                $extension = $request->file('images')->getClientOriginalExtension();
                $imagename = time().'.'.$extension;
                $destinationPath = public_path() . "/images/properties/";
                $request->file('images')->move($destinationPath, $imagename);
                $featuredImage=PropertyImages::select('id')->where(array('property_id'=>$id,'is_featured'=>1))->first();
                if($featuredImage){$featuredImage=PropertyImages::find($featuredImage->id);
                  $featuredImage->delete();}
                $propertylists->images4property()->sync([$imagename => ['is_featured' => 1]],false);
            }

            if($request->file('gimage')){
                foreach ($request->file('gimage')  as $gimage) {
                    $extension = $gimage->getClientOriginalExtension();
                    $imagename = time().'_' . rand(100, 999) .'.'.$extension;
                    $destinationPath = public_path() . "/images/properties/";
                    $gimage->move($destinationPath, $imagename);
                    $propertylists->images4property()->sync([$imagename => ['is_featured' => 0]],false);
                }
            }
            
            $request->session()->flash('val', 1);
            $request->session()->flash('msg', "Property updated successfully !");
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_list/'),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg', "Property not updated successfully.".$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
		$propertylists = PropertyList::find($id);
		if($propertylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $propertylists->delete();
                Session::flash('val', 1);
                Session::flash('msg', "Property List deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_list');
        }
    }
	public function activate($id)
	{
		$propertylists = PropertyList::find($id);
		if($propertylists==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$propertylists->status=1;
				$propertylists->save();
				Session::flash('val', 1);
                Session::flash('msg', "Property List activated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_list');
        }
			
	}
	public function deactivate($id)
	{
		$propertylists = PropertyList::find($id);
		if($propertylists==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$propertylists->status=0;
				$propertylists->save();
				Session::flash('val', 1);
                Session::flash('msg', "Property List deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_list');
        }
	}

}
