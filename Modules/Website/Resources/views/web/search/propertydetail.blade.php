@extends('website::web.common-master')
@section('title', "Ok4homes | Search")
@section('content')
@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];
$LocationMarker=array();
$fcountry=Session::get('fcountry');
$country_flag = $fcountry['flag'];
function money_format_8($money)
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
$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];

@endphp
 <link href="{{asset('public/web/css/register.css')}}" rel="stylesheet"> 
    <style type="text/css">
        .activeProperty {
            -webkit-box-shadow: 0px 0px 30px 0px rgba(50, 50, 50, 0.57);
            -moz-box-shadow: 0px 0px 30px 0px rgba(50, 50, 50, 0.57);
            box-shadow: 0px 0px 30px 0px rgba(50, 50, 50, 0.57);
        }

      
        .search-area .search-box .input-area input {
            padding-right: 0px;
        }

        /**************** TUSHAR *************************/
/*for signin box*/


/*banner.scss 245 for width*/ 
.signin {
    width: 340px !important;
}
/*banner.scss 272 for sign in name font*/
.signin .signin-box h3 {
    font-size: 16px !important;
}
/*banner.scss 261 for close icon height width*/
.signin .signin-box .close-popup {
    width: 12px !important;
    height: 12px !important;
}

.signin .signin-box {
    padding: 45px !important;
}
.signin .signin-box input {
    padding: 7px 10px 7px 0 !important;
}
.signin .signin-box .signin-items [type="checkbox"].filled-in:not(:checked) + label:after { 
    width: 25px !important;
    height: 25px !important;  
}
/*banner scss:291 font size label*/
.signin .signin-box .input-field label {
    font-size: 0.850em !important;
}

/*banner.scss 309 chekbox font size*/
.signin .signin-box .signin-items [type="checkbox"] + label {
    font-size: 0.800em !important;
}

/*banner.scss 335 for padding margin of button sign in*/
.signin .signin-box .signbtn {
    padding: 12px 20px !important;
    margin-top: 15px !important;
    margin-bottom: 15px !important;
}


.modal .modal-dialog {
    margin-top: 30px !important;
}
 .status {
    font-size: 30px;
}

/*for sign up box*/

/*banner.scss369 for sign up width*/
.signup {
    
    width: 550px !important;
}


/*banner.scss 409 for li padding*/
.signup ul li {
    display: block;
    margin-bottom: 10px;
    padding-left: 0px !important;
}
.signup ul li {
    
    margin-bottom: 0px !important;
    
}

/*add this in banner.scss*/
.signup .form-list .namesection>li
{
    width:100% !important;
}
.signup h3 {
    
    padding-left: 35% !important;
    font-size: 16px;
    
}

div#PropertyDetails {
    margin-top: 80px;
}



.badge.ProTypeBuyrent {
    background-color: #feb63d !important;
}

.add-property.search .select-wrapper .dropdown-content.select-dropdown.multiple-select-dropdown{    max-height: 300px !important;
}


ul.proTitlewithDetail > li {
    width: 50%;
    display: inline-block;
    float: left;
}
ul.proTitlewithDetail > li:nth-child(2) > p{
     float: right;
         margin-right: 10px;
             font-size: 10px;
}
p.ProTitleP 
    {
       width: 170px;
        font-size: 1.15em;
        font-weight: 600;
        color: #fff;
           max-width: 170px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
        
    }
span.loaction {
    float: left;
}

.search .grid-list-box .right-box .own_build{
    margin-top: 15px;
    font-weight: bold;
    text-align: left;
    display: block;


}
    </style>
   
    <section class="add-property search">
        <div class="container-fluid">
            <form method="GET" action="{{ URL('search/filter') }}" id="SearchBarForm" name="SearchBarForm">
           
            <input type="hidden" name="type" value="{{$Filter['type']}}">
             <input type="hidden" name="PropertyType[]" value="{{$Filter['type']}}">
            <div class="search-area row xsmx0">
                <div class="col-sm-12 col-xs-12 xspx0">
                    <div class="col-sm-6 col-xs-12 xspx0">
                        <div class="search-box">
                            <div class="select-list">
                                <div class="input-field">
                                    <select multiple name="searchCategory[]">
                                       <option value="" disabled selected>{{trans('countries::home/home.Category')}}</option>
                                        @foreach($CategoryList as $cat)
                                        @php $row_id = ($cat->parent_id == null)?$cat->id:$cat->parent_id; @endphp

                                            <option value="{{$cat->id}}" {{ ($Filter['searchCategorySelected'] == $row_id)?'selected':''}}>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input-area input_wrapper location_input ">
                               <input   type="text" class="validate" id="searchLocation_" name="searchLocation"  placeholder="{{trans('countries::home/home.Location')}}" value="{{$Filter['searchLocation']}}" />
                                

                                <img src="{{ asset('public/images/icon-search.png')}}" class="mapPointer">
                            </div>
                            <div class="button-box">
                                <button id="FiterSearchResult">{{trans('countries::home/home.Search')}}</button>
                            </div>
                            <div class="pull-right" style="position: absolute; top: 55px; right: 0px;">
                                <a href="#HideMap" class="button" id="showHideMap"> Hide Map </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 xspx0">
                        <div class="property-search">
                            <!--ul>
                                <li class="dd-1 active"><a href="#">Property Type</a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <div class="block">
                                               <ul>
                                                @foreach($property_types as $ProType)
                                                    <li>
                                                        <input type="checkbox" class="filled-in" id="Pro{{$ProType->id}}" name="PropertyType[]" value="{{$ProType->id}}" />
                                                        <label for="Pro{{$ProType->id}}">{{$ProType->name}}</label>
                                                    </li>
                                                @endforeach
                                                </ul> 
                                            </div>
                                                                                   
                                        </div>
                                    </div>
                                </li>

                    <input type="hidden" name="lat" id="lat_searchLocation" value="{{$Filter['lat']}}">
                    <input type="hidden" name="lang" id="lang_searchLocation" value="{{$Filter['lang']}}">


                                <li class="dd-2 active budgetWrap"><a href="#">Budget</a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <h4>Budget</h4>
                                            <ul>
                                                <li>
                                                    <label >Min </label>
                                                    <input type="number" class="filled-in" placeholder="Min Budget" name="BudgetMin" />         
                                                </li>
                                                <li>
                                                    <label >Max</label>
                                                    <input type="number" class="filled-in" placeholder="Max Budget" name="BudgetMax" /> 
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="dd-3 active"><a href="#">Bed Room 
                                    
                                    <i class="fas fa-sort-down"></i></a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <h4>Bed Room</h4>
                                            <ul>
                                                 <li>
                                                    <input type="number" name="BedRoom" class="filled-in" placeholder="Bed Room" />         
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="dd-4 active"><a href="#">Area  <i class="fas fa-sort-down"></i></a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <h4>Area</h4>
                                            <ul class="areaDrop">
                                                <li>
                                                    <label >Min </label>
                                                    <input type="number" class="filled-in" placeholder="Min area" name="AreaMin" />         
                                                </li>
                                                <li>
                                                    <label >Max</label>
                                                    <input type="number" class="filled-in" placeholder="Max area" name="AreaMax" /> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul-->
                        </div>
                    </div>
                </div>
                <div class="dropdown-overlay-2"></div>
            </div>
            <input type="hidden" name="lat" id="lat_searchLocation" value="{{@$SearchList[0]->latitude}}">
            <input type="hidden" name="lang" id="lang_searchLocation" value="{{@$SearchList[0]->longitude}}">

            </form>
            <div class="row contant-inner" id="FiterSearchResponse">
                <div class="col-lg-6 col-sm-6 col-xs-12 px0">
                    <div id="Mymap" style="height: 100vh; width: 100%;"></div>
                    <!-- kandy show property in map --->
                     @include('website::web.showPropertyInMap')
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12 grid-list-box">
                    <div class="right-box">
                         @if(@$Filter['Metropolian'])
                          <h5>{{count($SearchList)}} -{{ $Filter['cities']}} </h5>

                        @elseif(count($SearchList) == 0)

                        <h5>{{count($SearchList)}} {{trans('countries::home/home.resultfound')}}</h5>
                        
                         @else
                        <h5>{{count($SearchList)}} - @if($searchCategoryName) {{ implode(",",$searchCategoryName)}}@endif for {{@$CategoryType->title}} @if($Filter['searchLocation']) in {{$Filter['searchLocation']}} @endif</h5>

                        @endif
                        <div class="profile-tab-box featured_properties">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="favorites">
                                    
                                    @foreach($SearchList as $Property)
                                    @php


                                        $pro_show_id = $Property->id;

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


                                       $pro = Modules\Website\Entities\PropertyViewCount::where('property_id',$Property->id)->first();
                                        $count = @$pro->count;
                                          $count = (!empty($count))?$count:0;


                                      $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->category_id)->first();


                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                     $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

                                     $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$Property->id)->first();

                                     
                                     $LocationMarker[] = array('title'=>$property_details['title'] , 'lat' =>$Property->latitude ,'lang'=>$Property->longitude ,'id' => $Property->id ,'icon'=> URL('/public/'.str_replace(",","",$Type->master_category_id).'.png') ,'title' => $property_details['title']);


                                    @endphp
                                    <div class="col-lg-4 col-sm-6 col-xs-12 property_container" onclick="ShowPropertyPopup({{$Property->id}})">
                                        <div class="property_wrapper ">
                                            <div class="image_wrapper">
                                                <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> {{trans('countries::home/home.Views')}} <br><span class="own_build">{{trans('countries::home/home.owner')}}</span> </div>

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
                                                <?php } ?></span> {{  money_format_8($Property->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

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
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="dropdown-overlay"></div>

      
    </section>

    
   

  
   
    <script type="text/javascript">
       $('body').on('click', '#FiterSearchResult', function(e) {
                   /* e.preventDefault();
                    $.ajax({
                                type: "POST",
                                url: base_url+"/search/filter", 
                                data: new FormData($('#SearchBarForm')[0]),
                                dataType: "json",  
                                cache:false,
                                contentType: false,                   
                                processData:false,
                                success: function(response){
                                   if(response.status==true){ $("#FiterSearchResponse").html(response.html)}
                                    $('select').material_select();
                                },
                                error: function (request, textStatus, errorThrown) {
                                    
                                }             
                    });*/


                });
      
          var map = new google.maps.Map(document.getElementById('Mymap'), {
          zoom: 12,
          center: new google.maps.LatLng('{{$Filter["lat"]}}', '{{$Filter["lang"]}}'),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        map.setOptions({ minZoom: 5, maxZoom: 20 });
        var infowindow = new google.maps.InfoWindow();


        var marker, i;
        @if($Filter["lat"] =='' || $Filter["lang"] =='')

        var latLng = new google.maps.LatLng('{{$Filter["lat"]}}', '{{$Filter["lang"]}}');
        var marker = new google.maps.Marker({
            position: latLng,
            title:pro_cityName
        });
        marker.setMap(map);

        /*var geocoder =  new google.maps.Geocoder();
          geocoder.geocode( { 'address': country_name = $("#country_name").val()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                var latLng = new google.maps.LatLng(latitude, longitude);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    map: map,
                });
                map.setZoom(5);
            }
          });*/
        @endif
        @foreach($LocationMarker as $markers)
       // for (i = 0; i < locations.length; i++) { 
          marker = new google.maps.Marker({
            position: new google.maps.LatLng({{$markers['lat']}}, {{$markers['lang']}}),
            map: map,
            icon : "{{$markers['icon']}}",
            title : "{{$markers['title']}}"
          });
        

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent("{{$markers['title']}}");
              infowindow.open(map, marker);
            }
          })(marker, i));
        @endforeach
        var input = document.getElementById('searchLocation_');
        var country = document.getElementById('country_code').value;
    
        var options = {
          //types: ['(cities)'],
          componentRestrictions: {country: country}
        };

        var autocomplete = new google.maps.places.Autocomplete(input, options);

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
              var place = autocomplete.getPlace();
              var lat = place.geometry.location.lat();
              var lng = place.geometry.location.lng();
              var placeId = place.place_id;
              // to set city name, using the locality param
              var componentForm = {
                locality: 'short_name',
              };
              
              document.getElementById("lat_searchLocation").value = lat;
              document.getElementById("lang_searchLocation").value = lng;
            });

    </script>

    <div id="map" style="display:none;"></div>

<script type="text/javascript">
 
    $(function() {
        @if(count($SearchList) == 1)
           ShowPropertyPopup("{{$pro_show_id}}");
       @endif
    });


    $(".mapPointer").click(function(){
        var id= $(this).attr('data-id');
            $.ajax({

                url: "https://geoip-db.com/jsonp",
                jsonpCallback: "callback",
                dataType: "jsonp",
                success: function( location ) {
                   $("#lat_searchLocation").val(location.latitude);
                   $("#lang_searchLocation").val(location.longitude);
                   $("#searchLocation_").val(location.city +' ,'+location.state+" ,"+location.country_name);
                }
            }); 
        })



</script>


@stop
