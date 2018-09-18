@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
 $Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];

$pro = Modules\Website\Entities\PropertyViewCount::where('property_id',$property_lists->id)->first();
$count = @$pro->count;
$count = (!empty($count))?$count:0;


$property_categories = Modules\Properties\Entities\PropertyCategory::where(array('status'=>1,'language_id'=>$Selected_lang))->where('id','=',$property_lists->category_id)->orWhere('id','=',$property_lists->category_id)->first();


$fcountry=Session::get('fcountry');

$countryId=$fcountry['created_country_id'];

 $building_area = Modules\Properties\Entities\BuildingUnits::with(['types' => function ($query) use ($Selected_lang)
    {
    $query->where('language_id',$Selected_lang);

}])->where('id',$property_lists->building_unit_id)->first();

$land_area = Modules\Properties\Entities\LandUnits::where('language_id',$Selected_lang)->where('id',$property_lists->land_unit_id)->orWhere('parent_id',$property_lists->land_unit_id)->first();


$images = Modules\Properties\Entities\PropertyImages::where('property_id',$property_lists->id)->orderBy('is_featured','DESC')->get();




$property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

$property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$property_lists->id)->first();


$AboutUs = $UserName ='User';
$Email= $mobile='';

$userCountry = Modules\Users\Entities\UserCountry::where('user_id',$property_lists->user_id)->first();
$user_countries_id = $userCountry->id;

$resultData = Modules\Users\Entities\UserDetails::where('user_countries_id',$user_countries_id)->where('language_id',$Selected_lang)->first();




 if($resultData){
        
        $User = Modules\Users\Entities\Users::where('id',$property_lists->user_id)->first();

        $Email = @$User->email;
        $mobile = @$User->mobile;
        $UserName = @$resultData->name;
 }

 @endphp
<style type="text/css">

i.fas.fa-heart {
    cursor: pointer;
}

     .fa-angle-left , .fa-angle-right {
    left: 50%;
    }

   .fa-angle-left,  .fa-angle-right {
    position: absolute;
    top: 50%;
    margin-top: -10px;
    z-index: 5;
    display: inline-block;
} 
    @media screen and (min-width: 768px)
    {
.fa-angle-left{
    margin-left: -10px;
}

   
}
    @media screen and (max-width: 768px)
    {

        ul.nav-tabs {
    margin-top: 32px;
}

    .singlePrice {
    background: white;
    position: absolute;
    top: -60px !important;
  
    margin-bottom: 15px !important;
}
}
@media screen and (min-width: 768px)
{
 .fa-angle-left, .fa-angle-right {
    width: 30px;
    height: 30px;
    margin-top: -10px;
    font-size: 30px;
}
}

.glyphicon {
    top: 50% !important;

    }


.list-detail .list-detail-main .list-contant .nav-tabs
{
    font-size: 12px;
    height: 19px;
}

.list-detail .list-detail-main .nav-tabs>li.active>a
{
    border:none;
}


.list-detail .list-detail-main .nav-tabs>li.active,

{
    border-bottom: 2px solid #feb63d;
    list-style-type:none;
    color: black;
    text-decoration: none;
}
.list-detail .list-detail-main .list-contant>.box-one .tab-content
{
    margin-top: 20px;
}
a:hover {
    text-decoration: none !important;
}
.list-detail .list-detail-main .nav-tabs > li > a {
    color: grey;
}
.list-detail .list-detail-main .list-contant .box-one .box-one-contant ul.list-one li:nth-child(2) .fav-icon i
{
        margin: 8px 0 0 5px !important;
}
@media only screen and (max-width: 991px) {ul.dropdown-content.select-dropdown {
    max-height: 190px !important;
} }@media only screen and (max-width: 1199px) {ul.dropdown-content.select-dropdown {
    max-height: 200px !important;
} }
 .modal1 .list-detail .list-contant .nav-tabs>.active {border-bottom: 2px solid #ffbc00 !important;}

 .yellow-txt {
    color: #feb63d;
    display: inline !important;
    font-weight: bold;
    margin-top: 10px;
}

p.yellow-txt1 {
   margin-top: 10px;
}


.modal-dialog .list-detail-main .nav-tabs > li > a:hover,.modal-dialog .list-detail-main .nav-tabs > li > a:focus {text-decoration:none !important;}

.list-detail .list-detail-main .nav-tabs > li > a{border-bottom: none !important;}
</style>


               <div class="list-detail-main"  onload="initializeMap()">
                <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                    <div class="list-cover">
                        <div class="cover-img">
                            
                            @if(count($images) > 0)
                             <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        @php $img_loop = 0; @endphp
                                        @foreach($images as $image)
                                            <li data-target="#myCarousel" data-slide-to="{{$img_loop}}" class="@if($img_loop == 0 )active  @endif"></li>
                                         @php $img_loop++; @endphp
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                  
                                    @php $img_loop = 0; @endphp
                                    @foreach($images as $image)
                                      <div class="item @if($img_loop == 0 )active  @endif">
                                        <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="{{$image->image}}">
                                      </div>
                                     @php $img_loop++; @endphp
                                    @endforeach
                                    
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                      <span class="glyphicon ">
                                       <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        </span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                      <span class="glyphicon">
                                         <i class="fa fa-angle-right" aria-hidden="true"></i>
                                      </span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                @else

                                    <img src="{{asset('public/images/cover.jpg')}}" alt="">

                                @endif
                        </div>
                        @if(Auth::guard('front_user')->user()  &&  $property_lists->user_id != Auth::guard('front_user')->user()->id) 
                        <div class="list-price">
                            <span>{{trans('countries::home/home.rupee')}} {{$property_lists->prize}}</span>
                        </div>
                        @endif
                    </div>

                    

                    <input type="hidden" value="{{ $property_lists->latitude}}" id="Pro_map_lat">
                    <input type="hidden" value="{{ $property_lists->longitude}}" id="Pro_map_lang">
                    <div class="list-contant">
                        <div class="box-one">
                            <div class="box-one-contant">
                                <ul class="list-one">
                                    <li>
                                        <h3>{{ $property_details['title']}}</h3>
                                        <span>{{$property_lists->location}}</span>
                                        <p class="yellow-txt1">U.ID - <span class="yellow-txt">{{$property_lists->uid}}</span></p>
                                    </li>
                                    <li>
                                        <span class="views pull-right">{{$count}} Views</span>
                                        <form method="POST" id="AddTowishlist_{{$property_lists->id}}" name="AddTowishlist_{{$property_lists->id}}">
                                        <?php $style='';
                                        if(Auth::guard('front_user')->user() )
                                            {
                                                if($property_lists->user_id != Auth::guard('front_user')->user()->id)
                                                { 
                                                    $Wishlist = Modules\Website\Entities\Wishlist::where('property_id',$property_lists->id)->where('user_id',Auth::guard('front_user')->user()->id)->count();

                                                    if($Wishlist > 0)
                                                    $status = 'active';
                                                    else
                                                    $status = 'inactive'; 
                                                    $LoggedIn= 1;
                                                }
                                                else
                                                {
                                                    $style="display:none";
                                                    $status = '';
                                                    $LoggedIn= 1; 
                                                }
                                            }
                                            else
                                            {
                                                $status = 'inactive';
                                                $LoggedIn= 0; 
                                            }
                                        ?>
                                      
                                        <input type="hidden" name="property_id" value="{{$property_lists->id}}">

                                        <input type="hidden" name="status" value="{{$status}}">
                                        <input  type="hidden" id="AddTowishlist_status" value="{{ $status }}" />
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            
                                        <div class="fav-icon {{@$status}}" style="{{$style}}" id="i_AddTowishlist_{{$property_lists->id}}" onclick="AddTowishlist('{{$property_lists->id}}','{{$LoggedIn}}')"><i class="fas fa-heart"></i></div>
                                        </form>
                                       <?php //} ?>
                                    </li>
                                </ul>
                               

                                @if(Auth::guard('front_user')->user() )
                                    @if($property_lists->user_id == Auth::guard('front_user')->user()->id) 
                                        <span class="pull-right singlePrice">{{trans('countries::home/home.rupee')}} {{$property_lists->prize}}</span>
                                    
                                    @endif
                                @else
                                    <span class="pull-right singlePrice">{{trans('countries::home/home.rupee')}} {{$property_lists->prize}}</span>

                                @endif

                                <ul class="nav-tabs">
                                      <li class="active"><a data-toggle="tab" href="#menu1">{{@$property_categories->name}}</a></li>
                                      <li class="pull-right"><a data-toggle="tab" href="#owner">By Owner</a></li>
                                </ul>
                               
                                <div class="tab-content">
                                <div id="menu1" class="tab-pane fade in active">
                                     <ul class="list-three">
                                        <li>
                                            <span><img src="{{asset('public/images/icon-bed.png')}}" alt=""></span> {{$property_lists->bedroom}}
                                        </li>
                                        <li>
                                            <span><img src="{{asset('public/images/icon-bath.png')}}" alt=""></span> {{$property_lists->bathroom}}
                                        </li>
                                        <li>
                                            <span><img src="{{asset('public/images/icon-area.png')}}" alt=""></span> {{$property_lists->building_area}} {{ (count($building_area->types)> 0)?$building_area->types[0]->unit:$building_area->unit}}
                                        </li>
                                        <li>
                                            <span>Plot area</span>
                                        </li>


                                        <li>
                                            <span>{{$property_lists->land_area}} {{ $land_area->land_unit}}</span>
                                        </li>
                                    </ul>
                                </div>

                                <div id="owner" class="tab-pane fade ">
                                    <p><b>Name :</b>  {{$UserName}}</p>
                                    <p><b>Email :</b>  {{$Email}}</p>
                                    <p><b>Mobile No. :</b> {{$mobile}}</p>
                                </div>

                            </div>
                            </div>
                        </div>
                        @if($property_details['description'])
                        <div class="box-two">
                            <h5>Description</h5>
                            <p>{{ $property_details['description']}}</p>
                        </div>
                        @endif

                        <?php 
                        if(sizeof($amenities) >0){
                        $cols = array_chunk($amenities->toArray(), ceil(count($amenities->toArray())/3));  
                        $amenities=$amenities->toArray();
                        $selectedvalue = $property_lists->property_created_amenities->pluck('amenity_id')->toArray(); ?>

                        @if($selectedvalue)
                        <div class="box-three">
                            <h5>Amenities</h5>
                            <div class="amenities">

                                @foreach ($cols as $amenities)
                                @foreach($amenities as $amenity)
                                @php $amenityid = (is_null($amenity['parent_id']))?$amenity['id']:$amenity['parent_id']; 
                                 @endphp
                                 @if(in_array($amenityid,$selectedvalue))

                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{ URL::asset('public/images/amenities/'.$amenity['icon']) }}" alt=""></div>
                                    <div class="contant-box">
                                        <p>{{$amenity['name']}}</p>
                                    </div>
                                </div>
                                @endif
                               @endforeach
                               @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                         <?php } ?>

                        @php $Ncount = 1; 
                        $selectedneigh = $property_lists->property_created_neighbourhoods->toArray(); 
                        @endphp
                        
                       
                      
                        <div class="box-four">
                              @if($selectedneigh)
                            <div class="locate-box">
                                <div class="popup-tab">
                                    <h5>NEIBOURHOOD</h5>

                                    <div class="popup-tab">
                                        <ul class="nav-tabs">
                                            @foreach($neighbourhoods as $key=>$neighbourhood)

                                                @php
                                                $neighbourhood_id = (is_null($neighbourhood->parent_id))?$neighbourhood->id:$neighbourhood->parent_id;
                                                @endphp
                                                @foreach($selectedneigh as $selected)  @if($selected['neighbourhood_id']==$neighbourhood_id)

                                                @php
                                                  $show_neigh = Modules\Properties\Entities\Neighbourhood::find($selected['neighbourhood_id']);
                                                    if($show_neigh->parent_id !== null)
                                                    {
                                                        $show_neigh = Modules\Properties\Entities\Neighbourhood::find($show_neigh->parent_id);
                                                    }
                                                @endphp
                                                <li class="@if($Ncount == 1) active @endif"><a data-toggle="tab" href="#menu{{$show_neigh->name}}" onclick="showNeighbourhoodMap('{{$show_neigh->name}}',{{$selected['kilometer']}})">{{$neighbourhood->name}}</a></li>
                                                @endif
                                                @endforeach
                                                @php $Ncount++; @endphp
                                                @endforeach
                                        </ul>

                                        <div class="tab-content">

                                           @php $Ncount = 1; 
                                            $selectedneigh = $property_lists->property_created_neighbourhoods->toArray(); 
                                            @endphp
                                            
                                            @foreach($neighbourhoods as $key=>$neighbourhood)

                                            @php
                                            $neighbourhood_id = (is_null($neighbourhood->parent_id))?$neighbourhood->id:$neighbourhood->parent_id;
                                            @endphp
                                            @foreach($selectedneigh as $selected)  @if($selected['neighbourhood_id']==$neighbourhood_id)

                                            @php
                                              $show_neigh = Modules\Properties\Entities\Neighbourhood::find($selected['neighbourhood_id']);
                                                if($show_neigh->parent_id !== null)
                                                {
                                                    $show_neigh = Modules\Properties\Entities\Neighbourhood::find($show_neigh->parent_id);
                                                }

                                               
                                            @endphp


                                             <div id="menu{{$show_neigh->name}}" class="tab-pane fade @if($Ncount == 1) in active @endif">
                                                <div id="gmap_canvas_{{$show_neigh->name}}" class="gmap_canvas"></div>
                                               
                                            </div>

                                            @endif
                                            @endforeach
                                            @php $Ncount++; @endphp
                                            @endforeach

                                            <!--div id="menu" class="tab-pane fade  in active ">
                                                <div id="gmap_canvas" onload="initializeMap()"></div>
                                            </div-->

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                            <?php
                                $url= 'http://ok4housing.com/';
                                $title=urlencode($property_details['title'])." Price:{{trans('countries::home/home.rupee')}} ".urlencode($property_lists->prize);
                              //  $url=urlencode($url);
                                $Summary=urlencode( substr($property_details['desc'],0,99));
                            ?>
                            <?php if(Auth::guard('front_user')->user())
                            {   if(Auth::guard('front_user')->user()->id  != $property_lists->user_id) { ?>
                            <div class="socialbox">
                                <div class="col-sm-5 co-xs-12">
                                    <p>Liked this property? Share with people </p>
                                </div>
                                <div class="col-sm-7 co-xs-12">
                                    <ul>
                                        <li>

                                            <!--a href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo  $title;?>&amp;p[summary]=<?php echo substr($Summary, 0, 99); ?>&amp;p[url]=<?php echo $url; ?>" target="_blank"-->

                                    <a href="https://www.facebook.com/dialog/feed?app_id=812098752320442%20&redirect_uri={{$url}}%20&link={{$url}}%20&picture=http://ok4housing.com/public/images/properties/1529566763.jpg&caption={{$title}}%20&description={{$Summary}}"  target="_blank">
                                        <img src="{{ asset('public/images/fb.png')}}" alt=""></a></li>


                                        <li><a href="https://twitter.com/intent/tweet?related=ok4homes&amp;text=ok4homes:<?php echo substr($title, 0, 99); ?>;url=<?php echo $url; ?>" target="_blank"><img src="{{ asset('public/images/twtter.png')}}" alt=""></a></li>


                                        <li> <a href="javascript:(
                                                  function(){
                                                    var w=480;var h=380;
                                                    var x=Number((window.screen.width-w)/2);
                                                    var y=Number((window.screen.height-h)/2);
                                                    window.open('https://plusone.google.com/_/+1/confirm?hl=en&url='+encodeURIComponent(location.href)+'
                                                        &title='+encodeURIComponent(document.title),'','width='+w+',height='+h+',left='+x+',top='+y+',
                                                        scrollbars=no');
                                                  })();">
                             <img src="{{ asset('public/images/g-plus.png')}}" alt=""></a></li>
                                        
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        <?php } }else { ?>


                            <div class="socialbox">
                                <div class="col-sm-5 co-xs-12">
                                    <p>Liked this property? Share with people </p>
                                </div>
                                <div class="col-sm-7 co-xs-12">
                                    <ul>
                                        <li>

                                            <!--a href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo  $title;?>&amp;p[summary]=<?php echo substr($Summary, 0, 99); ?>&amp;p[url]=<?php echo $url; ?>" target="_blank"-->

                                    <a href="https://www.facebook.com/dialog/feed?app_id=812098752320442%20&redirect_uri={{$url}}%20&link={{$url}}%20&picture=http://ok4housing.com/public/images/properties/1529566763.jpg&caption={{$title}}%20&description={{$Summary}}"  target="_blank">
                                        <img src="{{ asset('public/images/fb.png')}}" alt=""></a></li>


                                        <li><a href="https://twitter.com/intent/tweet?related=ok4homes&amp;text=ok4homes:<?php echo substr($title, 0, 99); ?>;url=<?php echo $url; ?>" target="_blank"><img src="{{ asset('public/images/twtter.png')}}" alt=""></a></li>


                                        <li> <a href="javascript:(
                                                  function(){
                                                    var w=480;var h=380;
                                                    var x=Number((window.screen.width-w)/2);
                                                    var y=Number((window.screen.height-h)/2);
                                                    window.open('https://plusone.google.com/_/+1/confirm?hl=en&url='+encodeURIComponent(location.href)+'
                                                        &title='+encodeURIComponent(document.title),'','width='+w+',height='+h+',left='+x+',top='+y+',
                                                        scrollbars=no');
                                                  })();">
          <img src="{{ asset('public/images/g-plus.png')}}" alt=""></a></li>
                                        
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php } ?>
                        </div>

                      
                        @if($SPlist)
                        <div class="clearfix"></div>
                        <div class="box-five">
                            <div class="grid-list-box">
                                <div class="right-box">
                                    <h5>Similar properties</h5>
                                    <div class="profile-tab-box featured_properties featured_properties_slick">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active row popup-slide-1" id="popup-slide-1">
                                                
                                                @foreach($SPlist as $property)
                                                     @php
                                                     $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                                        {
                                                            $query->where('language_id',$Selected_lang);

                                                        }])->where('id',$property->category_id)->first();

                                                    $PropertyType = Modules\Properties\Entities\PropertyType::with(['types' => function ($query) use ($Selected_lang)
                                                        {
                                                            $query->where('language_id',$Selected_lang);

                                                        }])->where('id',$property->type_id)->first();


                                                    $building_area = Modules\Properties\Entities\LandUnits::with(['types' => function ($query) use ($Selected_lang)
                                                        {
                                                            $query->where('language_id',$Selected_lang);

                                                        }])->where('id',$property->building_unit_id)->first();
                                                     
                                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$property->id)->where('is_featured','1')->first();

                                                     @endphp
                                                     <div class="col-sm-4 col-xs-12 property_container">
                                                        <div class="property_wrapper" onclick="ShowProperty('{{$property->id}}')" >
                                                            <div class="image_wrapper">
                                                                <div class="badge rent">{{ @$Type->created_type->title}}</div>
                                                                <img src="{{asset('public/images/properties/'.@$image->image)}}"   onerror="this.src='{{asset('public/default-property.jpg')}}';" alt="" class="img-responsive">
                                                                <div class="property_deatil">
                                                                    
                                                                    <h4>{{ $property->name}}</h4>
                                                                    <span class="loaction">{{ $property->location}}</span>
                                                                </div>

                                                            </div>
                                                            <div class="content_wrapper">
                                                                <h5><span>{{trans('countries::home/home.rupee')}}</span> {{ $property->prize}}/- <small>Per Month</small></h5>

                                                                <div class="quick_detail_list">
                                                                    <ul>
                                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{ $property->bedroom}}</li>
                                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{ $property->bathroom}}</li>
                                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{ $property->building_area}} {{ @$building_area->land_unit}}</li>
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
                        @endif
                        <div class="clearfix"></div>
                        @if(Auth::guard('front_user')->user()  &&  $property_lists->user_id != Auth::guard('front_user')->user()->id) 
                        <div class="list-form-box">
                            <form method="post" id="property_enquiry" name="property_enquiry">
                            <input type="hidden" name="property_id" value="{{$property_lists->id}}">
                            <input type="hidden" name="owner_id" value="{{$property_lists->user_id}}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            
                            <div id="enquiryerror" class="has-error"><span class="help-block"> </span></div>

                            <div class="form-box-main">
                                <div class="input-field" id="nameBox">
                                    <input id="enquiry_name" name="enquiry_name" type="text" class="validate">
                                    <label for="last_name">Name</label>
                                    <span class="help-block"></span>
                                </div>
                                <div class="input-field" id="usernameBox">
                                    <input id="enquiry_email" name="enquiry_email" type="text" class="validate">
                                    <label for="last_name">Email</label>
                                    <span class="help-block"></span>
                                </div>
                                <div class="input-field" id="phonenobox">
                                    <input id="enquiry_phone" name="enquiry_phone" type="text" class="validate">
                                    <label for="last_name">Mobile</label>
                                    <span class="help-block"></span>
                                </div>
                                <div class="input-field" id="subjectbox">
                                    <input id="enquiry_subject" name="enquiry_subject" type="text" class="validate">
                                    <label for="last_name">Subject</label>
                                    <span class="help-block"></span>
                                </div>
                                <div class="input-field" id="messagebox">
                                    <input id="enquiry_message" name="enquiry_message" type="text" class="validate">
                                    <label for="last_name">Message</label>
                                    <span class="help-block"></span>
                                </div>
                                <button class="btn-box" id="property_enquiry_btn" >Enquire now</button>
                            </div>
                           </form>
                        </div>
                         @endif
                    </div>
                </div>


<style type="text/css">

.glyphicon-chevron-left:before {
    content: "\e079";
}
.glyphicon-chevron-right:before {
    content: "\e080";
}

    .singlePrice{
        position: absolute;
        top: 15px;
        right: 30px;
        width: 200px;
        border: 1px solid #eee;
        padding: 10px;
        border-radius: 5px;
        text-align: right;
        font-size: 23px;
    }
    @media(max-width: 767px){
        .singlePrice{
           
            top: 0px;
            right: 10px;
            margin-bottom: 15px;
        }
    }
    div.gmap_canvas {
    width: 100%;
    height: 250px;
}
.modal1  {
    display: none;
    overflow: hidden;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    -webkit-overflow-scrolling: touch;
    outline: 0;
    height: 600px;
    overflow-y: scroll;
}
</style>
<script type="text/javascript">
  var geocoder;
var map;
var markers = Array();
var infos = Array();


// clear overlays function
function clearOverlays() {
    if (markers) {
        for (i in markers) {
            markers[i].setMap(null);
        }
        markers = [];
        infos = [];
    }
}

// clear infos function
function clearInfos() {
    if (infos) {
        for (i in infos) {
            if (infos[i].getMap()) {
                infos[i].close();
            }
        }
    }
}

// create markers (from 'findPlaces' function)
function createMarkers(results, status) {
     if (status == google.maps.places.PlacesServiceStatus.OK) {

        // if we have found something - clear map (overlays)
        clearOverlays();

        // and create new markers by search result
        for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
        }
    } else if (status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
        //alert('Sorry, nothing is found');
    }
}

// creare single marker function
function createMarker(obj) {

    // prepare new Marker object
    var mark = new google.maps.Marker({
        position: obj.geometry.location,
        map: map,
        title: obj.name,
        icon: base_url+'/public/Mapicon1.png',
    });
    markers.push(mark);

    // prepare info window
    var infowindow = new google.maps.InfoWindow({
        content: '<img src="' + obj.icon + '" /><font style="color:#000;">' + obj.name + 
        '<br />Rating: ' + obj.rating + '<br />Vicinity: ' + obj.vicinity + '</font>'
    });

    // add event handler to current marker
    google.maps.event.addListener(mark, 'click', function() {
        clearInfos();
        infowindow.open(map,mark);
    });
    infos.push(infowindow);
}
    function initializeMap() {

    
    // prepare Geocoder
    geocoder = new google.maps.Geocoder();

    var lat = $("#Pro_map_lat").val();
    var lang= $("#Pro_map_lang").val();
    var myLatlng = new google.maps.LatLng(lat,lang);

    var myOptions = { // default map options
        zoom: 15,
        center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
    };


    // Add the circle for this city to the map.
        
      

    <?php if(count($selectedneigh) > 0 ){  $sn =$selectedneigh[0]; 
        $show_neigh = Modules\Properties\Entities\Neighbourhood::find($sn['neighbourhood_id']);
        if($show_neigh->parent_id !== null)
        {
            $show_neigh = Modules\Properties\Entities\Neighbourhood::find($show_neigh->parent_id);
        }
    ?>

    map = new google.maps.Map(document.getElementById('gmap_canvas_{{$show_neigh->name}}'), myOptions);

    marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
         zoom: 15,
        icon: base_url+'/public/Mapicon.png',
      });

    var type = '{{$show_neigh->name}}';
    var radius = "{{$sn['kilometer']}}";
    // prepare request to Places
    var request = {
        location: myLatlng,
        radius: radius,
        types: [type]
    };



    // send request
    service = new google.maps.places.PlacesService(map);
    service.search(request, createMarkers);

      var cityCircle = new google.maps.Circle({
            strokeColor: '#aadaff',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#aadaff',
            fillOpacity: 0.35,
            map: map,
            center: myLatlng,
            radius: {{$sn['kilometer']}}
          });


    <?php } ?>

    
}


function showNeighbourhoodMap(name,kilometer)
{
    geocoder = new google.maps.Geocoder();

    var lat = $("#Pro_map_lat").val();
    var lang= $("#Pro_map_lang").val();
    var myLatlng = new google.maps.LatLng(lat,lang);

    var myOptions = { // default map options
        zoom: 15,
        center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById('gmap_canvas_'+name), myOptions);


    marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: base_url+'/public/Mapicon.png',
      });


    var type = name;
    var radius = kilometer;
    // prepare request to Places
    var request = {
        location: myLatlng,
        radius: radius,
        types: [type]
    };


    // send request
    service = new google.maps.places.PlacesService(map);
    service.search(request, createMarkers);


      var cityCircle = new google.maps.Circle({
            strokeColor: '#aadaff',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#aadaff',
            fillOpacity: 0.35,
            map: map,
            center: myLatlng,
            radius: radius
          });



}

</script>
