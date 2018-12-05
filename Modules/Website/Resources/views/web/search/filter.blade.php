
@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];
$LocationMarker=array();

$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];
 $fcountry=Session::get('fcountry');
    $country_flag = $fcountry['flag'];


function money_format_5($money)
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

  
                                    @foreach($SearchList as $Property)
                                    @php


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

                                      $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->category_id)->first();

                                      $pro = Modules\Website\Entities\PropertyViewCount::where('property_id',$Property->id)->first();
                                      $count = @$pro->count;
                                      $count = (!empty($count))?$count:0;

                                   
                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                     $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

                                     $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$Property->id)->first();

                                      $LocationMarker[] = array('title'=>$property_details['title'] , 'lat' =>$Property->latitude ,'lang'=>$Property->longitude ,'id' => $Property->id ,'icon'=> URL('/public/'.str_replace(",","",$Type->master_category_id).'.png') ,'title' => $property_details['title']);


                                    @endphp
                                    <div class="col-lg-4 col-sm-6 col-xs-12 property_container "  onclick="ShowPropertyPopup({{$Property->id}})">
                                        <div class="property_wrapper property-List " id="property-{{$Property->id}}">
                                            <div class="image_wrapper">
                                                <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> {{trans('countries::home/home.Views')}} <p class="own_build">{{trans('countries::home/home.owner')}}</p></div>

                                                 <div class="badge ProTypeBuyrent">{{ implode(" , ",$selectedPropertyType)}}</div>

                                                 
                                                <img src="{{asset('public/images/properties/'.@$image->image)}}"   onerror="this.src='{{asset('public/default-property.jpg')}}';" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <p class="ProTitleP">{{ $property_details['title']}}</p>
                                                    <span class="loaction">{{ $Property->location}}</span>
                                                </div>
                                                <!-- <div class="right-btn">
                                                    <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                    <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div> -->
                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span><?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?></span> {{  money_format_5($Property->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

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

                                      
<script type="text/javascript">
                                  
  @foreach($LocationMarker as $markers)
    marker = new google.maps.Marker({
            position: new google.maps.LatLng({{$markers['lat']}}, {{$markers['lang']}}),
            map: map,
            icon : "{{$markers['icon']}}",
            title : "{{$markers['title']}}",
          });
        
          marker.set("id", {{$markers['id']}});

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent("{{$markers['title']}}");
              infowindow.open(map, marker);
            }
          })(marker, i));

          marker.addListener('mouseover', function() {

            $(".property-List").removeClass("activeProperty");
            $("#property-"+marker.get("id")).addClass("activeProperty");
        });

     @endforeach
</script>
