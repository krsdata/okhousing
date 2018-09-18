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
use Auth;
use Session;
use Modules\Countries\Entities\Countrylangs;
use Modules\Properties\Entities\PropertyCountryLangs;
use Modules\Properties\Entities\SliderList;
use Modules\Properties\Entities\SliderPageOrder;
use Modules\Admin\Entities\FeaturedProperties;
use Modules\Module\Entities\Modules;
use Modules\Website\Entities\Wishlist;
use Modules\Admin\Entities\CategoryType;
use Modules\Properties\Entities\PropertyNeighbourhoods;

class FrontPropertyController extends Controller
{
    

    public function index()
    {

        $ip= \Request::ip();
       if($ip =="::1")
                    {
                        $ip='112.133.248.102';
                    }
        $data = \Location::get($ip);
        if(!empty($data))
        {
            $IPData = $data;
        }
        else
        {
            $IPData = array();
        }
       
       // dd($IPData);

        $fcountry_language  = Session::get('fcountry_language');
        $language_id = $fcountry_language['id'];

        
        $fcountry  = Session::get('fcountry');
        $countryid = $fcountry['created_country_id'];
        $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();

       // dd($languages);
        $property_categories = PropertyCategory::where(array('status'=>'1','language_id'=>$language_id))->orderby('name','ASC')->get();


        $property_types = PropertyType::where(array('status'=>1,'language_id'=>$language_id))->get();
        $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
        $building_units=BuildingUnits::where(array('status'=>1,'language_id'=>$language_id,'country_id'=>$countryid))->get();
        $land_units=LandUnits::where(array('status'=>1,'language_id'=>$language_id,'country_id'=>$countryid))->get();
        $amenities =Amenities::where(array('status'=>1,'language_id'=>$language_id))->get();
       // dd($amenities);
        $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$language_id))->get();

        $CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$language_id)->orderby('id','ASC')->get();

        return view('website::web.property.add_property', compact('users','property_categories','property_types','countries','building_units','land_units','amenities','neighbourhoods','languages','CategoryType','IPData'));

       
    }

    

    /**
     * Store a newly created property in storage.
     * @return Response
     */

    public function add_post(Request $request)
    {

        /*echo dd($request->property_category); die;*/
        $fcountry  = Session::get('fcountry');
        $countryid = $fcountry['created_country_id'];

        $ffcountry_language = Session::get('fcountry_language');
        $Selected_lang = $ffcountry_language['id'];

        
        $property_categorycount=count($request->property_type);

        /*for( $count_prop_type=0; $count_prop_type<$property_categorycount; $count_prop_type++){
         $CategoryType[]=$request->property_category[$count_prop_type];


        }*/
        $Types_property = implode(',', $request->property_type);





        $title_entrys= 'title_'.$request->desc_language[0];
        $propertylists = new PropertyList;
        $propertylists->user_id = Auth::guard('front_user')->user()->id; 
        $propertylists->name = ($_POST[$title_entrys])?$_POST[$title_entrys]:'Property'; 
        
       if($countryid == '1')
        {
            $propertylists->country ='India'; 
        }
        else
        {
            $propertylists->country ='Thialand'; 
        }

        if($countryid !== 1 && $Selected_lang == '1')
        {

            $Countrylangs = Countrylangs::where('created_country_id',$countryid)->where('isDefault','1')->first();

            $category = PropertyCategory::where('language_id',$Countrylangs->language_id)->where('parent_id', $request->property_category)->first();
            $category_id = $propertylists->category_id =$category->id; 
        }
        else
        {
            $category_id =  $propertylists->category_id = $request->property_category; 
        }

       
        $propertylists->type_id =$Types_property; 
        $propertylists->prize =$request->property_prize;
         if($request->building_area)
        {
            $propertylists->building_area =$request->building_area;
        }
        
        if($request->building_unit)
        {
            $propertylists->building_unit_id=$request->building_unit; 
        }



        if($request->bedroom)
        {
            $propertylists->bedroom =$request->bedroom; 
        }

        if($request->bathroom)
        {
            $propertylists->bathroom =$request->bathroom; 
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
        
       
        $propertylists->location =$request->location; 
        $propertylists->status = 'Inactive';
        $propertylists->latitude =$request->input('pro_lat') ; 
        $propertylists->longitude = $request->input('pro_lang') ;
        $propertylists->country_id =$countryid; 
        $propertylists->language_id =$Selected_lang; 
        $propertylists->mastercategory_id =$Types_property; 

        //$PropertyCategory = PropertyCategory::where('id',$request->property_category)->first();
        




        /*if(!empty($request->property_category))
        {
             $propertylists->mastercategory_id =$PropertyCategory->master_category_id; 
        }*/



        $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."propertys'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {

            $short_code=Modules::select('short_code')->where('slug','property')->first();

            $nextId = $tableStatus[0]->Auto_increment; 
            $propertylists->uid=$short_code->short_code .'-'.(10000+$nextId);

            try{
                $propertylists->save();


                $id = $propertylists->id;
                if($request->input('amenities')){
                 $propertylists->amineties()->attach($request->input('amenities'));
                }

                if($request->input('neighbourhood') && $request->input('km')){
                   /* $kmvalue=array_filter($request->input('km'));
                    $kmvalue=array_values($kmvalue);*/

                    //dd($kmvalue);

                        foreach (array_combine($request->input('neighbourhood') ,$request->input('km')) as $neighbourhood => $km){
                            if(!empty($km))
                            {
                                 $propertylists->neighbourhoods()->attach($neighbourhood, ['kilometer' =>  $km]);
                            }
                           
                        }        
                }
                if($request->desc_language){
                    foreach($request->desc_language as $desc_language)
                    {
                        $desc_entry = 'desc_'.$desc_language;
                        $title_entry = 'title_'.$desc_language;

                        $created_language_id = 'created_language_'.$desc_language;
                        
                        $PropertyCountryLangs = new PropertyCountryLangs;
                        $PropertyCountryLangs->property_id = $nextId; 
                        $PropertyCountryLangs->country_id = $countryid;
                        $PropertyCountryLangs->language_id =$desc_language;

                        $PropertyCountryLangs->country_created_id= $countryid;
                        $PropertyCountryLangs->language_created_id =$_POST[$created_language_id];


                        $PropertyCountryLangs->title =$_POST[$title_entry]; 
                        $PropertyCountryLangs->description =$_POST[$desc_entry];
                        $PropertyCountryLangs->latitude =$request->input('pro_lat') ; 
                        $PropertyCountryLangs->longitude = $request->input('pro_lang') ;
                        $PropertyCountryLangs->save();

                    }
                    
                }
                if($request->file('images')){
                    $imgloop = 1;

                    $imageExt = array('jpg','png','jpeg');
                    foreach ($request->file('images')  as $gimage) {
                        $extension = $gimage->getClientOriginalExtension();

                        if(in_array(strtolower($extension), $imageExt))
                        {
                            $imagename = time().'_' . rand(100, 999) .'.'.$extension;
                            $destinationPath = public_path() . "/images/properties/";
                            $gimage->move($destinationPath, $imagename);
                            if($imgloop == 1)
                            {
                                $is_featured = 1;
                            }
                            else
                            {
                                $is_featured=0;
                            }
                            $propertylists->images4property()->attach($imagename, ['is_featured' => $is_featured]);
                        }
                        

                         $imgloop++;
                    }
                }

                $request->session()->flash('val', 1);
                $request->session()->flash('msg', trans('countries::home/home.success-popup-msg'));
                return response()->json(['status'=>true,'url'=>URL('/property/Add'),'csrf' => csrf_token()]);
            }


            catch (Exception $ex) {
                $request->session()->flash('val', 0);
                $request->session()->flash('msg', trans('countries::home/home.pronotcreated').$e->getMessage()); 
                return response()->json(['status'=>false,'csrf' => csrf_token()]);
            }

        }
        
       


    }
    
     public function destroy($id)
    {
        $propertylists = PropertyList::find($id);
        if($propertylists==null){

            return redirect('/o4k/404');}
        else
        { 
            if($propertylists->user_id == Auth::guard('front_user')->user()->id )
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
                    Session::flash('val', 1);
                    Session::flash('msg', trans('countries::home/home.prodeleted'));

                } catch (Exception $ex) {
                    Session::flash('val', 1);
                    Session::flash('msg', $ex->getMessage());
                } 

                return redirect('dashboard');
            }
            else
            {
                return redirect('/o4k/404');
            }
        }
    }
    

      public function Edit($id)
    {

 

         $property_lists = PropertyList::with('property_created_amenities','property_created_neighbourhoods')->find($id);

        if($property_lists==null) { return redirect('/o4k/404'); }
        else
        {
            if($property_lists->user_id == Auth::guard('front_user')->user()->id )
            {
                    $fcountry_language  = Session::get('fcountry_language');
                    $language_id = $fcountry_language['id'];

                    $fcountry  = Session::get('fcountry');
                    $countryid = $fcountry['created_country_id'];
                    $languages=Countrylangs::with('languages')->where('created_country_id',$property_lists->country_id)->get()->toArray();

                   /* $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$property_lists->language_id))->orderby('name','ASC')->get();*/

//This is for which Type select only that category shown.

                   $Propert_type=explode(',', $property_lists->mastercategory_id);
                   //print_r( $Propert_type);die;

                    if(!empty($property_lists->mastercategory_id)){
                         $Types_Count = count($Propert_type);
                      }else{
                         $Types_Count=1;
                      }
                       /* $newarray = array();
                        for ($i=0; $i < $Types_Count ; $i++) 
                        { 
                                    $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$property_lists->language_id,'master_category_id'=> $Propert_type[$i]))->orderby('name','ASC')->get();
                                     $property_categoriesedit[]= $property_categories;
                                     
                                $SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$language_id." AND deleted_at IS NULL";

                                $SQL .=" AND  master_category_id  like '%".$Propert_type[$i] ."%'";
                                $property_categoriesedit[] = DB::select($SQL);
                                 
                        }*/


                        $fcountry_language  = Session::get('fcountry_language');
                        $language_id = $fcountry_language['id'];

                        if($Types_Count)
                        {

                            $SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$language_id." AND deleted_at IS NULL";

                            

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

                      //  dd($property_categoriesedit);
                  $property_types = PropertyType::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();

                    $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
                   /* $building_units=BuildingUnits::where(array('status'=>1,'language_id'=>$property_lists->language_id,'country_id'=>$countryid))->get();
                    $land_units=LandUnits::where(array('status'=>1,'language_id'=>$property_lists->language_id,'country_id'=>$countryid))->get();
*/

                    $building_units=BuildingUnits::where(array('status'=>1,'language_id'=>$language_id ,'country_id'=>$property_lists->country_id))->get();
                    $land_units=LandUnits::where(array('status'=>1,'language_id'=>$language_id , 'country_id'=>$property_lists->country_id))->get();


                   
                    $amenities =Amenities::where(array('status'=>1,'language_id'=>$language_id))->get();
                    $langugeDetails = PropertyCountryLangs::with('pro_languages')->where('property_id',$id)->get();
                    $galleryimages=PropertyImages::where('property_id',$id)->get();
                    


                    $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$property_lists->language_id))->get();
                  
                   $CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$language_id)->orderby('id','ASC')->get();

                  
                    return view('website::web.property.edit_property', compact('users','property_categories','property_types','countries','building_units','land_units','amenities','neighbourhoods','property_lists','languages','galleryimages','langugeDetails','CategoryType','property_categoriesedit'));
                }
                else
                {
                    return redirect('/o4k/404'); 
                }
        }
       
    }


      /**
     * Store a newly created property in storage.
     * @return Response
     */

    public function update($id ,Request $request)
    {

       
        $Types_property = implode(',', $request->property_type);
        $propertylists = PropertyList::find($id);
        $propertylists->user_id = Auth::guard('front_user')->user()->id; 
        $title_entrys= 'title_'.$request->desc_language[0];
        $propertylists->name = ($_POST[$title_entrys])?$_POST[$title_entrys]:'Property'; 
       // $propertylists->category_id =$request->property_category; 
       

        $fcountry  = Session::get('fcountry');
        $countryid = $fcountry['created_country_id'];


        $ffcountry_language = Session::get('fcountry_language');
        $Selected_lang = $ffcountry_language['id'];

        if($countryid !== 1 && $Selected_lang == '1')
        {

            $Countrylangs = Countrylangs::where('created_country_id',$countryid)->where('isDefault','1')->first();

            $category = PropertyCategory::where('language_id',$Countrylangs->language_id)->where('parent_id', $request->property_category)->first();
            $requestcategory_id = $propertylists->category_id =$category->id; 
        }
        else
        {
            $requestcategory_id =  $propertylists->category_id = $request->property_category; 
        }


        $propertylistsfe = FeaturedProperties::find($id);
        if(!empty($propertylistsfe))
        {
            $propertylistsfe->category_id = $requestcategory_id; 
            $propertylistsfe->save();
        }
        


        $propertylists->type_id = $Types_property; 
        $propertylists->prize =$request->property_prize; 
       /* $propertylists->building_area =$request->building_area;
        $propertylists->building_unit_id=$request->building_unit; 
        $propertylists->land_area =$request->land_area; 
        $propertylists->land_unit_id=$request->land_unit; 
        /*$propertylists->bedroom =$request->bedroom; 
        $propertylists->bathroom =$request->bathroom; */

       
        if($countryid == '1')
        {
            $propertylists->country ='India'; 
        }
        else
        {
            $propertylists->country ='Thialand'; 
        }
        
        $propertylists->location =$request->location; 

         if($request->building_area)
        {
            $propertylists->building_area =$request->building_area;
        }
        
        if($request->building_unit)
        {
            $propertylists->building_unit_id=$request->building_unit; 
        }



        if($request->bedroom)
        {
            $propertylists->bedroom =$request->bedroom; 
        }

        if($request->bathroom)
        {
            $propertylists->bathroom =$request->bathroom; 
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
        
       

        $propertylists->status = 'Inactive';
        $propertylists->latitude =$request->input('pro_lat') ; 
        $propertylists->longitude = $request->input('pro_lang') ;
        $propertylists->mastercategory_id =$Types_property; 


         $PropertyCategory = PropertyCategory::where('id',$request->property_category)->first();
        
        /*if(!empty($PropertyCategory))
        {
             $propertylists->mastercategory_id =$PropertyCategory->master_category_id; 
        }*/

        try{
            $propertylists->save();
            $nextId = $id;

            if($request->input('aminety')){
             $propertylists->amineties()->sync($request->input('aminety'));
            }
            /*if($request->input('neighbourhood') && $request->input('in_km')){
                foreach (array_combine($request->input('neighbourhood') ,$request->input('in_km')) as $neighbourhood => $km){
                        if(!empty($km))
                        {
                            $propertylists->neighbourhoods()->sync([$neighbourhood =>['kilometer' =>  $km]],false);
                        }
                       
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

            

           if($request->desc_language){
                    foreach($request->desc_language as $desc_language)
                    {
                        $desc_entry = 'desc_'.$desc_language;
                        $title_entry = 'title_'.$desc_language;
                        $desc_language_entry = 'desc_language_'.$desc_language;
                        $desc_country_entry = 'desc_country_'.$desc_language;

                        $created_language_id = 'created_language_'.$desc_language;
                        $created_country_id = 'created_country_'.$desc_language;

                        $PropertyCountryLangs = PropertyCountryLangs::find($desc_language);
                        $PropertyCountryLangs->property_id = $nextId; 
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
                    $imgloop = 1;
                    
                    $propertylistsUp = PropertyImages::where('property_id',$nextId)->where('is_featured','1')->count();


                    $imageExt = array('jpg','png','jpeg');
                    foreach ($request->file('images')  as $gimage) {
                        $extension = $gimage->getClientOriginalExtension();

                        if(in_array(strtolower($extension), $imageExt))
                        {
                            $imagename = time().'_' . rand(100, 999) .'.'.$extension;
                            $destinationPath = public_path() . "/images/properties/";
                            $gimage->move($destinationPath, $imagename);
                            if($imgloop == 1 && $propertylistsUp < 1 )
                            {
                                $is_featured = 1;
                            }
                            else
                            {
                                $is_featured=0;
                            }
                            $propertylists->images4property()->attach($imagename, ['is_featured' => $is_featured]);
                        }
                        

                         $imgloop++;
                    }
                   /* foreach ($request->file('images')  as $gimage) {
                        $extension = $gimage->getClientOriginalExtension();
                        $imagename = time().'_' . rand(100, 999) .'.'.$extension;
                        $destinationPath = public_path() . "/images/properties/";
                        $gimage->move($destinationPath, $imagename);
                        if($imgloop == 1 && $propertylistsUp < 1 )
                        {
                            $is_featured = 1;
                        }
                        else
                        {
                            $is_featured=0;
                        }
                        $propertylists->images4property()->attach($imagename, ['is_featured' => $is_featured]);

                         $imgloop++;
                    }*/
                }

            
            $request->session()->flash('val', 1);
            $request->session()->flash('msg',  trans('countries::home/home.proupdated'));
            return response()->json(['status'=>true,'url'=>URL('/property/Edit/'.$id),'csrf' => csrf_token()]);
        }
        catch (Exception $ex) {
            $request->session()->flash('val', 0);
            $request->session()->flash('msg',  trans('countries::home/home.profailupdate').$e->getMessage()); 
            return response()->json(['status'=>false,'csrf' => csrf_token()]);
        }
       

    }


    public function DeleteImage($id)
    {
        $propertylists = PropertyImages::find($id);
        $proid= $propertylists->property_id;
        if($propertylists->is_featured == '1')
        {
            $propertylistsUp = PropertyImages::where('property_id',$proid)->where('is_featured','0')->first();
            if(!empty($propertylistsUp))
            {
                $Featuredpro = PropertyImages::where('property_id',$proid)->update(['is_featured' => "0"]);
            
                $propertylistsUp->is_featured ='1';
                $propertylistsUp->save();


            }
        }
        

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

    public function PropertyPagination($page)
    {

        $PropertyList = PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('user_id',Auth::guard('front_user')->user()->id)->orderBy('id', 'DESC')->skip(($page-1)*6)->take(6)->get();

        $returnHTML =  (String) view('website::web.profile.PropertyPagination', compact('PropertyList'));
        return response()->json(['status'=>true,'html'=>$returnHTML]);
    }

    public function FavoritesPagination($page)
    {

        $FvrtPropertyList = Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->skip(($page-1)*6)->take(6)->get();

        $returnHTML =  (String) view('website::web.profile.FavoritesPagination', compact('FvrtPropertyList'));
        return response()->json(['status'=>true,'html'=>$returnHTML]);
    }


public function selectcategory(Request $request)
{
    
      if(!empty($request->id)){
         $Types_Count = count($request->id);
      }else{
         $Types_Count=1;
      }
               

                $fcountry_language  = Session::get('fcountry_language');
                $language_id = $fcountry_language['id'];

                if($Types_Count)
                {

                    $SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$language_id." AND deleted_at IS NULL";

                    

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

                 $resultdata ='<option value="">'.trans('countries::home/home.banner_category').'</option>';
                 foreach ($newarray as  $tasrow) { 
                   $resultdata .='<option value="'.$tasrow->id.'" data-bathroom_show="'.$tasrow->bathroom_show.'" data-bedroom_show="'.$tasrow->bedroom_show.'" data-bulding_area_show="'.$tasrow->bulding_area_show.'" data-landarea_show="'.$tasrow->landarea_show.'" >'.$tasrow->name.'</option>';
                 }

                 return $resultdata;
        }

}

