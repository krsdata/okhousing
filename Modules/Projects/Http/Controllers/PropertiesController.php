<?php

namespace Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Countries\Entities\Countrylangs;
use Modules\Users\Entities\Users;
use Modules\Projects\Entities\PropertyType;
use Modules\Projects\Entities\PropertyCategory;
use Modules\Projects\Entities\PropertyCountryLangs;
use Modules\Countries\Entities\Countries;
use Modules\Projects\Entities\BuildingUnits;
use Modules\Projects\Entities\LandUnits;
use Modules\Projects\Entities\Amenities;
use Modules\Projects\Entities\Neighbourhood;
use Modules\Projects\Entities\PropertyImages;
use \Validator;
use DB;
use \Illuminate\Support\Facades\Session;
use Modules\Module\Entities\Modules;
use Modules\Users\Entities\UserModules;

class projectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $fcountry_language  = Session::get('fcountry_language');
        $language_id = $fcountry_language['id'];

        $fcountry  = Session::get('fcountry');
        $countryid = $fcountry['created_country_id'];
        $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();

       // dd($languages);
        $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$language_id))->get();
        $property_types = PropertyType::where(array('status'=>1,'language_id'=>$language_id))->get();
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $building_units=BuildingUnits::where(array('status'=>1,'language_id'=>$language_id))->get();
        $land_units=LandUnits::where(array('status'=>1,'language_id'=>$language_id))->get();
        $amenities =Amenities::where(array('status'=>1,'language_id'=>$language_id))->get();
       // dd($amenities);
        $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$language_id))->get();
        return view('website::web.property.add_property', compact('users','property_categories','property_types','countries','building_units','land_units','amenities','neighbourhoods','languages'));

       
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('projects::create');
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
        return view('projects::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('projects::edit');
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
