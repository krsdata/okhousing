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

function money_format_6($money)
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
 $country_flag = $fcountry['flag'];

@endphp
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
div#PropertyDetails {
    margin-top: 80px !important;
}

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

.add-property.search .search-area .property-search .drop-down .drop-down-main li input::placeholder{color: #4e5e87;
    font-size: 0.613em;
    font-weight: 400;}

    </style>

<input type="hidden" name="Pagination_total" id="Pagination_total" value="{{@$Pagination['total']}}">
<input type="hidden" name="Pagination_page" id="Pagination_page" value="{{@$Pagination['page']}}">


    <section class="add-property search">
        <div class="container-fluid">
            <form method="GET" action="{{ URL('search/filter') }}" id="SearchBarForm" name="SearchBarForm">
            <!--input name="_token" type="hidden" value="{{ csrf_token() }}" /-->
            <input type="hidden" name="type" value="{{$Filter['type']}}">
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

                                            <option value="{{$cat->id}}" @if($Filter['searchCategorySelected']) {{ ( in_array($cat->parent_id ,$Filter['searchCategorySelected']) || in_array($cat->id ,$Filter['searchCategorySelected']) )?'selected':''}} @endif>{{$cat->name}}</option>
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
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 xspx0">
                        <div class="property-search">
                            <ul>

 <?php //foreach($CategoryType as $row){   echo $row['id']; print_r($row['title']);   } die;   ?> 

                                <li class="dd-1 active"><a href="#">{{trans('countries::home/home.prop_type')}} @if($Filter['PropertyType'])<span><i class="fas fa-check"></i></span> @endif</a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <div class="block">
                                               <ul>
                                                @foreach($CategoryType as $row)
                                                    <li>
                                                        <input type="checkbox" class="filled-in PropertyType" id="Pro{{$row['id']}}" name="PropertyType[]" value="{{ ($row['parent_id'] =='')?$row['id']:$row['parent_id']}}" @if($Filter['PropertyType']) @if(in_array($row['id'] ,$Filter['PropertyType'] ) || in_array($row['parent_id'] ,$Filter['PropertyType'])) checked="true" @endif @endif/>
                                                        <label for="Pro{{$row['id']}}">{{$row['title']}}</label>
                                                    </li>
                                                @endforeach
                                                </ul> 
                                            </div>
                                                                                   
                                        </div>
                                    </div>
                                </li>

                    <input type="hidden" name="lat" id="lat_searchLocation" value="{{$Filter['lat']}}">
                    <input type="hidden" name="lang" id="lang_searchLocation" value="{{$Filter['lang']}}">

                    @php if($Filter['lat'] =='' && $Filter['lang'] =='')
                    {
                        if(count($SearchList) > 0)
                        {
                            $latmap = @$SearchList[0]->latitude;
                            $langmap= @$SearchList[0]->longitude;
                        }
                       else
                       {
                            $latmap = @$IPData->latitude;
                            $langmap= @$IPData->longitude;
                       }

                    }else
                    {
                         $latmap = $Filter['lat'];
                        $langmap= $Filter['lang'];
                    }


                    @endphp
                                <li class="dd-2 active budgetWrap"><a href="#">{{trans('countries::home/home.budget')}} @if($Filter['BudgetMin'] || $Filter['BudgetMax'])<span><i class="fas fa-check"></i></span> @endif</a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <!--h4>{{trans('countries::home/home.budget')}}</h4-->
                                            <ul>
                                                <li>
                                                    <label >{{trans('countries::home/home.min')}} </label>
                                                    <input type="number" class="filled-in ParameterFiterSearchResult1" placeholder="" name="BudgetMin"  value="{{@$Filter['BudgetMin']}}"/>         
                                                </li>
                                                <li>
                                                    <label >{{trans('countries::home/home.max')}}</label>
                                                    <input type="number" class="filled-in ParameterFiterSearchResult1" value="{{@$Filter['BudgetMax']}}" placeholder="" name="BudgetMax" /> 
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="dd-3 active"><a href="#">{{trans('countries::home/home.BedRoom')}} 
                                    @if($Filter['BedRoom'])<span><i class="fas fa-check"></i></span> @endif
                                    <i class="fas fa-sort-down"></i></a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <!--h4>{{trans('countries::home/home.BedRoom')}}</h4--->
                                            <ul>
                                                 <li>
                                                    <input type="number" name="BedRoom" class="filled-in ParameterFiterSearchResult1" placeholder="{{trans('countries::home/home.noofBedRoom')}}" value="{{@$Filter['BedRoom']}}" />         
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="dd-4 active"><a href="#">{{trans('countries::home/home.area')}} @if($Filter['AreaMin'] || $Filter['AreaMax'])<span><i class="fas fa-check"></i></span> @endif<i class="fas fa-sort-down"></i></a>
                                    <div class="drop-down">
                                        <div class="drop-down-main">
                                            <!--h4>{{trans('countries::home/home.area')}}</h4--->
                                            <ul class="areaDrop">
                                                <li>
                                                    <label >{{trans('countries::home/home.min')}} </label>
                                                    <input type="number" class="filled-in ParameterFiterSearchResult1" placeholder="" name="AreaMin" value="{{@$Filter['AreaMin']}}" />         
                                                </li>
                                                <li>
                                                    <label >{{trans('countries::home/home.max')}}</label>
                                                    <input type="number" class="filled-in ParameterFiterSearchResult1" placeholder=" " name="AreaMax" value="{{@$Filter['AreaMax']}}" /> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--div class="dropdown-overlay-2"></div-->
            </div>
          

            </form>

            <div class="row contant-inner" id="FiterSearchResponse">
                <div class="col-lg-6 col-sm-6 col-xs-12 px0">
                    <div id="Mymap" style="height: 100vh; width: 100%;"></div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12 grid-list-box">
                    <div class="right-box">

                        @if(@$Filter['Metropolian'])
                          <h5>{{@$Pagination['total']}} -{{ $Filter['cities']}} </h5>

                        @elseif(count($SearchList) == 0)

                        <h5>{{@$Pagination['total']}} -{{trans('countries::home/home.resultfound')}}</h5>
                        
                        @else
                        
                         <h5>{{@$Pagination['total']}} -{{trans('countries::home/home.resultfound')}}</h5>
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



                                     $LocationMarker[] = array('title'=>$property_details['title'] , 'lat' =>$Property->latitude ,'lang'=>$Property->longitude ,'id' => $Property->id ,'icon'=> URL('/public/1.png') ,'title' => $property_details['title']);

                                    @endphp
                                    <div class="col-lg-4 col-sm-6 col-xs-12 property_container "  onclick="ShowPropertyPopup({{$Property->id}})">
                                        <div class="property_wrapper property-List " id="property-{{$Property->id}}">
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
                                                <h5><?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span><?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?></span>
                                                <?php } ?>

                                                {{  money_format_6($Property->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

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
                                    
                                    <div class="col-lg-12 col-sm-12 col-xs-12" style="height: 200px;"><div class="preLoad Noloader"></div></div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
        <!--div class="dropdown-overlay"></div-->

      
    </section>

    
   

  
   
    <script type="text/javascript">

    $('body').on('change', '.PropertyType', function(e) {
       $('#FiterSearchResult').click(); 
    });

    $('body').on('keyup', '.ParameterFiterSearchResult', function(e) {
       $('#FiterSearchResult').click(); 
    });

    $('body').on('blur', '.ParameterFiterSearchResult1', function(e) {
       $('#FiterSearchResult').click(); 
    });

       $('body').on('click', '#FiterSearchResult', function(e) {

        e.preventDefault();
        if($("input[name='searchLocation']").val() =='')
        {
            $("#lat_searchLocation").val("");
            $("#lang_searchLocation").val("");
        }
        $('#SearchBarForm').submit();
                 /*   e.preventDefault();
                    $.ajax({
                                type: "GET",
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

       <?php if($Filter['searchLocation'] !=''){?>
        var zoom = 12;
        <?php } else{ ?>

            var zoom=12;
        <?php } ?>

        var map = new google.maps.Map(document.getElementById('Mymap'), {
          zoom: zoom,
          center: new google.maps.LatLng('{{$latmap}}', '{{$langmap}}'),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        map.setOptions({ minZoom: 5, maxZoom: 20 });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

         @if(count($LocationMarker) == 0)


          var latLng = new google.maps.LatLng('{{$latmap}}', '{{$langmap}}');
        var marker = new google.maps.Marker({
            position: latLng,
        });
        marker.setMap(map);


       /* var geocoder =  new google.maps.Geocoder();
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

        google.maps.event.addListener(marker, 'mouseout', function() {
             $(".property-List").removeClass("activeProperty");

        });
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
 <link href="{{asset('public/web/css/register.css')}}" rel="stylesheet"> 
<script type="text/javascript">
 $(function() {
    @if(isset($unique) && isset($pro_show_id))
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

 jQuery(function($) {
            $('.search .tab-content').on('scroll', function() {
                if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                    
                    var Pagination_total = $("#Pagination_total").val();
                    var Pagination_page = $("#Pagination_page").val();
                    var nextPage = parseInt(Pagination_page) + 1; 
                    var nextFetch = parseInt(Pagination_page) * 6;

                    $("#Pagination_page").val(nextPage);
                    if(Pagination_total > nextFetch)
                    {
                        var formdata=  new FormData($('#SearchBarForm')[0]);
                        formdata.append('page', nextPage);
                        $(".preLoad").parent().css("height","200px");
                        $(".preLoad").removeClass( "Noloader" );
                        $(".preLoad").addClass( "addloader" );


                        $.ajax({
                                type: "POST",
                                url: base_url+"/search/filterPagination", 
                                data: formdata,
                                dataType: "json",  
                                cache:false,
                                contentType: false,                   
                                processData:false,
                                success: function(response){
                                   if(response.status==true){ 

                                    $("#favorites").append(response.html);
                                    $(".preLoad").addClass( "Noloader" );
                                    $(".preLoad").parent().css("height","0px");

                                 }
                                },
                                error: function (request, textStatus, errorThrown) {
                                    
                                }             
                        });


                    }

                }
            })
        });


</script>


@stop
