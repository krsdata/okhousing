<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Countries\Entities\Countries;
use Modules\Properties\Entities\PropertyList;
use Modules\Properties\Entities\PropertyCategory;
use Modules\Properties\Entities\PropertyType;
use Modules\Countries\Entities\Allcountries;
use Modules\Countries\Entities\Alllanguages;
use Modules\Properties\Entities\PropertyImages;
use Modules\Properties\Entities\BuildingUnits;
use Modules\Properties\Entities\LandUnits;
use Modules\Properties\Entities\Amenities;
use Modules\Properties\Entities\Neighbourhood;
use DB;
use Session;

class FrontPropertyController extends Controller
{
    

    /**
     * Display the property adding resource.
     * @return Response
     */
    public function view_post()
    {

            $property_categories = PropertyCategory::select('id','name')->where(array('status'=>1,'language_id'=>1))->get();
            $property_types = PropertyType::select('id','name')->where(array('status'=>1,'language_id'=>1))->get();
            $building_units = BuildingUnits::select('id','unit')->where(array('status'=>1,'language_id'=>1))->get();
            $land_units = LandUnits::select('id','land_unit')->where(array('status'=>1,'language_id'=>1))->get();
            $amenities = Amenities::select('id','name','icon')->where(array('status'=>1,'language_id'=>1))->get();
            $neighbourhoods = Neighbourhood::select('id','name')->where(array('status'=>1,'language_id'=>1))->get();
 
            return view('website::web.property.add_property',compact('property_categories','property_types','building_units','land_units','amenities','neighbourhoods','userCountry','defaultlanguageId'));
        
    }

    /**
     * Store a newly created property in storage.
     * @return Response
     */

    public function add_post(Request $request)
    {

        $propertylists = new PropertyList;
        $propertylists->user_id = 1; 
        $propertylists->name =$request->property_title; 
        $propertylists->category_id =$request->property_category; 
        $propertylists->type_id =$request->property_type; 
        $propertylists->prize =$request->property_prize; 
        $propertylists->building_area =$request->building_area;
        $propertylists->building_unit_id=$request->building_unit; 
        $propertylists->land_area =$request->land_area; 
        $propertylists->land_unit_id=$request->land_unit; 
        $propertylists->bedroom =$request->bedroom; 
        $propertylists->bathroom =$request->bathroom; 
        $propertylists->location =$request->location; 
        $propertylists->status =1;
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
                if($request->input('amenities')){
                 $propertylists->amineties()->attach($request->input('amenities'));
                }
                if($request->input('neighbourhood') && $request->input('km')){
                    $kmvalue=array_filter($request->input('km'));
                    $kmvalue=array_values($kmvalue);
                        foreach (array_combine($request->input('neighbourhood') , $kmvalue) as $neighbourhood => $km){
                            $propertylists->neighbourhoods()->attach($neighbourhood, ['kilometer' =>  $km]);
                        }        
                }
                if(Session::get('country_id')){
                    // foreach (array_combine($request->hidlang , $request->description) as $language => $description){
                    //    $propertylists->countrylangs()->attach($language, ['country_id' => $request->countries,'description' =>  $description]);
                    // }
                }
                if($request->file('images')){
                    foreach ($request->file('images')  as $gimage) {
                        $extension = $gimage->getClientOriginalExtension();
                        $imagename = time().'_' . rand(100, 999) .'.'.$extension;
                        $destinationPath = public_path() . "/images/properties/";
                        $gimage->move($destinationPath, $imagename);
                        $propertylists->images4property()->attach($imagename, ['is_featured' => 0]);
                    }
                }

                $request->session()->flash('val', 1);
                $request->session()->flash('msg', "Property created successfully !");
                return response()->json(['status'=>true,'url'=>URL('/property/post/'),'csrf' => csrf_token()]);
            }


            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', "Property not created successfully.".$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }

        }
        
       

    }
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('website::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('websitewebsite::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('website::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('website::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
