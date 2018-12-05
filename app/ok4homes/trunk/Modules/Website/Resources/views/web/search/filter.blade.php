
@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];
$LocationMarker=array();
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
                                        $selectedPropertyType =array();
                                        foreach($PropertyType as $t)
                                        {
                                            $selectedPropertyType[] =$t->title;
                                        }


                                      $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->category_id)->first();

                                      $pro = Modules\Website\Entities\PropertyViewCount::where('property_id',$Property->id)->first();
                                      $count = @$pro->count;
                                      $count = (!empty($count))?$count:0;

                                    $building_area = Modules\Properties\Entities\LandUnits::with(['types' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->building_unit_id)->first();
                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                     $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

                                     $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$Property->id)->first();

                                      $LocationMarker[] = array('title'=>$property_details['title'] , 'lat' =>$Property->latitude ,'lang'=>$Property->longitude ,'id' => $Property->id ,'icon'=> URL('/public/'.str_replace(",","",$Type->master_category_id).'.png') ,'title' => $property_details['title']);


                                    @endphp
                                    <div class="col-lg-4 col-sm-6 col-xs-12 property_container "  onclick="ShowPropertyPopup({{$Property->id}})">
                                        <div class="property_wrapper property-List " id="property-{{$Property->id}}">
                                            <div class="image_wrapper">
                                                <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> Views</div>

                                                 <div class="badge ProTypeBuyrent">{{ implode(" , ",$selectedPropertyType)}}</div>

                                                 
                                                <img src="{{asset('public/images/properties/'.@$image->image)}}"   onerror="this.src='{{asset('public/default-property.jpg')}}';" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>{{ $property_details['title']}}</h4>
                                                    <span class="loaction">{{ $Property->location}}</span>
                                                </div>
                                                <!-- <div class="right-btn">
                                                    <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                    <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div> -->
                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>{{trans('countries::home/home.rupee')}}</span> {{ $Property->prize}}/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{ $Property->bedroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{ $Property->bathroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{ $Property->building_area}} {{ (count($building_area->types)> 0)?$building_area->types[0]->unit:$building_area->unit}}</li>
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
