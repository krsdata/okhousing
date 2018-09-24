@php
use Modules\Admin\Entities\CategoryType;
$fcountry_lang=Session::get('fcountry_lang');

$fcountry_language=Session::get('fcountry_language');

$langId=$fcountry_language['id'];

 $categorylistType=CategoryType::select('title','id','parent_id')->where('status','1')->where('language_id',$langId)->orderby('id','ASC')->get();

@endphp



<input type="hidden" name="is_home" value="1"/>
<!--banner and search-->
  <section class="banner_section" id="container">
        <div class="banner_image">
            <img src="" alt="" id="Background_banner_image"class="img-responsive">
        </div>
        <div class="search_wrapper hide">

            <h2>{{trans('countries::home/home.banner_text')}} <span>{{trans('countries::home/home.banner_NEW')}}</span> {{trans('countries::home/home.banner_home')}}</h2>
            <ul class="nav nav-tabs search_nav">
                @php $count=1; @endphp
                @foreach( $categorylistType as $row)
                    <li id="{{ $row->id }}" class=" @if($count==1) active @endif masterid" > <a data-toggle="tab" href="#TabID_{{trim($row->id)}}"> {{ $row->title }} </a></li>
                 @php $count++; @endphp
                 @endforeach 
                <li class=" @if(count($categorylistType) < 1) active @endif"><a data-toggle="tab" href="#uniue">{{trans('countries::home/home.UniueIDSearch')}}</a></li>
            </ul> 

            <div class="moileVisible">
                <div class="row">
                    <div class="col-xs-6">
                        <select class="propertiType" id="MobileFilter" >

                            @php $count=1; $selectedType =''; 
                            if($categorylistType){
                            @endphp
                            @foreach( $categorylistType as $row)
                            @php if($count==1) $selectedType = ($row->parent_id == null)?$row->id:$row->parent_id; @endphp
                                 <option value="TabID_{{trim($row->id)}}" data-id="{{$row->id}}" @if($count==1) selected @endif >{{trim($row->title)}}</option>
                            @php $count++;  @endphp
                            @endforeach 
                            @php } @endphp
                            <option value="uniue">{{trans('countries::home/home.UniueIDSearch')}}</option>
                        </select>
                    </div>
                    <div class="col-xs-6" id="ProjectCategorySelect">
                        <select class="ProjectCategory" name="MsearchCategory">
                            <option value="" disabled selected>{{trans('countries::home/home.Category')}}</option>
                               @php 
                               $categorylist=Modules\Properties\Entities\PropertyCategory::where('master_category_id','like', '%' . $selectedType.'%')->where('status','1')->where('language_id',$langId)->orderby('name','ASC')->get();
                               @endphp
                               @foreach($categorylist as $cat)
                                <option value="{{($cat->parent_id == null)?$cat->id:$cat->parent_id}}" class="{{$cat->master_category_id}}">{{$cat->name}}</option>
                               @endforeach
                        </select>
                    </div>
                </div>
            </div>
            


            <div class="tab-content">

                @php $count=1; 
               
                              
                @endphp
                @foreach( $categorylistType as $row)
                @php
                 $cat_type = ($row->parent_id == null)?$row->id:$row->parent_id;
                 
                 @endphp
                    <div id="TabID_{{ trim($row->id)}}" class="tab-pane fade  @if($count==1) in active @endif "> 
                    <form method="GET" id="Search_form_{{ trim($row->id)}}" name="Search_form_{{ trim($row->id)}}" action="{{URL('/search/')}}">
                    <!--input name="_token" type="hidden" value="{{ csrf_token() }}" /-->
                    <input type="hidden" name="type" value="{{$cat_type}}">
                    
                    <input type="hidden" name="lat" id="lat_searchLocation_{{ trim($row->id)}}">
                    <input type="hidden" name="lang" id="lang_searchLocation_{{ trim($row->id)}}">
                    <input type="hidden" name="CurrentCountrySearch" class="CurrentCountrySearch">

                       <div class="form_wrapper">
                        <div class="input-field input_category input_wrapper ">
                            <select class="appenddiv selectclass" name="searchCategory">
                                <option value="" disabled selected >{{trans('countries::home/home.Category')}}</option>
                               @php 
                               $categorylist=Modules\Properties\Entities\PropertyCategory::where('master_category_id','like', '%' . $cat_type .'%')->where('status','1')->where('language_id',$langId)->orderby('name','ASC')->get();
                               @endphp
                               @foreach($categorylist as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="input-field input_wrapper location_input"><!-- 
                        <input   type="text" class="validate" id="searchLocation_{{ trim($row->id)}}" name="searchLocation"  data-id="Btn_Search_form_{{ trim($row->id)}}" placeholder="{{trans('countries::home/home.Location')}}" onkeypress="autocompleteLocation('searchLocation_{{ trim($row->id)}}')" />

    -->
                         <input   type="text" class="validate  places-autocomplete" id="searchLocation_{{ trim($row->id)}}" name="searchLocation"  data-id="Btn_Search_form_{{ trim($row->id)}}" placeholder="{{trans('countries::home/home.Location')}}" />

 <!-- 
 <input type="text" class="validate valid " id="searchLocation_" name="searchLocation" placeholder="Location" value="India" autocomplete="off">
 -->

                            <img src="{{ asset('public/images/icon-search.png')}}"  data-id="searchLocation_{{ trim($row->id)}}" class="mapPointer ">
                        </div>

                        <div class="search_btn input_wrapper">
                            <a href="javascript::void(0);" id="Btn_Search_form_{{ trim($row->id)}}" onclick="searchFun('Search_form_{{ trim($row->id)}}' ,'{{ trim($row->id)}}');">{{trans('countries::home/home.Search')}}</a>
                        </div>

                        <!--div class="map_search_btn input_wrapper">
                            <a href="#">{{trans('countries::home/home.Search')}}</a>
                        </div-->
                    </div> 

                   </form>

                </div>
                 @php $count++; @endphp
                 @endforeach 
                 
           
                <div id="uniue" class="tab-pane fade @if(count($categorylistType) < 1) active in @endif ">    
                    <div class="form_wrapper">
                        <div class="input-field input_wrapper location_input">
                            <input placeholder="{{trans('countries::home/home.UniueIDSearch')}}" id="searchByuniqueID" type="text" class="validate">
                           
                        </div>

                         

                        <div class="search_btn input_wrapper">
                            <a href="javascript::void(0);" onclick="searchFunByuniqueID();">{{trans('countries::home/home.Search')}}</a>
                        </div>
                    </div>
                </div>    


            </div>
        </div>

        </div>

        <div class="outer_wrapper">

            <div class="mesh_wrapper">

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                       
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

                <div class="mesh">
                    <div class="mesh_content mesh_disabled">
                        
                    </div>
                </div>

            </div>

            <div class="side_btns">
                <!--a href="#" data-title="Notification"></a><br>
                <a href="#" data-title="Favourites"></a-->
            </div>
        </div>
    </section>
<!--/banner and search-->
<div id="map" style="display:none;"></div>
<input type="hidden" id="hidden_active_div" value="">
<style>.pac-container {
 z-index: 80000 !important
}</style>
 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places"></script>


<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfSZam0MGVvUX5sXb0r_zN2Yb-7evucOo&libraries=places"></script>
 -->

<script type="text/javascript">
      var input = document.getElementById('searchLocation_1');
      var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});
      google.maps.event.addListener(autocomplete, 'place_changed', function(){
         var place = autocomplete.getPlace();

        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng(); 

        $("#lat_searchLocation_1").val(latitude);
        $("#lang_searchLocation_1").val(longitude);
        $(".CurrentCountrySearch").val($("#country_name").val());
        $("#lat").val(latitude);
        $("#lng").val(longitude); 
  });



</script>

<script type="text/javascript">
    

    $('input[name="searchLocation"]').keypress(function(event){
        if(event.which==13){
            var id = $(this).data("id");
            $("#"+id).trigger("click");
        }
    });

    function searchFun(form ,id)
    {
        if($("#lang_searchLocation_"+id).val() =='')
        {
            @php $fcountry=Session::get('fcountry'); @endphp
             /*$.ajax({
                 url: "https://geoip-db.com/jsonp",
                jsonpCallback: "callback",
                dataType: "jsonp",
                success: function( location ) {
                   $("#lat_searchLocation_"+id).val(location.latitude);
                   $("#lang_searchLocation_"+id).val(location.longitude);
                    $(".CurrentCountrySearch").val(location.country_name);
                    $("#"+form).submit();
                }
                ,
                error: function (request, textStatus, errorThrown) {
                       $("#"+form).submit();              
                }
            });*/ 

             $("#"+form).submit();

            /*var CurrentCountrySearch =  $(".CurrentCountrySearch").val().toLowerCase();;
            var SelectedCountrySearch =  {{$fcountry['name']}};

            if( CurrentCountrySearch !== SelectedCountrySearch.toLowerCase()) { 
                var geocoder =  new google.maps.Geocoder();
                geocoder.geocode( { 'address': country_name = $("#country_name").val()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                       $("#lat_searchLocation_"+id).val(latitude);
                       $("#lang_searchLocation_"+id).val(longitude);
                        $(".CurrentCountrySearch").val($("#country_name").val());
                          $("#"+form).submit();
                    }
                });
            }*/
        }
        else
        {
            
             /*$.ajax({
                 url: "https://geoip-db.com/jsonp",
                jsonpCallback: "callback",
                dataType: "jsonp",
                success: function( location ) {
                    $(".CurrentCountrySearch").val(location.country_name);
                     $("#"+form).submit();
                },
                error: function (request, textStatus, errorThrown) {
                           $("#"+form).submit();          
                } 
            }); */
             $("#"+form).submit();
        }
       
    }

    function callback()
    {
       
    }
    $(".mapPointer").click(function(){
        var id= $(this).attr('data-id');
            $.ajax({
                 url: "https://geoip-db.com/jsonp",
                jsonpCallback: "callback",
                dataType: "jsonp",
                success: function( location ) {
                    $("#lat_"+id).val(location.latitude);
                    $("#lang_"+id).val(location.longitude);
                    $(".CurrentCountrySearch").val(location.country_name);
                    $("#"+id).val(location.city +' ,'+location.state+" ,"+location.country_name);
                }
            }); 
        })

function autocompleteLocation(id){

    var input = document.getElementById(id);
    var country = document.getElementById('country_code').value;
    
    var options = {
     // types: ['(cities)'],
      componentRestrictions: {country: country}
    };
    //var options = {}

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
      
      document.getElementById("lat_"+id).value = lat;
      document.getElementById("lang_"+id).value = lng;
    });
    }

    $("#MobileFilter").change(function(){

        


        $(".tab-pane").removeClass("active in");
        $("#"+$(this).val()).addClass("active in");
        if( $(this).val() == 'uniue')
        {
            $(".select-wrapper.ProjectCategory").hide();
        }
        else
        {
            var selectedType = $(this).find(':selected').attr('data-id');
             $.ajax({
                type: 'GET',
                url: base_url+"/search/getcategory/"+selectedType, 
                dataType: 'json',
                success: function (data) {
                if(data.status==true) { 
                    $("#ProjectCategorySelect").html(data.Options);
                    $('select').formSelect();
                 }
                else {   }
                          
                },              
            });
            $(".select-wrapper.ProjectCategory").show();
        }
    });


 $('#searchByuniqueID').keypress(function(event){
        if(event.which==13){
            searchFunByuniqueID();
        }
    });


function searchFunByuniqueID()
{
    var searchByuniqueID = $("#searchByuniqueID").val();
    if(searchByuniqueID !=='')
    {

        window.location.href =  base_url+"/search/searchFunByuniqueID/"+searchByuniqueID;
        
      /*  $.ajax({
            type: "GET",
            url: base_url+"/search/searchFunByuniqueID/"+searchByuniqueID, 
            dataType: "json",  
            cache:false,
            contentType: false,                   
            processData:false,
            success: function(response){
               if(response.status==true){ $("#PropertyDetails").html(response.html);
                     $("#OpenPropertyDetailModal").trigger("click");
                     
                }
                else
                {
                    $("#modalRecordsNotFound").trigger("click");
                    $("#searchByuniqueID").val('');
                }
              
            },
            error: function (request, textStatus, errorThrown) {
                $("#modalRecordsNotFound").trigger("click");
                $("#searchByuniqueID").val('');
            }             
        });*/
    }
}


</script>

  <div class="modal fade modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md list-detail" role="document">
            <div class="modal-content">
                <div class="close-popup" data-dismiss="modal"><img src="{{ asset('public/images/close.svg')}}" alt=""></div>
                <div class="messageBox">
                    <p class="">Records not found</p>
                    <input type="hidden" id="DeletePropertyURL" value="">
                    <a href="#" class="btn btnYes" data-dismiss="modal">Okay</a>    
                </div>
            </div>
        </div>
    </div>
<button class="icon" id="modalRecordsNotFound" data-toggle="modal" data-target=".modalDelete" style="display: none;"></button>
<style type="text/css">
    ul.dropdown-content.select-dropdown {
    max-height: 229px !important;
}
.input_category  .dropdown-content{
  max-height: 200px !important;
}

.banner_section .mesh_content.mesh_active{cursor: pointer;}
</style>

