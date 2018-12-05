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
use Modules\Admin\Entities\CategoryType;
use Modules\Admin\Entities\SearchRadius;
use Modules\Website\Entities\Wishlist;
use Modules\Admin\Entities\Metropolian;

use Modules\Website\Entities\PropertyViewCount;


class FrontSearchController extends Controller
{
    

    public function index(Request $request)
    {
    	
		    	$Filter= $request;
		    	$SearchList =$searchCategory1 =$searchCategoryName= array();
		    	$TotalRecords = $Filter['searchCategorySelected'] = array();
		    	
		    	$Filter['PropertyType']= array($request->type);
		    	// get session language
		    	$fcountry_language=Session::get('fcountry_language');
				$langId =$fcountry_language['id'];

				// get session country
				$fcountry=Session::get('fcountry');
				$countryId=$fcountry['created_country_id'];
				//dd($fcountry);


				//get category list of selected type
			/*	$CategoryList = PropertyCategory::where('master_category_id',$request->type)->where('status','1')->where('language_id',$langId)->orderby('name','ASC')->get();*/

			if($request->type)
		    {

		    	$SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$langId." AND deleted_at IS NULL";

		    	$FilterPropertyType = array($request->type);
		    	
		    	
		    	if(count($FilterPropertyType) > 1)
		    	{
		    		$SQL .=" AND (   master_category_id  like '%".$FilterPropertyType[0] ."%'";


					for($i=1 ; $i< count($FilterPropertyType); $i++)
					{
						$SQL .=" OR   master_category_id  like '%".$FilterPropertyType[$i] ."%'";
					}

					$SQL .=")";
		    	}
		    	elseif(count($FilterPropertyType) == 1)
		    	{
		    		$SQL .=" AND  master_category_id  like '%".$FilterPropertyType[0] ."%'   ORDER BY name ";
		    	}

		    	$CategoryList = DB::select($SQL);
			}
			


				//get property details
				$property_types = PropertyType::where(array('status'=>1,'language_id'=>$langId))->get();
				
				// get selected type details
				//$CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$langId)->where('id',$request->type)->orWhere('parent_id',$request->type)->first();


				$CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$langId)->orderby('title','ASC')->get();

				//dd($CategoryType);
				
				// get fiter options
				$buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>$langId))->get();
		        $landunits=LandUnits::where(array('status'=>1,'language_id'=>$langId))->get();
		        $amineties=Amenities::where(array('status'=>1,'language_id'=>$langId))->get();

				$Location = $request->searchLocation;
				$lat = $request->lat;
				$lang = $request->lang;
				$CurrentCountrySearch = $request->CurrentCountrySearch;
				$SearchRadiusdata = SearchRadius::first();
				$SearchRadius = $SearchRadiusdata->radius;

				if($request->searchCategory)
				{
					$searchCategory1[]= PropertyCategory::where('language_id',$langId)->where('id',$request->searchCategory)->orWhere('parent_id',$request->searchCategory)->first();

					$Filter['searchCategorySelected'] = array( $request->searchCategory );
				}
				if($request->MsearchCategory)
				{
					$searchCategory1[]= PropertyCategory::where('language_id',$langId)->where('id',$request->searchCategory)->orWhere('parent_id',$request->MsearchCategory)->first();
					

					$Filter['searchCategorySelected'] = array( $request->MsearchCategory );
				}

				foreach($searchCategory1 as $cat)
				{
					$searchCategoryName [] = $cat->name;
				}

				if(!empty($CurrentCountrySearch))
				{
					if( strtolower($CurrentCountrySearch) == strtolower($fcountry['name']))
					{
						if($lat && $lang )
							{

								
							    $SQL = "SELECT *, ( 3959 * acos ( cos ( radians($lat) )* cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang) )+ sin ( radians($lat) )* sin( radians( latitude ) ))) AS distance FROM ok4_propertys WHERE status  = 1 ";
							    if($request->searchCategory)
							    {
							    	$SQL .="  AND  category_id = ".$request->searchCategory ."";
							    }
							    if($request->MsearchCategory)
							    {
							    	$SQL .=" AND  category_id  = ".$request->MsearchCategory ."";
							    }
							    if($request->type)
							    {
							    	$SQL .=" AND  mastercategory_id  like '%".$request->type ."%'";
							    }
								if(Auth::guard('front_user')->user()) {
									
									$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
								}

								$SQL .=" AND  country_id  = ".$countryId ."";

								$SQL .=" HAVING distance < ".$SearchRadius."    ORDER BY distance ";
								
								$TotalRecords = DB::select($SQL);
								
								$SQL .="  LIMIT 0 ,6";



								$SearchList =  DB::select($SQL);

								$Pagination['total'] = count($TotalRecords);
								$Pagination['start'] = 0;
								$Pagination['page'] = 1;



							
							}
							else
							{
								 $SQL = "SELECT * FROM ok4_propertys WHERE status  = 1 ";
							    if($request->searchCategory)
							    {
							    	$SQL .="  AND  category_id = ".$request->searchCategory ."";
							    }
							    if($request->MsearchCategory)
							    {
							    	$SQL .=" AND  category_id  = ".$request->MsearchCategory ."";
							    }
							    if($request->type)
							    {
							    	$SQL .=" AND  mastercategory_id  like '%".$request->type ."%'";
							    }
								if(Auth::guard('front_user')->user()) {
									
									$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
								}
								
								$SQL .=" AND  country_id  = ".$countryId ."";

								$TotalRecords = DB::select($SQL);
								
								$SQL .="  LIMIT 0 ,6";

								$SearchList =  DB::select($SQL);

								$Pagination['total'] = count($TotalRecords);
								$Pagination['start'] = 0;
								$Pagination['page'] = 1;
							   
							}

					}
					else
					{
						$address = str_replace(" ", "+", $fcountry['name']);

	                    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
	                    $json = json_decode($json);

	                    $Filter['lat']=$lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	                    $Filter['lang']=$lang = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

	                    		
							    $SQL = "SELECT *, ( 3959 * acos ( cos ( radians($lat) )* cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang) )+ sin ( radians($lat) )* sin( radians( latitude ) ))) AS distance FROM ok4_propertys WHERE status  = 1 ";
							    if($request->searchCategory)
							    {
							    	$SQL .="  AND  category_id = ".$request->searchCategory ."";
							    }
							    if($request->MsearchCategory)
							    {
							    	$SQL .=" AND  category_id  = ".$request->MsearchCategory ."";
							    }
							    if($request->type)
							    {
							    	$SQL .=" AND  mastercategory_id  like '%".$request->type ."%'";
							    }
								if(Auth::guard('front_user')->user()) {
									
									$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
								}

								$SQL .=" AND  country_id  = ".$countryId ."";

								$SQL .=" HAVING distance < ".$SearchRadius."    ORDER BY distance ";
								
								$TotalRecords = DB::select($SQL);
								
								$SQL .="  LIMIT 0 ,6";

								$SearchList =  DB::select($SQL);

								$Pagination['total'] = count($TotalRecords);
								$Pagination['start'] = 0;
								$Pagination['page'] = 1;

					}

					
				}
				else
				{

					 			$SQL = "SELECT * FROM ok4_propertys WHERE status  = 1 ";
							    if($request->searchCategory)
							    {
							    	$SQL .="  AND  category_id = ".$request->searchCategory ."";
							    }
							    if($request->MsearchCategory)
							    {
							    	$SQL .=" AND  category_id  = ".$request->MsearchCategory ."";
							    }
							    if($request->type)
							    {
							    	$SQL .=" AND  mastercategory_id  like '%".$request->type ."%'";
							    }
								if(Auth::guard('front_user')->user()) {
									
									$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
								}
								
								
								$SQL .=" AND  country_id  = ".$countryId ."";

								$TotalRecords = DB::select($SQL);
								
								$SQL .="  LIMIT 0 ,6";

								$SearchList =  DB::select($SQL);

								$Pagination['total'] = count($TotalRecords);
								$Pagination['start'] = 0;
								$Pagination['page'] = 1;
				}
				
		        return view('website::web.search.index', compact('CategoryList','searchCategoryName','CategoryType','buildingunits','landunits','amineties','property_types','SearchList','Filter','Pagination'));

    }

    

    public function filter(Request $request)
    {


    		$Filter= $request;
		    $SearchList =$searchCategory1 = $searchCategoryName = $searchCategorySelected = array();
		    $Filter['searchCategorySelected'] =$request->searchCategory;
		     $Filter['PropertyType']=$request->PropertyType;
	    	

	    	// get session language
	    	$fcountry_language=Session::get('fcountry_language');
			$langId =$fcountry_language['id'];

			// get session country
			$fcountry=Session::get('fcountry');
			$countryId=$fcountry['created_country_id'];
			


			


			if($request->PropertyType)
		    {

		    	$SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$langId." AND deleted_at IS NULL";

		    	$FilterPropertyType = $request->PropertyType;
		    	

		    	if(count($FilterPropertyType) > 1)
		    	{
		    		$SQL .=" AND (   master_category_id  like '%".$FilterPropertyType[0] ."%'";


					for($i=1 ; $i< count($FilterPropertyType); $i++)
					{
						$SQL .=" OR   master_category_id  like '%".$FilterPropertyType[$i] ."%'";
					}

					$SQL .=")";
		    	}
		    	elseif(count($FilterPropertyType) == 1)
		    	{
		    		$SQL .=" AND  master_category_id  like '%".$FilterPropertyType[0] ."%'    ORDER BY name  ";
		    	}

		    	$CategoryList = DB::select($SQL);
			}
			else if($request->type)
		    {

		    	$SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$langId." AND deleted_at IS NULL";

		    	$FilterPropertyType = array($request->type);
		    	

		    	if(count($FilterPropertyType) > 1)
		    	{
		    		$SQL .=" AND (   master_category_id  like '%".$FilterPropertyType[0] ."%'";


					for($i=1 ; $i< count($FilterPropertyType); $i++)
					{
						$SQL .=" OR   master_category_id  like '%".$FilterPropertyType[$i] ."%'";
					}

					$SQL .=")";
		    	}
		    	elseif(count($FilterPropertyType) == 1)
		    	{
		    		$SQL .=" AND  master_category_id  like '%".$FilterPropertyType[0] ."%'";
		    	}

		    	$CategoryList = DB::select($SQL);
			}
			else
			{
				$CategoryList = array();
			}

			
			//get category list of selected type
			//$CategoryList = PropertyCategory::where('master_category_id',$request->type)->where('status','1')->where('language_id',$langId)->orderby('name','ASC')->get();

			//get property details
			$property_types = PropertyType::where(array('status'=>1,'language_id'=>$langId))->get();
			
			// get selected type details
			/*$CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$langId)->where('id',$request->type)->orWhere('parent_id',$request->type)->first();*/

			$CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$langId)->orderby('title','ASC')->get();

			
			if($request->type =='')
			{
				$CategoryList = PropertyCategory::where('status','1')->where('language_id',$langId)->orderby('name','ASC')->get();
			}
			// get fiter options
			$buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>$langId))->get();
	        $landunits=LandUnits::where(array('status'=>1,'language_id'=>$langId))->get();
	        $amineties=Amenities::where(array('status'=>1,'language_id'=>$langId))->get();

			$Location = $request->searchLocation;
			$lat = $request->lat;
			$lang = $request->lang;
			$SearchRadiusdata = SearchRadius::first();
			$SearchRadius = $SearchRadiusdata->radius;

			if($lat && $lang)
			{

			

			    $SQL = "SELECT *, ( 3959 * acos ( cos ( radians($lat) )* cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang) )+ sin ( radians($lat) )* sin( radians( latitude ) ))) AS distance FROM ok4_propertys WHERE status  = 1 ";
			    if($request->BudgetMin)
			    {
			    	$SQL .="  AND prize  >= ".$request->BudgetMin ."";
			    }
			    if($request->BudgetMax)
			    {
			    	$SQL .=" AND  prize  <= ".$request->BudgetMax ."";
			    }

			    if($request->AreaMin)
			    {
			    	$SQL .="  AND building_area  >= ".$request->AreaMin ."";
			    }
			    if($request->AreaMax)
			    {
			    	$SQL .=" AND  building_area  <= ".$request->AreaMax ."";
			    }
			    if($request->BedRoom)
			    {
			    	$SQL .=" AND  bedroom  = ".$request->BedRoom ."";
			    }


				if($request->searchCategory)
			    {

			    	$FiltersearchCategory = $request->searchCategory;
			    	if(count($FiltersearchCategory) > 1)
			    	{
			    		$SQL .=" AND (  category_id = ".$FiltersearchCategory[0]." ";
						for($i=1 ; $i< count($FiltersearchCategory); $i++)
						{
							$SQL .=" OR  category_id = ".$FiltersearchCategory[$i]." ";
						}

						$SQL .=")";


			    	}
			    	elseif(count($FiltersearchCategory) == 1)
			    	{
			    		$SQL .=" AND category_id = ".$FiltersearchCategory[0] ."";
			    	}
				}

				if($request->PropertyType)
			    {
			    	$FilterPropertyType = $request->PropertyType;
			    	

			    	if(count($FilterPropertyType) > 1)
			    	{
			    		$SQL .=" AND (   mastercategory_id  like '%".$FilterPropertyType[0] ."%'";


						for($i=1 ; $i< count($FilterPropertyType); $i++)
						{
							$SQL .=" OR   mastercategory_id  like '%".$FilterPropertyType[$i] ."%'";
						}

						$SQL .=")";
			    	}
			    	elseif(count($FilterPropertyType) == 1)
			    	{
			    		$SQL .=" AND  mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
			    	}
				}

				if(Auth::guard('front_user')->user()) {
					
					$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
				}


				$SQL .=" AND  country_id  = ".$countryId ."";
				
				$SQL .=" HAVING distance < ".$SearchRadius."  ORDER BY distance";

				$TotalRecords = DB::select($SQL);
							
				$SQL .="  LIMIT 0 ,6";



				$SearchList =  DB::select($SQL);

				$Pagination['total'] = count($TotalRecords);
				$Pagination['page'] = 1;

			}	
			else
			{
				if($request->Metropolian)
				{

					$Metropolian = Metropolian::where('id',$request->MetropolianId)->first();
					
					$address = str_replace(" ", "+", $Metropolian->cities);

                    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
                    $json = json_decode($json);

                    $Filter['lat']=$lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $Filter['lang']=$lang = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                   

                    $Metropolianlists = Metropolian::find($request->MetropolianId);
                    $Metropolianlists->lat =$lat; 
                    $Metropolianlists->lang =$lang ;
                    $Metropolianlists->save();

                   	$Filter['cities'] = $Metropolian->cities;
                   	$Filter['Metropolian'] = $Metropolian->Metropolian;
                   
                   	$SQL = "SELECT *, ( 3959 * acos ( cos ( radians($lat) )* cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang) )+ sin ( radians($lat) )* sin( radians( latitude ) ))) AS distance FROM ok4_propertys WHERE status  = 1 ";
                   	 if($request->BudgetMin)
				    {
				    	$SQL .="  AND prize  >= ".$request->BudgetMin ."";
				    }
				    if($request->BudgetMax)
				    {
				    	$SQL .=" AND  prize  <= ".$request->BudgetMax ."";
				    }

				    if($request->AreaMin)
				    {
				    	$SQL .="  AND building_area  >= ".$request->AreaMin ."";
				    }
				    if($request->AreaMax)
				    {
				    	$SQL .=" AND  building_area  <= ".$request->AreaMax ."";
				    }
				    if($request->BedRoom)
				    {
				    	$SQL .=" AND  bedroom  = ".$request->BedRoom ."";
				    }


					if($request->searchCategory)
				    {
				    	$FiltersearchCategory = $request->searchCategory;
				    	if(count($FiltersearchCategory) > 1)
				    	{
				    		$SQL .=" AND (  category_id = ".$FiltersearchCategory[0]." ";
							for($i=1 ; $i< count($FiltersearchCategory); $i++)
							{
								$SQL .=" OR  category_id = ".$FiltersearchCategory[$i]." ";
							}

							$SQL .=")";
				    	}
				    	elseif(count($FiltersearchCategory) == 1)
				    	{
				    		$SQL .=" AND category_id = ".$FiltersearchCategory[0] ."";
				    	}
					}

					if($request->PropertyType)
				    {
				    	$FilterPropertyType = $request->PropertyType;
				    	if(count($FilterPropertyType) > 1)
				    	{
				    		$SQL .=" AND (   mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
							for($i=1 ; $i< count($FilterPropertyType); $i++)
							{
								$SQL .=" OR   mastercategory_id  like '%".$FilterPropertyType[$i] ."%'";
							}

							$SQL .=")";
				    	}
				    	elseif(count($FilterPropertyType) == 1)
				    	{
				    		$SQL .=" AND  mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
				    	}
					}

					if(Auth::guard('front_user')->user()) {
						
						$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
					}
					$SQL .=" AND  country_id  = ".$countryId ."";

					$SQL .=" HAVING distance < ".$SearchRadius."   ORDER BY distance ";

				}
				else
				{
					 $SQL = "SELECT * FROM ok4_propertys WHERE status  = 1 ";
					  if($request->BudgetMin)
					    {
					    	$SQL .="  AND prize  >= ".$request->BudgetMin ."";
					    }
					    if($request->BudgetMax)
					    {
					    	$SQL .=" AND  prize  <= ".$request->BudgetMax ."";
					    }

					    if($request->AreaMin)
					    {
					    	$SQL .="  AND building_area  >= ".$request->AreaMin ."";
					    }
					    if($request->AreaMax)
					    {
					    	$SQL .=" AND  building_area  <= ".$request->AreaMax ."";
					    }
					    if($request->BedRoom)
					    {
					    	$SQL .=" AND  bedroom  = ".$request->BedRoom ."";
					    }


						if($request->searchCategory)
					    {
					    	$FiltersearchCategory = $request->searchCategory;
					    	if(count($FiltersearchCategory) > 1)
					    	{
					    		$SQL .=" AND (  category_id = ".$FiltersearchCategory[0]." ";
								for($i=1 ; $i< count($FiltersearchCategory); $i++)
								{
									$SQL .=" OR  category_id = ".$FiltersearchCategory[$i]." ";
								}

								$SQL .=")";
					    	}
					    	elseif(count($FiltersearchCategory) == 1)
					    	{
					    		$SQL .=" AND category_id = ".$FiltersearchCategory[0] ."";
					    	}
						}

						if($request->PropertyType)
					    {
					    	$FilterPropertyType = $request->PropertyType;
					    	if(count($FilterPropertyType) > 1)
					    	{
					    		$SQL .=" AND (   mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
								for($i=1 ; $i< count($FilterPropertyType); $i++)
								{
									$SQL .=" OR   mastercategory_id  like '%".$FilterPropertyType[$i] ."%'";
								}

								$SQL .=")";
					    	}
					    	elseif(count($FilterPropertyType) == 1)
					    	{
					    		$SQL .=" AND  mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
					    	}
						}
						$SQL .=" AND  country_id  = ".$countryId ."";

						if(Auth::guard('front_user')->user()) {
							
							$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
						}

					
				}

				$TotalRecords = DB::select($SQL);
							
				$SQL .="  LIMIT 0 ,6";

				$SearchList =  DB::select($SQL);

				$Pagination['total'] = count($TotalRecords);
				$Pagination['page'] = 2;



				

			}

			$buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>$langId))->get();
	        $landunits=LandUnits::where(array('status'=>1,'language_id'=>$langId))->get();
	        $amineties=Amenities::where(array('status'=>1,'language_id'=>$langId))->get();


	        if($request->searchCategory)
			{
				foreach($request->searchCategory as $cat)
				{
					$searchCategory1[] = PropertyCategory::where('language_id',$langId)->where('id',$cat)->orWhere('parent_id',$cat)->first();
				}
				
				
			}
			$Filter['searchCategorySelected']= $request->searchCategory;

			
			foreach($searchCategory1 as $cat)
				{
					$searchCategoryName[] = $cat->name;
				}

			//	dd($Filter);

	      
	         return view('website::web.search.index', compact('CategoryList','searchCategoryName','CategoryType','buildingunits','landunits','amineties','property_types','SearchList','Filter','Pagination'));
	    
    }
   
    public function getcategory($id)
    {
    	
		$fcountry_language=Session::get('fcountry_language');
		$langId=$fcountry_language['id'];


		if($id)
		    {

		    	$SQL = "SELECT * FROM ok4_property_category WHERE status  = 1 AND  language_id = ".$langId." AND deleted_at IS NULL";

		    	$FilterPropertyType = array($id);
		    	
		    	
		    	if(count($FilterPropertyType) > 1)
		    	{
		    		$SQL .=" AND (   master_category_id  like '%".$FilterPropertyType[0] ."%'";


					for($i=1 ; $i< count($FilterPropertyType); $i++)
					{
						$SQL .=" OR   master_category_id  like '%".$FilterPropertyType[$i] ."%'";
					}

					$SQL .=")";
		    	}
		    	elseif(count($FilterPropertyType) == 1)
		    	{
		    		$SQL .=" AND  master_category_id  like '%".$FilterPropertyType[0] ."%'   ORDER BY name ";
		    	}

		    	$categorylist = DB::select($SQL);
			}

    	//$categorylist= PropertyCategory::where('master_category_id',$id)->where('status','1')->where('language_id',$langId)->get();
    	

    	$Options =' <select class="ProjectCategory" name="MsearchCategory"><option value="" disabled selected >'.trans("countries::home/home.Category").'</option>';

    	foreach($categorylist as $cat)
        {
        	$value= ($cat->parent_id == null)? $cat->id:$cat->parent_id;
           $Options .='<option value="'.$value.'" class="'.$cat->master_category_id.'">'.$cat->name.'</option>';
    	}
          $Options .="</select>";
        return response()->json(['status'=>true,'Options'=>$Options]);
    }

    public function ShowProperty($id)
    {
    	

    	

		$property_lists = PropertyList::with('property_created_amenities','property_created_neighbourhoods')->find($id);


        if($property_lists==null) {   return response()->json(['status'=>false,'html'=>'']); }
        else
        {

        	if(@Auth::guard('front_user')->user()->id != $property_lists->user_id)
        	{
        		$pro = PropertyViewCount::where('property_id',$id)->first();
					if(!$pro)
					{
						$pro = new PropertyViewCount;
						$pro->property_id = $id;
						$pro->count = 0;

						 $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."property_view_count'");
				        if (empty($tableStatus)) {
				            throw new \Exception("Table not found");
				        }else
				        {

				            try{
				                $pro->save();

				            }
				             catch (Exception $ex) {
				                $request->session()->flash('val', 0);
				                $request->session()->flash('msg', "Property not created successfully.".$e->getMessage()); 
				                return response()->json(['status'=>false,'csrf' => csrf_token()]);
				            }

						}
						
					}
					$count = $pro->count;
					$count++;
					$pro->count = $count;
					$pro->save();
        	}
        	


            $fcountry_language  = Session::get('fcountry_language');
            $language_id = $fcountry_language['id'];

            $fcountry  = Session::get('fcountry');
            $countryid = $fcountry['created_country_id'];

            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();

            $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$language_id))->get();
            $property_types = PropertyType::where(array('status'=>1,'language_id'=>$language_id))->get();
            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
            $building_units=BuildingUnits::where(array('status'=>1,'language_id'=>$language_id))->get();
            $land_units=LandUnits::where(array('status'=>1,'language_id'=>$language_id))->get();
            $amenities =Amenities::where(array('status'=>1,'language_id'=>$language_id))->get();
            $langugeDetails = PropertyCountryLangs::with('pro_languages')->where('property_id',$id)->get();
            $galleryimages=PropertyImages::where('property_id',$id)->get();
            //dd($langugeDetails);
            $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$language_id))->get();
            
            //similar property
            $lat = $property_lists->latitude;
            $lang = $property_lists->longitude;


             $SPlist = array();

            if(@Auth::guard('front_user')->user()->id  != $property_lists->user_id)
        	{


						$SimilarProperty = PropertyList::select(DB::raw("*,( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang)) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance"))
					        ->having("distance", "<", 100);
					    $SimilarProperty->where('category_id','=',$property_lists->category_id);
					    $SimilarProperty->orWhere('type_id','=',$property_lists->type_id);
					    $SimilarProperty->where('status', "=", "1");
					    if(Auth::guard('front_user')->user()) {
					    	$SimilarProperty->where('user_id', "!=", Auth::guard('front_user')->user()->id);
					    }
					    $SimilarProperty->where('id', "!=",$id);
					    $SimilarPropertyList = $SimilarProperty->orderByRaw("RAND()")->get();

					    

					   
					    foreach($SimilarPropertyList as $pro)
					    {
					    	if(count($SPlist) < 3)
			                {
			                	$property_details= PropertyCountryLangs::where('language_created_id',$language_id)->where('country_id',$countryid)->where('property_id',$pro->id)->where('property_id', "!=",$id)->first();
								if($property_details)
				                {

				                	 $SPlist[]= $pro;
				                }
				            }
				            else
				            {
				            	break;
				            }
					    }

		    }

		    $returnHTML =  (String) view('website::web.search.property', compact('property_categories','property_types','countries','building_units','land_units','amenities','neighbourhoods','property_lists','languages','galleryimages','langugeDetails','SPlist'));
	        

	        
            
		    
			return response()->json(['status'=>true,'html'=>$returnHTML]);

        }
    }

  public function AddTowishlist(Request $request)
  {
  	//dd($request);


  	if($request->status =='inactive')
  	{
  		$AddTowishlist = new Wishlist;
        $AddTowishlist->user_id = Auth::guard('front_user')->user()->id; 
        $AddTowishlist->property_id = $request->property_id; 
         $tableStatus = DB::select("SHOW TABLE STATUS LIKE '".DB::getTablePrefix()."add_to_wishlist'");
        if (empty($tableStatus)) {
            throw new \Exception("Table not found");
        }else
        {
            $nextId = $tableStatus[0]->Auto_increment; 
            $AddTowishlist->id=$nextId;

            try{
                $AddTowishlist->save();
                return response()->json(['status'=>true]);
            }


            catch (Exception $ex) {
                 return response()->json(['status'=>false]);
            }

        }

  	}
  	else
  	{
  		 Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->where('property_id', $request->property_id)->delete();
         return response()->json(['status'=>true]);

  	}
  }

  public function searchFunByuniqueID($id)
    {
    	
    		//
    		$CategoryList = $searchCategoryName =$Filter=  array();
    		$CategoryType ='';
			$Filter = array(
    			'type' =>'',
    			'searchLocation' =>'',
    			'PropertyType' =>array(),
    			'lat' =>'',
    			'lang' =>'',
    			'BudgetMin' =>'',
    			'BudgetMax' =>'',
    			'BedRoom' =>'',
	    			'AreaMax'=>'',
	    			'AreaMin'=>'',
    		);

    		$Filter['searchCategorySelected'] = array();


    		
			$SearchList = PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('uid',$id)->where('status',1)->get();

			$Pagination['total'] = count($SearchList);
			$Pagination['page'] = 1;

			if(count($SearchList) > 0 )
			{
				$Filter = array(
	    			'type' =>@$SearchList[0]->type_id,
	    			'searchLocation' =>@$SearchList[0]->location,
	    			'lat' =>@$SearchList[0]->latitude,
	    			'lang' =>@$SearchList[0]->longitude,
	    			'BudgetMin' =>'',
	    			'BudgetMax' =>'',
	    			'BedRoom' =>'',
	    			'AreaMax'=>'',
	    			'AreaMin'=>'',
	    			'PropertyType' =>array(@$SearchList[0]->mastercategory_id),
	    		);

				//$Filter['PropertyType'][] = $SearchList[0]->type_id;

				$Pagination['total'] = count($SearchList);
				$Pagination['page'] = 1;


			}

			

			$fcountry_language  = Session::get('fcountry_language');
            $language_id = $fcountry_language['id'];

            $fcountry  = Session::get('fcountry');
            $countryid = $fcountry['created_country_id'];

            
            $languages=Countrylangs::with('languages')->where('created_country_id',$countryid)->get()->toArray();

            $property_categories = PropertyCategory::where(array('status'=>1,'language_id'=>$language_id))->get();

            $property_types = PropertyType::where(array('status'=>1,'language_id'=>$language_id))->get();

            $countries=Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();

            $building_units=BuildingUnits::where(array('status'=>1,'language_id'=>$language_id))->get();

            $land_units=LandUnits::where(array('status'=>1,'language_id'=>$language_id))->get();

            $amenities =Amenities::where(array('status'=>1,'language_id'=>$language_id))->get();

            $langugeDetails = PropertyCountryLangs::with('pro_languages')->where('property_id',$id)->get();
           
            $neighbourhoods=Neighbourhood::where(array('status'=>1,'language_id'=>$language_id))->get();
            
            $CategoryType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$language_id)->orderby('title','ASC')->get();

          return view('website::web.search.index', compact('CategoryList','searchCategoryName','CategoryType','buildingunits','landunits','amineties','property_types','SearchList','Filter','Pagination','CategoryType'));
    }


    public function property($id)
    {
    	

    			

		    	$SearchList =$searchCategory = array();
		    	$Filter['searchCategorySelected'] = '';
		    	$Filter= array();
		    	$SPlist = array();
		    	$searchCategoryName= array();

		    	// get session language
		    	$fcountry_language=Session::get('fcountry_language');
				$langId =$fcountry_language['id'];

				// get session country
				$fcountry=Session::get('fcountry');
				$countryId=$fcountry['created_country_id'];
				//dd($fcountry);


				$Search = PropertyList::select("*");
			    $Search->where('id','=',$id);
				$Search->where('status', "=", "1");
			    if(Auth::guard('front_user')->user()) {
			    	$Search->where('user_id', "!=", Auth::guard('front_user')->user()->id);
			    }
			    $SearchList = $Search->get();

			    if(count($SearchList)>0)
			    {
			    	$Filter =array(

			    		'type'=>@$SearchList[0]->mastercategory_id,
			    		'searchCategory'=>@$SearchList[0]->category_id,
			    		'lat'=>@$SearchList[0]->latitude,
			    		'lang'=>@$SearchList[0]->longitude,
			    		'searchLocation' =>@$SearchList[0]->location,
			    	);


			    	$SimilarProperty = PropertyList::select('*');
					$SimilarProperty->where('category_id','=',$SearchList[0]->category_id);
				    $SimilarProperty->orWhere('type_id','=',$SearchList[0]->type_id);
				    $SimilarProperty->where('status', "=", "1");
				    if(Auth::guard('front_user')->user()) {
				    	$SimilarProperty->where('user_id', "!=", Auth::guard('front_user')->user()->id);
				    }
				    $SimilarProperty->where('id', "!=",$id);
				    $SimilarPropertyList = $SimilarProperty->get();
				   
				    foreach($SimilarPropertyList as $pro)
				    {
				    	if(count($SPlist) < 3)
		                {
		                	$property_details= PropertyCountryLangs::where('language_created_id',$langId)->where('country_id',$countryId)->where('property_id',$pro->id)->where('property_id', "!=",$id)->first();
							if($property_details)
			                {

			                	 $SPlist[]= $pro;
			                }
			            }
			            else
			            {
			            	break;
			            }
				    }
			    }
			    else
			    {
			    	$Filter =array(

			    		'type'=>'',
			    		'searchCategory'=>'',
			    		'lat'=>'',
			    		'lang'=>'',
			    		'searchLocation'=>''
			    	);
			    }


			    $CategoryType='';

			    $searchCategory = PropertyCategory::where('language_id',$langId)->where('id',$Filter['searchCategory'])->orWhere('parent_id',$Filter['searchCategory'])->first();
				$Filter['searchCategorySelected'] = $Filter['searchCategory'];
				
				//get category list of selected type
				$CategoryList = PropertyCategory::where('status','1')->where('language_id',$langId)->orderby('name','ASC')->get();

				//get property details
				$property_types = PropertyType::where(array('status'=>1,'language_id'=>$langId))->get();
				
				
				// get fiter options
				$buildingunits=BuildingUnits::where(array('status'=>1,'language_id'=>$langId))->get();
		        $landunits=LandUnits::where(array('status'=>1,'language_id'=>$langId))->get();
		        $amineties=Amenities::where(array('status'=>1,'language_id'=>$langId))->get();

				$Location = '';
				$lat = '';
				$lang = '';
				$CurrentCountrySearch = '';
				
				$Filter['id']= $id;

				
		        return view('website::web.search.propertydetail', compact('CategoryList','searchCategory','CategoryType','buildingunits','landunits','amineties','property_types','SearchList','Filter','searchCategoryName'));

    }



    public function filterPagination(Request $request)
    {


    		$start = ($request->page - 1)*6;
        	$Filter= $request;
		    $SearchList =$searchCategory1 = $searchCategoryName = $searchCategorySelected = array();
		    $Filter['searchCategorySelected'] = array();
		    	

	    	
	    	// get session language
	    	$fcountry_language=Session::get('fcountry_language');
			$langId =$fcountry_language['id'];

			// get session country
			$fcountry=Session::get('fcountry');
			$countryId=$fcountry['created_country_id'];

			$Location = $request->searchLocation;
			$lat = $request->lat;
			$lang = $request->lang;
			$SearchRadiusdata = SearchRadius::first();
			$SearchRadius = $SearchRadiusdata->radius;

			if($lat && $lang)
			{

			

			    $SQL = "SELECT *, ( 3959 * acos ( cos ( radians($lat) )* cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang) )+ sin ( radians($lat) )* sin( radians( latitude ) ))) AS distance FROM ok4_propertys WHERE status  = 1 ";
			    if($request->BudgetMin)
			    {
			    	$SQL .="  AND prize  >= ".$request->BudgetMin ."";
			    }
			    if($request->BudgetMax)
			    {
			    	$SQL .=" AND  prize  <= ".$request->BudgetMax ."";
			    }

			    if($request->AreaMin)
			    {
			    	$SQL .="  AND building_area  >= ".$request->AreaMin ."";
			    }
			    if($request->AreaMax)
			    {
			    	$SQL .=" AND  building_area  <= ".$request->AreaMax ."";
			    }
			    if($request->BedRoom)
			    {
			    	$SQL .=" AND  bedroom  = ".$request->BedRoom ."";
			    }


				if($request->searchCategory)
			    {
			    	$FiltersearchCategory = $request->searchCategory;
			    	if(count($FiltersearchCategory) > 1)
			    	{
			    		$SQL .=" AND (  category_id = ".$FiltersearchCategory[0]." ";
						for($i=1 ; $i< count($FiltersearchCategory); $i++)
						{
							$SQL .=" OR  category_id = ".$FiltersearchCategory[$i]." ";
						}

						$SQL .=")";
			    	}
			    	elseif(count($FiltersearchCategory) == 1)
			    	{
			    		$SQL .=" AND category_id = ".$FiltersearchCategory[0] ."";
			    	}
				}

				if($request->PropertyType)
			    {
			    	$FilterPropertyType = $request->PropertyType;
			    	if(count($FilterPropertyType) > 1)
			    	{
			    		$SQL .=" AND (  mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
						for($i=1 ; $i< count($FilterPropertyType); $i++)
						{
							$SQL .=" OR mastercategory_id  like '%".$FilterPropertyType[$i] ."%'";
						}

						$SQL .=")";
			    	}
			    	elseif(count($FilterPropertyType) == 1)
			    	{
			    		$SQL .=" AND mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
			    	}
				}

				if(Auth::guard('front_user')->user()) {
					
					$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
				}
				
				$SQL .=" AND  country_id  = ".$countryId ."";

				$SQL .=" HAVING distance < ".$SearchRadius."   ORDER BY distance LIMIT ".$start." ,6";

				$SearchList =  DB::select($SQL);

			}	
			else
			{
				if($request->Metropolian)
				{

					$Metropolian = Metropolian::where('id',$request->MetropolianId)->first();
					
					$address = str_replace(" ", "+", $Metropolian->cities);

                    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
                    $json = json_decode($json);

                    $Filter['lat']=$lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $Filter['lang']=$lang = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                   

                    $Metropolianlists = Metropolian::find($request->MetropolianId);
                    $Metropolianlists->lat =$lat; 
                    $Metropolianlists->lang =$lang ;
                    $Metropolianlists->save();

                   	$Filter['cities'] = $Metropolian->cities;
                   	$Filter['Metropolian'] = $Metropolian->Metropolian;
                   
                   	$SQL = "SELECT *, ( 3959 * acos ( cos ( radians($lat) )* cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lang) )+ sin ( radians($lat) )* sin( radians( latitude ) ))) AS distance FROM ok4_propertys WHERE status  = 1 ";
                   	 if($request->BudgetMin)
				    {
				    	$SQL .="  AND prize  >= ".$request->BudgetMin ."";
				    }
				    if($request->BudgetMax)
				    {
				    	$SQL .=" AND  prize  <= ".$request->BudgetMax ."";
				    }

				    if($request->AreaMin)
				    {
				    	$SQL .="  AND building_area  >= ".$request->AreaMin ."";
				    }
				    if($request->AreaMax)
				    {
				    	$SQL .=" AND  building_area  <= ".$request->AreaMax ."";
				    }
				    if($request->BedRoom)
				    {
				    	$SQL .=" AND  bedroom  = ".$request->BedRoom ."";
				    }


					if($request->searchCategory)
				    {
				    	$FiltersearchCategory = $request->searchCategory;
				    	if(count($FiltersearchCategory) > 1)
				    	{
				    		$SQL .=" AND (  category_id = ".$FiltersearchCategory[0]." ";
							for($i=1 ; $i< count($FiltersearchCategory); $i++)
							{
								$SQL .=" OR  category_id = ".$FiltersearchCategory[$i]." ";
							}

							$SQL .=")";
				    	}
				    	elseif(count($FiltersearchCategory) == 1)
				    	{
				    		$SQL .=" AND category_id = ".$FiltersearchCategory[0] ."";
				    	}
					}

					if($request->PropertyType)
				    {
				    	$FilterPropertyType = $request->PropertyType;
				    	if(count($FilterPropertyType) > 1)
				    	{
				    		$SQL .=" AND (  type_id = ".$FilterPropertyType[0] ."";
							for($i=1 ; $i< count($FilterPropertyType); $i++)
							{
								$SQL .=" OR  type_id =". $FilterPropertyType[$i] ."";
							}

							$SQL .=")";
				    	}
				    	elseif(count($FilterPropertyType) == 1)
				    	{
				    		$SQL .=" AND type_id = ".$FilterPropertyType[0]." ";
				    	}
					}

					if(Auth::guard('front_user')->user()) {
						
						$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
					}

					$SQL .=" AND  country_id  = ".$countryId ."";

					$SQL .=" HAVING distance < ".$SearchRadius."   ORDER BY distance LIMIT 0 , 6";

				}
				else
				{
					 $SQL = "SELECT * FROM ok4_propertys WHERE status  = 1 ";
					  if($request->BudgetMin)
					    {
					    	$SQL .="  AND prize  >= ".$request->BudgetMin ."";
					    }
					    if($request->BudgetMax)
					    {
					    	$SQL .=" AND  prize  <= ".$request->BudgetMax ."";
					    }

					    if($request->AreaMin)
					    {
					    	$SQL .="  AND building_area  >= ".$request->AreaMin ."";
					    }
					    if($request->AreaMax)
					    {
					    	$SQL .=" AND  building_area  <= ".$request->AreaMax ."";
					    }
					    if($request->BedRoom)
					    {
					    	$SQL .=" AND  bedroom  = ".$request->BedRoom ."";
					    }


						if($request->searchCategory)
					    {
					    	$FiltersearchCategory = $request->searchCategory;
					    	if(count($FiltersearchCategory) > 1)
					    	{
					    		$SQL .=" AND (  category_id = ".$FiltersearchCategory[0]." ";
								for($i=1 ; $i< count($FiltersearchCategory); $i++)
								{
									$SQL .=" OR  category_id = ".$FiltersearchCategory[$i]." ";
								}

								$SQL .=")";
					    	}
					    	elseif(count($FiltersearchCategory) == 1)
					    	{
					    		$SQL .=" AND category_id = ".$FiltersearchCategory[0] ."";
					    	}
						}

						if($request->PropertyType)
					    {
					    	$FilterPropertyType = $request->PropertyType;
					    	if(count($FilterPropertyType) > 1)
					    	{
					    		$SQL .=" AND (  mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
								for($i=1 ; $i< count($FilterPropertyType); $i++)
								{
									$SQL .=" OR  mastercategory_id  like '%".$FilterPropertyType[$i] ."%'";
								}

								$SQL .=")";
					    	}
					    	elseif(count($FilterPropertyType) == 1)
					    	{
					    		$SQL .=" AND mastercategory_id  like '%".$FilterPropertyType[0] ."%'";
					    	}
						}

						if(Auth::guard('front_user')->user()) {
							
							$SQL .=" AND user_id != ".Auth::guard('front_user')->user()->id." ";
						}

						$SQL .=" AND  country_id  = ".$countryId ."";

						$SQL .="  LIMIT ".$start.", 6";
				    
				}

				$SearchList =  DB::select($SQL);


				

			}

			
			$count = $start + count($SearchList);

			$Filter['searchCategorySelected']= $request->searchCategory;

	      	$returnHTML =  (String) view('website::web.search.filter', compact('SearchList','Filter'));
		        
		    return response()->json(['status'=>true,'html'=>$returnHTML ,'Count' =>$count]);

	    
    }
}
