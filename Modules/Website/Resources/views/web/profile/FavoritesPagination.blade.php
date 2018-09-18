 @php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];
 $fcountry=Session::get('fcountry');
    $country_flag = $fcountry['flag'];


$fcountry=Session::get('fcountry');
$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];

$countryId=$fcountry['created_country_id'];


function money_format_2($money)
{

    $fcountry=Session::get('fcountry');
    $country_flag = $fcountry['flag'];


    if($country_flag == 'in')
    {
        $len = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$len;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                $m .=',';
            }
            $m .=$money[$i];
        }
         return strrev($m);
    }
    else
    {
        return number_format($money);
    }
    
   
}

@endphp

@foreach($FvrtPropertyList as $pro)

                                 @php 

                                    $pro1 = Modules\Website\Entities\PropertyViewCount::where('property_id',$pro->id)->first();
                                        $count = @$pro1->count;
                                         $count = (!empty($count))?$count:0;


                                     $Property = Modules\Properties\Entities\PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('id',$pro->property_id)->first();


                                    $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

                                     $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$pro->property_id)->first();

                                    if(is_null($property_details))
                                    {
                                         $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id','1')->where('country_id','1')->where('property_id',$pro->id)->first();
                                     }

                                   
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();


                                      $TypeList = $Property->mastercategory_id;
                                        $TypeListArray = explode(",",$TypeList);
                                        if(count($TypeListArray) > 1)
                                        {
                                             $PropertyType1 = Modules\Admin\Entities\CategoryType::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                                $query->where('language_id',$Selected_lang);

                                            }])->where('id',$TypeListArray[0]);

                                            for($i=1 ; $i< count($TypeListArray); $i++)
                                            {
                                                 $PropertyType1->orWhere('id',$TypeListArray[$i]);
                                            }

                                            $PropertyType =  $PropertyType1->get();


                                        }
                                        elseif(count($TypeListArray) == 1)
                                        {
                                           $PropertyType = Modules\Admin\Entities\CategoryType::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                                $query->where('language_id',$Selected_lang);

                                            }])->where('id',$TypeListArray[0])->get();
                                        }
                                        
                                        $selectedPropertyType =$selectedPropertyTypeId = array();
                                        foreach($PropertyType as $t)
                                        {
                                            $selectedPropertyType[] =$t->title;
                                            $selectedPropertyTypeId[] =$t->id;
                                        }
                                        
                                    @endphp
                                   

                                     <div class="col-lg-4 col-md-6 col-xs-12 property_container "id="Propert_fvt_{{$Property->id}}">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> {{trans('countries::home/home.Views')}}</div>

                                               <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="" class="img-responsive"    onclick="ShowPropertyPopup({{$Property->id}} )"   onerror="this.src='{{asset('public/default-property.jpg')}}';" >
                                                <div class="property_deatil"  onclick="ShowPropertyPopup({{$Property->id}})"  >
                                                    <h4>{{ $property_details['title']}}</h4>
                                                    <span class="loaction">{{$Property->location}}</span>
                                                </div>

                                                <form method="POST" id="AddTowishlist_{{$Property->id}}" name="AddTowishlist_{{$Property->id}}">
                                                    @php  $status = 'active'; @endphp
                                                    <input type="hidden" name="property_id" value="{{$Property->id}}">

                                                   <input  type="hidden" id="AddTowishlist_status" value="{{ $status }}" />
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            
                                                        
                                                    <div class="right-btn">
                                                       
                                                       <a class="icon  {{@$status}}"  id="i_AddTowishlist_{{$Property->id}}" onclick="AddTowishlist('{{$Property->id}}','{{$status}}')" ><i class="fas fa-heart"></i></a>
                                                    </div>
                                                </form>

                                         
                                            </div>
                                            <div class="content_wrapper"  onclick="ShowPropertyPopup({{$Property->id}})"  >
                                               <h5><span><?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?></span> {{  money_format_2($Property->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                         @if($Property-> bedroom_show == 1)
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{$Property->bedroom}}</li>
                                                        @endif
                                                        @if($Property->bathroom_show == 1)
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{$Property->bathroom}}</li>
                                                        @endif
                                                        @if($Property->bulding_area_show == 1)
                                                        @php
                                                            $building_area = Modules\Properties\Entities\BuildingUnits::where('language_id',$Selected_lang)->where(function ($query) use ($Property) {
                                                            $query->where('id',$Property->building_unit_id)->orWhere('parent_id',$Property->building_unit_id);
                                                            })->first();

                                                        $area = $Property->building_area;
                                                        $unit = @$building_area->unit;

                                                        @endphp
                                                        @elseif($Property->landarea_show == 1)
                                                        @php
                                                        
                                                        $building_area = Modules\Properties\Entities\LandUnits::where('language_id',$Selected_lang)->where(function ($query) use ($Property) {
                                                            $query->where('id',$Property->land_unit_id)->orWhere('parent_id',$Property->land_unit_id);
                                                            })->first();

                                                        $area = $Property->land_area;
                                                        $unit = @$building_area->land_unit;
                                                        @endphp

                                                        @endif

                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{@$area}} {{ @$unit}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                              
