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
use Modules\Properties\Entities\SliderList;
use Modules\Properties\Entities\SliderPageOrder;
use Modules\Admin\Entities\FeaturedProperties;
use Modules\Website\Entities\Wishlist;
use Modules\Properties\Entities\PropertyNeighbourhoods;
use Modules\Admin\Entities\CategoryType;
use Mail;
use Config; 

class PropertyListController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($id = 0)
    {
        return view('properties::admin.property_lists.index',compact('id'));
    }



    public function allpropertylists($country = 0)
    {
        if($country == 0)
        {
            return Datatables::of(PropertyList::with('property_category')->orderBy('id', 'DESC')->get())->make(true);
        }
        else
        {
            return Datatables::of(PropertyList::with('property_category')->where("country_id",$country)->orderBy('id', 'DESC')->get())->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

       $builderId=Modules::select('id')->where('slug','builders')->first();
            $agentId=Modules::select('id')->where('slug','agent')->first();
            $ownerId=Modules::select('id')->where('slug','owner')->first();
            $users = UserModules::with('created_users')->where('module_id',$agentId->id)->orWhere('module_id',$builderId->id)->orWhere('module_id',$ownerId->id)->get();
       //dd($users);

        $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>1))->get();
     //   $property_types = PropertyType::where(array('status'=>1,'language_id'=>1))->get();


        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>1))->get();
        $landunits=LandUnits::where(array('status'=>1,'language_id'=>1))->get();
        $amineties=Amenities::where(array('status'=>1,'language_id'=>1))->get();
        $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>1))->get();

         $CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',1)->orderby('title','ASC')->get();

        return view('properties::admin.property_lists.create', compact('users','property_categories','countries','buildingunits','landunits','amineties','neighbourhoods','CategoryType'));



    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {


        $title_entrys= 'title_'.$request->desc_language[0];
        $Types_property = implode(',', $request->type_id);
        $propertylists = new PropertyList;
        $propertylists->user_id = $request->user_id; 
        $propertylists->name = ($_POST[$title_entrys])?$_POST[$title_entrys]:'Property';
        
        if($request->countries !== '1')
        {
            $created_language_id = $_POST['created_language_'.$request->desc_language[0]];

            $category = PropertyCategory::where('language_id',$created_language_id)->where('parent_id', $request->category_id )->first();
            $category_id = $propertylists->category_id =$category->id; 
        }
        else
        {
            $category_id = $propertylists->category_id =$request->category_id; 
        }

        
        $propertylists->type_id = $Types_property; 
        $propertylists->prize =$request->prize; 
		$propertylists->location =$request->location; 
        if($request->countries == '1')
        {
            $propertylists->country ='India'; 
        }
        else
        {
            $propertylists->country ='Thialand'; 
        }

        /*$propertylists->building_area =$request->building_area;
        $propertylists->building_unit_id=$request->building_unit; */
       
       
        /*$propertylists->bedroom =$request->bed_room; 
        $propertylists->bathroom =$request->bath_room; */

        if($request->building_area)
        {
            $propertylists->building_area =$request->building_area;
        }
        
        if($request->building_unit)
        {
            $propertylists->building_unit_id=$request->building_unit; 
        }



        if($request->bed_room)
        {
            $propertylists->bedroom =$request->bed_room; 
        }

        if($request->bath_room)
        {
            $propertylists->bathroom =$request->bath_room; 
        }


        if($request->land_area)
        {
             $propertylists->land_area =$request->land_area; 
        }
        if($request->land_unit)
        {
              $propertylists->land_unit_id=$request->land_unit; 
        }


        $propertylists->bulding_area_show =$request->bulding_area_show; 
        $propertylists->landarea_show =$request->landarea_show; 
        $propertylists->bedroom_show =$request->bedroom_show; 
        $propertylists->bathroom_show =$request->bathroom_show; 
        
       

        $propertylists->latitude =$request->lat; 
        $propertylists->longitude = $request->lng;
        $propertylists->mastercategory_id =$Types_property; 

                foreach($request->desc_language as $desc_language)
                    {
                        $created_country_id = 'created_country_'.$desc_language;
                         $created_language_id = 'created_language_'.$desc_language;
                        $propertylists->country_id = $_POST[$created_country_id];
                        $propertylists->language_id =$_POST[$created_language_id];
                    }

                $propertylists->status =$request->status;
                $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."propertys'");
                if (empty($tableStatus)) {
                    throw new \Exception("Table not found");
                }else
                {
                    /*$nextId = $tableStatus[0]->Auto_increment; 
                    $propertylists->uid=(10000+$nextId);
        */
                    $short_code=Modules::select('short_code')->where('slug','property')->first();
                    $nextId = $tableStatus[0]->Auto_increment; 
                    $propertylists->uid=$short_code->short_code.'-'.(10000+$nextId);
                    try{
                    $propertylists->save();
                    $id = $propertylists->id;
                    if($request->input('aminety')){
                     $propertylists->amineties()->attach($request->input('aminety'));
                    }


                    $neighbourhood = $request->input('neighbourhood');
                    $in_km = $request->input('in_km');
                    
                    if($request->input('neighbourhood') && $request->input('in_km')){
                        foreach ($neighbourhood as $key => $neigh){
                            if(!empty($in_km[$key]))
                            {
                                 $propertylists->neighbourhoods()->attach($neigh, ['kilometer' => $in_km[$key]]);
                            }
                                   
                        }        
                    }

                    /*if($request->input('neighbourhood') && $request->input('in_km')){
                        $kmvalue=array_filter($request->input('in_km'));
                        $kmvalue=array_values($kmvalue);
                            foreach (array_combine($request->input('neighbourhood') , $kmvalue) as $neighbourhood => $km){
                                $propertylists->neighbourhoods()->attach($neighbourhood, ['kilometer' =>  $km]);
                            }        
                    }*/

                    if($request->has('countries')){
                        /*foreach (array_combine($request->hidlang , $request->description ) as $language => $description){
                           $propertylists->countrylangs()->attach($language, ['country_id' => $request->countries,'description' =>  $description,'latitude' =>  $request->lat,'longitude' =>  $request->lng]);
                        }*/


                        foreach($request->desc_language as $desc_language)
                            {
                                $desc_entry = 'desc_'.$desc_language;
                                $title_entry = 'title_'.$desc_language;
                                $created_language_id = 'created_language_'.$desc_language;
                                $created_country_id = 'created_country_'.$desc_language;
                                $PropertyCountryLangs = new PropertyCountryLangs;
                                $PropertyCountryLangs->property_id = $nextId; 
                                $PropertyCountryLangs->country_id = $_POST[$created_country_id];
                                $PropertyCountryLangs->language_id =$desc_language;
                                $PropertyCountryLangs->country_created_id= $_POST[$created_country_id];
                                $PropertyCountryLangs->language_created_id =$_POST[$created_language_id];
                                $PropertyCountryLangs->title =$_POST[$title_entry]; 
                                $PropertyCountryLangs->description =$_POST[$desc_entry];
                                $PropertyCountryLangs->latitude =$request->lat; 
                                $PropertyCountryLangs->longitude = $request->lng;
                                $PropertyCountryLangs->save();

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

                $BuildingUnits = BuildingUnits::with('created_language')->where('language_id',1)->where('country_id',$countryid)->orderBy('id', 'DESC')->get();
                $landunits = LandUnits::with('created_language')->where('language_id',1)->where('country_id',$countryid)->orderBy('id', 'DESC')->get();

                $buHTML = (String) view('properties::admin.property_lists.section.dynamicbu',compact('BuildingUnits'));
                $luHTML = (String) view('properties::admin.property_lists.section.dynamiclu',compact('landunits'));

                
                $returnHTML = (String) view('properties::admin.property_lists.section.dynamic',compact('languages'));
                return response()->json(['status'=>true, 'html'=>$returnHTML,'csrf' => csrf_token() ,'buHTML' =>$buHTML ,'luHTML' =>$luHTML]);
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
       // echo"<pre>"; print_r($property_lists);die;

        if($property_lists==null) { return redirect('/o4k/404'); }
        else
        {
            $builderId=Modules::select('id')->where('slug','builders')->first();
            $agentId=Modules::select('id')->where('slug','agent')->first();
            $ownerId=Modules::select('id')->where('slug','owner')->first();
            $users = UserModules::with('created_users')->where('module_id',$agentId->id)->orWhere('module_id',$builderId->id)->orWhere('module_id',$ownerId->id)->get();


            $Propert_type=explode(',', $property_lists->mastercategory_id);
            if(!empty($property_lists->mastercategory_id)){
                 $Types_Count = count($Propert_type);
              }else{
                 $Types_Count=1;
              }
              /*  $newarray = array();
                for ($i=0; $i < $Types_Count ; $i++) 
                { 
                            $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$property_lists->language_id,'master_category_id'=> $Propert_type[$i]))->orderby('name','ASC')->get();
                            $property_categoriesedit[]= $property_categories;

                           

                }*/

                if($Types_Count)
                        {

                            $SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = 1 AND deleted_at IS NULL";

                            

                            if($Types_Count > 1)
                            {
                                $SQL .=" AND (   master_category_id  like '%".$Propert_type[0] ."%'";


                                for($i=1 ; $i< $Types_Count; $i++)
                                {
                                    $SQL .=" OR   master_category_id  like '%".$Propert_type[$i] ."%'";
                                }

                                $SQL .=")";
                            }
                            elseif($Types_Count == 1)
                            {
                                $SQL .=" AND  master_category_id  like '%".$Propert_type[0] ."%'";
                            }

                            $property_categoriesedit = DB::select($SQL);
                        }

           /* $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();*/
            $property_types = PropertyType::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
            $buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>1 ,'country_id'=>$property_lists->country_id))->get();
            $landunits=LandUnits::where(array('status'=>1,'language_id'=>1 , 'country_id'=>$property_lists->country_id))->get();

           /* $amineties=Amenities::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();*/

            $amineties=Amenities::where(array('status'=>1,'language_id'=>1))->get();



           /* $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();*/

            $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();

           
            $langugeDetails = PropertyCountryLangs::with('created_languages')->where('property_id',$id)->get();
            $galleryimages=PropertyImages::where('property_id',$id)->get();

           $CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',1)->orderby('title','ASC')->get();







            return view('properties::admin.property_lists.edit', compact('users','property_categories','property_types','countries','buildingunits','landunits','amineties','neighbourhoods','property_lists','langugeDetails','galleryimages','CategoryType','property_categoriesedit'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,Request $request)
    {

        //print_r($_POST);
        $Types_property = implode(',', $request->type_id);

      

        $propertylists = PropertyList::find($id);
        $propertylists->user_id = $request->user_id; 
         $title_entrys= 'title_'.$request->desc_language[0];
        $propertylists->name = ($_POST[$title_entrys])?$_POST[$title_entrys]:'Property'; 
        //$propertylists->category_id =$request->category_id; 
        if($request->countries == '1')
        {
            $propertylists->country ='India'; 
             $redire = 1;
        }
        else
        {
            $propertylists->country ='Thialand'; 
             $redire = 2;
        }

        

        if($request->countries !== '1')
        {
            $created_language_id = $_POST['created_language_'.$request->desc_language[0]];

            $category = PropertyCategory::where('language_id',$created_language_id)->where('parent_id', $request->category_id )->first();
            $category_id = $propertylists->category_id =$category->id; 
        }
        else
        {
            $category_id = $propertylists->category_id =$request->category_id; 
        }
        
        $propertylists->type_id =$Types_property; 
        $propertylists->prize =$request->prize; 
		$propertylists->location =$request->location;
        /*$propertylists->building_area =$request->building_area;
        $propertylists->building_unit_id=$request->building_unit; */
        $propertylists->land_area =$request->land_area; 
        $propertylists->land_unit_id=$request->land_unit; 
       /* $propertylists->bedroom =$request->bed_room; 
        $propertylists->bathroom =$request->bath_room; */
        $propertylists->status =$request->status;
        $propertylists->latitude =$request->lat; 
        $propertylists->longitude = $request->lng;
        $propertylists->mastercategory_id =$Types_property; 



        

 if($request->building_area)
        {
            $propertylists->building_area =$request->building_area;
        }
        
        if($request->building_unit)
        {
            $propertylists->building_unit_id=$request->building_unit; 
        }



        if($request->bed_room)
        {
            $propertylists->bedroom =$request->bed_room; 
        }

        if($request->bath_room)
        {
            $propertylists->bathroom =$request->bath_room; 
        }


        if($request->land_area)
        {
             $propertylists->land_area =$request->land_area; 
        }
        if($request->land_unit)
        {
              $propertylists->land_unit_id=$request->land_unit; 
        }


        $propertylists->bulding_area_show =$request->bulding_area_show; 
        $propertylists->landarea_show =$request->landarea_show; 
        $propertylists->bedroom_show =$request->bedroom_show; 
        $propertylists->bathroom_show =$request->bathroom_show; 
        
       
       
     /* foreach($request->desc_language as $desc_language)
                    {
                        $created_country_id = 'created_country_'.$desc_language;
                         $created_language_id = 'created_language_'.$desc_language;
                        $propertylists->country_id = $_POST[$created_country_id];
                        $propertylists->language_id =$_POST[$created_language_id];
                    }*/

        try{
            $propertylists->save();
            if($request->input('aminety')){
             $propertylists->amineties()->sync($request->input('aminety'));
            }
           /* if($request->input('neighbourhood') && $request->input('in_km')){
                $kmvalue=array_filter($request->input('in_km'));
                $kmvalue=array_values($kmvalue);
                    foreach (array_combine($request->input('neighbourhood') , $kmvalue) as $neighbourhood => $km){
                        $propertylists->neighbourhoods()->sync([$neighbourhood =>['kilometer' =>  $km]],false);
                    }        
            }*/

            	PropertyNeighbourhoods::where('property_id',$id)->get()->each->delete();

          		$neighbourhood = $request->input('neighbourhood');
          		$in_km = $request->input('in_km');
                if($request->input('neighbourhood') && $request->input('in_km')){
	                foreach ($neighbourhood as $key => $neigh){
	                    if(!empty($in_km[$key]))
	                    {
	                         $propertylists->neighbourhoods()->attach($neigh, ['kilometer' => $in_km[$key]]);
	                    }
	                           
	                }        
                }


            if($request->has('countries')){
                /*foreach (array_combine($request->hidlang , $request->description) as $language => $description){
                   $propertylists->countrylangs()->sync([ $language =>['country_id' => $request->countries],$language=>['description' =>  $description]], false);
                }*/


                foreach($request->desc_language as $desc_language)
                    {
                        $desc_entry = 'desc_'.$desc_language;
                        $title_entry = 'title_'.$desc_language;
                        $desc_language_entry = 'desc_language_'.$desc_language;
                        $desc_country_entry = 'desc_country_'.$desc_language;

                        $created_language_id = 'created_language_'.$desc_language;
                        $created_country_id = 'created_country_'.$desc_language;

                        $PropertyCountryLangs = PropertyCountryLangs::find($desc_language);
                        $PropertyCountryLangs->property_id = $id; 
                        $PropertyCountryLangs->country_id = $_POST[$desc_country_entry];
                        $PropertyCountryLangs->language_id =$_POST[$desc_language_entry]; 
                        $PropertyCountryLangs->title =$_POST[$title_entry]; 

                        
                        $PropertyCountryLangs->country_created_id= $_POST[$created_country_id];
                        $PropertyCountryLangs->language_created_id =$_POST[$created_language_id];


                        $PropertyCountryLangs->description =$_POST[$desc_entry];
                        $PropertyCountryLangs->latitude =$request->input('pro_lat') ; 
                        $PropertyCountryLangs->longitude = $request->input('pro_lang') ;
                        $PropertyCountryLangs->save();

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
            return response()->json(['status'=>true,'url'=>URL('/o4k/property_list/'. $redire ),'csrf' => csrf_token()]);
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
        if($propertylists->country_id == 1)
        {
            $redire = 1;
        }
        else
        {
            $redire = 2;
        }
		$user_id = $propertylists->user_id;
        $owners = Users::where('id',$user_id)->first();
        if($propertylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $propertylists->delete();

                $propertylists = SliderList::where('slider_element_id',$id)->where('slider_element_type','Property')->first();
                if( $propertylists)
                {
                    $slider_id = $propertylists->id;

                    SliderList::where('id',$slider_id)->get()->each->delete();
                    SliderPageOrder::where('slider_id',$slider_id)->get()->each->delete();

                }
               
                 FeaturedProperties::where('property_id',$id)->get()->each->delete();
                 Wishlist::where('property_id' ,$id)->get()->each->delete();
                

                    $toEmail=$owners->email;
                    $idpro = 10000 + $id;
                    $data=array('msg' => "Your property PRY-$idpro deactivated");
                    
                    $contactName='';
                    Mail::send('properties::admin.notification',  $data, function($message) use ($toEmail)
                    {
                        $message->to($toEmail);
                        $message->subject("Property activated");

                    });

                Session::flash('val', 1);
                Session::flash('msg', "Property List deleted successfully !");

            } catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_list/' .$redire );
        }
    }
	public function activate($id)
	{
		$propertylists = PropertyList::find($id);
        $user_id = $propertylists->user_id;
        $owners = Users::where('id',$user_id)->first();
        if($propertylists->country_id == 1)
        {
            $redire = 1;
        }
        else
        {
            $redire = 2;
        }
        
		if($propertylists==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$propertylists->status='Active';
				$propertylists->save();


                    $toEmail=$owners->email;
                    $idpro = 10000 + $id;
                    $data=array('msg' => "Your property PRY-$idpro activated");
                    
                    $contactName='';
                    Mail::send('properties::admin.notification',  $data, function($message) use ($toEmail)
                    {
                        $message->to($toEmail);
                        $message->subject("Property activated");

                    });

				Session::flash('val', 1);
                Session::flash('msg', "Property List activated successfully !");


			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_list/'.$redire);
        }
			
	}
	public function deactivate($id)
	{
		$propertylists = PropertyList::find($id);
        if($propertylists->country_id == 1)
        {
            $redire = 1;
        }
        else
        {
            $redire = 2;
        }
		if($propertylists==null){return redirect('/o4k/404');}
		else
        { 
            try
            { 
			
				$propertylists->status='Inactive';
				$propertylists->save();
				Session::flash('val', 1);
                Session::flash('msg', "Property List deactivated successfully !");
			}catch (Exception $ex) {
                Session::flash('val', 1);
                Session::flash('msg', $ex->getMessage());
            } 
            return redirect('o4k/property_list/'.$redire);
        }
	}

    public function DeleteImage($id)
    {
         $propertylists = PropertyImages::find($id);
        if($propertylists==null){return redirect('/o4k/404');}
        else
        { 
            try
            { 
                $propertylists->delete();
                return response()->json(['status'=>true]);


            } catch (Exception $ex) {
                return response()->json(['status'=>false]);
            } 
            
        }
    }


    public function selectcategory(Request $request)
    {
        
          if(!empty($request->id)){
             $Types_Count = count($request->id);
          }else{
             $Types_Count=1;
          }
            
        $newarray = array();
         if($Types_Count)
                {

                    $SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = 1 AND deleted_at IS NULL";

                    

                    if($Types_Count > 1)
                    {
                        $SQL .=" AND (   master_category_id  like '%".$request->id[0] ."%'";


                        for($i=1 ; $i< $Types_Count; $i++)
                        {
                            $SQL .=" OR   master_category_id  like '%".$request->id[$i] ."%'";
                        }

                        $SQL .=")";
                    }
                    elseif($Types_Count == 1)
                    {
                        $SQL .=" AND  master_category_id  like '%".$request->id[0] ."%'";
                    }

                    $newarray = DB::select($SQL);
                }

                 $resultdata ='<option value="">Select</option>';
                 foreach ($newarray as  $tasrow) { 
                   $resultdata .='<option value="'.$tasrow->id.'" data-bathroom_show="'.$tasrow->bathroom_show.'" data-bedroom_show="'.$tasrow->bedroom_show.'" data-bulding_area_show="'.$tasrow->bulding_area_show.'" data-landarea_show="'.$tasrow->landarea_show.'" >'.$tasrow->name.'</option>';
                 }

                 return $resultdata;
                  
    }



}
