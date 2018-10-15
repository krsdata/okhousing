@extends('website::web.common-master')
@section('title', "Ok4homes | Dashboard")
@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];

 $fcountry=Session::get('fcountry');
    $country_flag = $fcountry['flag'];

$fcountry=Session::get('fcountry');


$countryId=$fcountry['created_country_id'];

$fcountry=Session::get('fcountry');
$flag = $fcountry['flag'];
$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];


function money_format_dash($money)
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
@section('content')


<style type="text/css">

    ul.profile-user-type {
        display: inline-flex;
       
    }
    ul.profile-user-type > li {
        padding-right: 10px;
    }

              .icon.active > i {
        color:#feb63d !important;
    }


    a.status:hover {
        text-decoration: none !important;
    }
</style>
<style type="text/css">
    .options label,
    .options input{
      width:100%;
      padding:0.5em 1em;
    }
    .hide {
      display: none;
    }
    .img-w {
      max-width: 100%;
    }
    .boxBtn .btn{
        position: absolute;
        right: 10px;
        top: 5px;
        background: #0c629e;
        border: 0px solid #fff;
        color: #fff;
        padding: 0 5px;
        height: 24px;
        line-height: 24px;
        font-size: 10px;
    }
    .boxBtn .btn.save{
        right: 75px;
    }
    
    .result .cropper-container.cropper-bg .cropper-crop-box{
        max-width: 100% !important;
        max-height: 154px !important; 
      /*  height: 100% !important;*/
    }

    .profile .cover .img-box .currentCover{
        max-width: 100% !important;
        max-height: 154px !important; 
       /* height: 100% !important;*/
    }

    section.dashbord .right-box .profile-tab-box .property_container .property_wrapper .image_wrapper .right-btn .icon:first-child i.fa-heart{
            padding-top: 5px;
    }
    section.dashbord .right-box .profile-tab-box .property_container .property_wrapper .image_wrapper .right-btn .icon.chooseIcon{
            background: #FFC107;            
    }
    section.dashbord .right-box .profile-tab-box .property_container .property_wrapper .image_wrapper .right-btn .icon.chooseIcon i.fa-heart{
            color: #fff;
    }

    section.dashbord .left-box.editProfilebox .input-field
        {
            margin-top: 0px;
        }
    section.dashbord .left-box.editProfilebox .val-error
        {
            margin-top:5px !important;
        }
    section.dashbord .right-box .profile-tab-box .property_container .property_wrapper .image_wrapper .right-btn .icon:first-child i.fa-heart
    {
        padding-top:10px !important;
    }

    .cover .actions   {
        position: absolute;
        right: 0;
    }

    .cover .actions .file-btn{
        background: transparent !important;
        color: #fff !important;
        box-shadow: none;
        font-size: 8px;
        text-transform: capitalize;
    }

    .cover .actions .file-btn .far.fa-edit{
        font-size: 10px;
    }

    .modal #upload-demo  .cr-slider-wrap .thumb.active{
        display: none !important;
    }

    /*.btnResult{
        text-decoration: none;
        color: #fff;
        background-color: #26a69a;
        text-align: center;
        letter-spacing: .5px;
        transition: .2s ease-out;
        cursor: pointer;
    }

    

    .img-box .demo-wrap.upload-demo .grid .actions .btnResult.upload-result   {
        text-decoration: none;
        color: #fff;
        background-color: #26a69a;
        text-align: center;
        letter-spacing: .5px;
        transition: .2s ease-out;
        cursor: pointer;
        padding: 2px 5px;
        font-size: 10px;
        top: 5px;
        line-height: 15px;
    }*/


    /*------issue of save btn responsive----*/
    @media (max-width: 991px){
        .dashbord .editProfilebox .profile .cover .boxBtn .btn{
            top: 65px;
        }
    }

    /*
    .left-box.editProfilebox .profile .cover .img-box .result .cropper-container.cropper-bg .cropper-crop-box{
        height: 210px !important; 
    }*/
    /*
    .result .cropper-container.cropper-bg .cropper-crop-box{
        width: 100% !important;
        height: 154px !important; 
    }*/

</style>

<!-- <script src="{{asset('public/web/js/cropper.js')}}"></script> -->

<link rel="Stylesheet" type="text/css" href="{{asset('public/crop/bower_components/sweetalert/dist/sweetalert.css')}}" />
<link rel="Stylesheet" type="text/css" href="{{asset('public/crop/croppie.css')}} "/>
<link rel="Stylesheet" type="text/css" href="{{asset('public/crop/demo/demo.css')}}"/>


<script src="{{asset('public/crop/bower_components/jquery/dist/jquery.min.js')}} "></script>
<script src="{{asset('public/crop/demo/prism.js')}} "></script>
<script src="{{asset('public/crop/bower_components/sweetalert/dist/sweetalert.min.js')}} "></script>
<script src="{{asset('public/crop/croppie.js')}}"></script>
<script src="{{asset('public/crop/demo/demo.js')}}"></script>
<script src="{{asset('public/crop/bower_components/exif-js/exif.js')}}"></script>




    <section class="dashbord">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-xs-12 xspx0">
                        <div class="left-box editProfilebox">
                            <div class="" id="success"><p class="success-msg"></p></div>
                            <span class="has-success"></span>
                            <div class="profile">
                               
                                <div class="cover">
                                     <div class="preLoad Noloader preLoad1"></div>
                                    <div class="img-box">
                                    
                                    <img src="{{asset('public/images/user_cover_pics')}}/{{$user->cover_image}}" onerror=this.src="{{asset('public/images/cover.jpg')}}" alt="" class="currentCover">

                                       <!-- leftbox -->
                                       
                                       <!-- **** Old cropping files ***  -->
                                        <!--<div class="">
                                            <div class="result"></div>
                                            <div class="img-result hide">
                                              <img class="cropped" src="" alt="">
                                            </div>
                                        </div> -->

                                        <!-- input file -->
                                        <!-- <div class="boxBtn box">
                                            <div class="options hide">
                                              <input type="hidden" class="img-w" value="300" min="100" max="1200" />
                                              <input type="hidden" class="img-h" value="154" />
                                            </div>

                                            <a class="btn save hide">{{trans('countries::home/home.Save')}}</a>
                                            <a class="btn cancel hide">{{trans('countries::home/home.Cancel')}}</a>
                                        </div> -->
                                        <!-- **** Old cropping files ends ***  -->

                                    </div>

                                    <div class="actions">
                                        <a class="btn file-btn" >
                                            <i class="far fa-edit"></i> {{trans('countries::home/home.edit_cover')}} 
                                            <input type="file" id="upload" value="Choose a file" accept="image/*" title="" />
                                        </a>
                                    </div>

                                    <!-- <form method="post" enctype="multipart/form-data" id="UploadCoverImageForm" name="UploadCoverImageForm">
                                        <button class="editCoverImgbtn" data-toggle="modal" data-target="#cropModal"  >
                                            <i class="far fa-edit"></i> {{trans('countries::home/home.edit_cover')}}
                                            <input  name="CoverImage" id="UploadCoverImage" class="changeCoverImg"></span>
                                        </button>
                                        <input type="hidden" name="UploadCoverImageSource"  id="UploadCoverImageSource" >
                                    </form> -->








                                    <div class="dp-box profileImg">
                                        <div class="preLoad Noloader preLoad2"></div>
                                        <form method="post" enctype="multipart/form-data" id="changeProfileimgForm" name="changeProfileimgForm">
                                        <img src="{{asset('public/images/user_pics')}}/{{$user->image}}" alt="" onerror="this.src='{{asset('public/no-image.png')}}';">
                                        <span class="editBox">{{trans('countries::home/home.upload_img')}}
                                            <input type="file" name="ProfileImage" class="changeProfileimg" id="UploadProfileImage"></span>
                                        </form>
                                    </div>

                                    
                                </div>
                                
                                <?php 
                                    if(Auth::guard('front_user')->user()) {$id=Auth::guard('front_user')->user()->id;}else{$id='';}
                                    

                                     $user=Modules\Users\Entities\Users::with('created_properties')->where('id',Auth::guard('front_user')->user()->id)->first();


                                    $AboutUs = $UserName ='User';
                                    $UserDetailsId ='';
                                    $userCountry = Modules\Users\Entities\UserCountry::where('user_id',Auth::guard('front_user')->user()->id)->first();

                                     $user_countries_id = $userCountry->id;

                                    $resultData = Modules\Users\Entities\UserDetails::where('user_countries_id',$user_countries_id)->where('language_id',$Selected_lang)->first();


                                     if($resultData){
                                            $UserName = @$resultData->name;
                                            $AboutUs = @$resultData->about_us;
                                            $UserDetailsId = @$resultData->id;
                                        }
                                    
                                   
                                    $Categories =  Modules\Users\Entities\UserModules::with("user_types")->where('user_id',$id)->get();
                                    $UserData =  Modules\Users\Entities\Users::where('id',$id)->first();


                                    $user_country_id = $UserData->country_id;
                                    $CategoriesTypeList = Modules\Module\Entities\Modules::where('module_type',$UserData->cat_type)->where('status',1)->get();

                                   
                                       $listCat=array();
                                      foreach($Categories as $category)
                                      {
                                        $listCat[]= $category->user_types->module_name;
                                      }
                                ?>

                                <div class="profile-details ">
                                    <div class="preLoad Noloader preLoad3"></div>
                                    <br>
                                    <form method="post" id="UpdateProfile1" name="UpdateProfile1" >
                                    <buttion class="profile-edit editHiddenbtn"><i class="far fa-edit"></i> {{trans('countries::home/home.edit_prof')}}</buttion>
                                    <buttion class="profile-edit btn btnUpdate hidden" id="UpdateProfileBTN1"> {{trans('countries::home/home.Update')}} </buttion>
                                     <input  type="hidden"  name="user_countries_id" id="user_countries_id" value="{{$countryId}}">

                                     <input  type="hidden"  name="UserDetailsId" id="UserDetailsId" value="{{$UserDetailsId}}">

                                    <input  type="hidden"  name="cat_type" id="cat_type" value="@if($UserData->cat_type == 0)main @else other @endif">

                                    <div class="row">
                                        <div class="col-sm-6">  
                                            <h2 class="editHidden">{{$UserName}}</h2>
                                            <div class="input-field hidden mt30 nameBox">
                                                <input id="name" name="name" type="text" class="validate" value="{{$UserName}}">
                                                <div class="val-error"></div>
                                                <label for="username" class="">{{trans('countries::home/home.name')}}</label>
                                            </div>
                                            <span class="user-designation editHidden"><?php echo implode(",",$listCat); ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="user-id editHidden ">U.ID - {{$user->unique_code}}</span>
                                            
                                        </div>
                                    </div>

                                    
                                    
                                    <ul class="profile-contact ">
                                        <li><span class="editHidden">{{trans('countries::home/home.email')}}</span>
                                            <span class="editHidden">:</span>
                                            <span class="editHidden">{{$user->email}}</span>
                                           
                                            <div class="input-field hidden mt30">
                                                <input id="email" name="email" type="text" class="validate" value="{{$user->email}}" readonly="true">
                                                <div class="val-error"></div>
                                                <label for="username" class="">{{trans('countries::home/home.email')}}</label>
                                            </div>

                                        </li>
                                        <li><span class="editHidden">{{trans('countries::home/home.phone_no')}}</span>
                                            <span class="editHidden">:</span>
                                            <span class="editHidden">{{$user->mobile}}</span>
                                             <div class="input-field hidden mt30 UpdatephoneBox number">

                                                 <div class="intl-tel-input"><div class="flag-container"><div class="selected-flag" title="India (भारत): +91"><div class="iti-flag in"></div></div></div><input type="tel" name="phone" id="Updatephone" class="validate" placeholder="Mobile" value="{{$user->mobile}}" autocomplete="off">
                                                 
                                                </div>
                                                
                                                 <input type="hidden" name="hidcode" id="hidcode1" value="{{$flag}}">


                                                <!--input id="Updatephone" name="phone" type="text" class="validate" value="{{$user->mobile}}"-->
                                                
                                                <label for="username" class="active">{{trans('countries::home/home.phone_no')}}</label>
                                                <div class="val-error"></div>
                                            </div>
                                        </li>
                                    </ul>
                                     <ul class="profile-user-type " id="CatBox">
                                        @foreach($CategoriesTypeList as $cat)
                                      

                                        <li>
                                            <div class="checkbox-field hidden mt30" >
                                                <input type="checkbox" disabled class="filled-in chk-main-cat" name="mainCat[]" id="filled-in-box{{$cat->module_name}}" value="{{$cat->id}}" @if(in_array($cat->module_name,$listCat)) checked="true" @endif />
                                                <label for="filled-in-box{{$cat->module_name}}">{{$cat->module_name}}</label>

                                                
                                            </div>
                                        </li>  

                                       @endforeach
                                    </ul>
                                    <div class="CatBoxval-error val-error "></div>

                                    <div class="abotmeTextWrap editHidden">
                                    <h3>{{trans('countries::home/home.Aboutme')}}</h3>
                                    <p>{{$AboutUs}}</p>
                                    <a href="{{ URL('property/Add')}}" class="btn-box btn" >{{trans('countries::home/home.add_prop_button')}}</a>
                                    </div>

                                    <div class="input-field hidden mt30">
                                        <textarea id="about" name="about_me" type="text" class="validate" value="{{$AboutUs}}">{{$AboutUs}}</textarea>
                                        <div class="val-error"></div>
                                        <label for="about" class="">{{trans('countries::home/home.Aboutme')}}</label>

                                    </div>   
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="right-box">

                             @if(Session::has('val')) 
                                    @if(Session::get('val')==1)
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 14px;">×</button>
                                            <h4><i class="icon fa fa-check"></i> {{trans('countries::home/home.Success_msg')}}!</h4>
                                            {{Session::get('msg')}}
                                        </div>
                                    @endif
                                @endif
                                
                            <div class="profile-tab-box featured_properties">
                                <ul class="tab-head" role="tablist">
                                    <li class="active" role="presentation" id="Properties" ><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab"> {{trans('countries::home/home.properties')}} </a></li>
                                    <li role="presentation" id="Favorites"><a href="#favorites" aria-controls="favorites" role="tab" data-toggle="tab">{{trans('countries::home/home.favorites')}} </a></li>
                                    @if($Enquiry > 0) <li  role="presentation" id="Enquiry"><a href="#advertisement" aria-controls="advertisement" role="tab" data-toggle="tab">{{trans('countries::home/home.Enquiry')}}</a></li> @endif
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="properties">

                                     <?php $PropertyListCount = Modules\Properties\Entities\PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('user_id',Auth::guard('front_user')->user()->id)->orderBy('id', 'DESC')->count();
                                    ?>

                                    <input type="hidden" name="Self_Pagination_total" id="Self_Pagination_total" value="{{$PropertyListCount}}">
                                    
                                    <input type="hidden" name="Self_Pagination_page" id="Self_Pagination_page" value="1">


                                   

                                    <?php $PropertyList = Modules\Properties\Entities\PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('user_id',Auth::guard('front_user')->user()->id)->orderBy('id', 'DESC')->take(6)->get();


                                    ?>

                                     @foreach($PropertyList as $Property)

                                     @php 

                                        if(!empty($Property))
                                        {

                                            
                                            $pro = Modules\Website\Entities\PropertyViewCount::where('property_id',$Property->id)->first();
                                            $count = @$pro->count;
                                             $count = (!empty($count))?$count:0;

                                        $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();



                                         $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$Property->id)->first();

                                         
                                        if(is_null($property_details))
                                        {
                                             $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id','1')->where('country_id','1')->where('property_id',$Property->id)->first();
                                         }

                                        
                                      

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

                                         
                                        $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                        @endphp
                                        <div class="col-lg-4 col-md-6 col-xs-12 property_container "  >
                                            <div class="property_wrapper">
                                                <div class="image_wrapper" >
                                                    <div class="badge rent">{{$count}} {{trans('countries::home/home.Views')}}</div>

                                                    <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="" class="img-responsive"  onerror="this.src='{{asset('public/default-property.jpg')}}';"  onclick="ShowPropertyPopup({{$Property->id}})">
                                                    <div class="property_deatil"  onclick="ShowPropertyPopup({{$Property->id}})" >
                                                        <h4>{{ $property_details['title']}}</h4>
                                                        <span class="loaction">{{$Property->location}}</span>
                                                    </div>
                                                    <div class="right-btn">
                                                       <a href="{{ URL('property/Edit/'.$Property->id)}}" class="icon"><i class="far fa-edit"></i></a>
                                                       <button class="icon" onclick="DeleteProperty('{{$Property->id}}')"><i class="far fa-trash-alt"></i></button>
                                                    </div>

                                                </div>
                                                <div class="content_wrapper "  onclick="ShowPropertyPopup({{$Property->id}} )" > 
                                                    <h5 class="" ><span><?php if($country_flag == 'in'){ ?>
                                                        <span class="WebRupee">Rs.</span>
                                                    <?php } else { ?>
                                                         <span>{{@$currency_symbol}}</span>
                                                    <?php } ?></span> {{  money_format_dash($Property->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small> 

                                                    <a href="#" class="status tooltip {{ ($Property->status == 'Active')?'Active':'Pending'}}" title="">&bull;  <span class="tooltiptext">{{ ($Property->status == 'Active')?'Active':'Pending'}}</span></a>

                                                 </h5>

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

                                                           
                                                            $area = @$Property->building_area;
                                                            $unit = @$building_area->unit;

                                                            @endphp
                                                            @elseif($Property->landarea_show == 1)
                                                            @php
                                                            
                                                            $building_area = Modules\Properties\Entities\LandUnits::where('language_id',$Selected_lang)->where(function ($query) use ($Property) {
                                                                $query->where('id',$Property->land_unit_id)->orWhere('parent_id',$Property->land_unit_id);
                                                                })->first();

                                                            $area = @$Property->land_area;
                                                            $unit = @$building_area->land_unit;
                                                            @endphp

                                                            @endif

                                                            <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{@$area}} {{ @$unit}}</li>
                                                        </ul>
                                                    </div>

                                                   
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    @endforeach
                                        
                                     <div id="PropertyScroll"></div>
                                      <div class="col-lg-12 col-sm-12 col-xs-12" style="height: 200px;"><div class="preLoad Noloader preLoad_pro"></div></div>

                                    </div>

                                    <div role="tabpanel" class="tab-pane " id="favorites">

                                         <?php $WishlistCount = Modules\Website\Entities\Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->count();
                                    ?>

                                    <input type="hidden" name="favorites_Pagination_total" id="favorites_Pagination_total" value="{{$WishlistCount}}">
                                    
                                    <input type="hidden" name="favorites_Pagination_page" id="favorites_Pagination_page" value="1">


                                    <?php $FvrtPropertyList = Modules\Website\Entities\Wishlist::where('user_id', Auth::guard('front_user')->user()->id)->paginate(6);
                                      
                                     ?>
                                     @foreach($FvrtPropertyList as $pro)

                                     @php 

                                        $pro1 = Modules\Website\Entities\PropertyViewCount::where('property_id',$pro->property_id)->first();
                                            $count = $pro1->count;
                                             $count = (!empty($count))?$count:0;

                                         $Property = Modules\Properties\Entities\PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('id',$pro->property_id)->first();


                                        $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

                                         $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$pro->property_id)->first();

                                        if(empty($property_details))
                                        {
                                             $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id','1')->where('country_id','1')->where('property_id',$pro->id)->first();
                                         }

                                        
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

                                    
                                       
                                        $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                        @endphp
                                       

                                         <div class="col-lg-4 col-md-6 col-xs-12 property_container "id="Propert_fvt_{{$Property->id}}">
                                            <div class="property_wrapper">
                                                <div class="image_wrapper">
                                                    <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> {{trans('countries::home/home.Views')}}</div>

                                                   <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="" class="img-responsive"    onclick="ShowPropertyPopup({{$Property->id}} )"   onerror="this.src='{{asset('public/default-property.jpg')}}';" >
                                                    <div class="property_deatil"  onclick="ShowPropertyPopup({{$Property->id}} )"  >
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
                                                <div class="content_wrapper"  onclick="ShowPropertyPopup({{$Property->id}} )"  >
                                                   <h5><span><?php if($country_flag == 'in'){ ?>
                                                        <span class="WebRupee">Rs.</span>
                                                    <?php } else { ?>
                                                         <span>{{@$currency_symbol}}</span>
                                                    <?php } ?></span> {{  money_format_dash($Property->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

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
                                       <div class="col-lg-12 col-sm-12 col-xs-12" style="height: 200px;"><div class="preLoad Noloader preLoad_pro_fvt"></div></div>
     
                                    </div>                                
                                      @if($Enquiry > 0)
                                    <div role="tabpanel" class="tab-pane " id="advertisement">
                                        <div class="advertisementwrapper">
                                            <table id="advertisementTable" class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('countries::home/home.pro_id')}}</th>
                                                        <th>{{trans('countries::home/home.name')}}</th>
                                                        <th>{{trans('countries::home/home.email')}}</th>
                                                        <th>{{trans('countries::home/home.phone')}}</th>
                                                        <th>{{trans('countries::home/home.subject')}}</th>
                                                        <th>{{trans('countries::home/home.ad_msg')}}</th>
                                                        <th>{{trans('countries::home/home.postedat')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    </section>


    <div class="modal fade modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md list-detail" role="document">
            <div class="modal-content">
                <div class="close-popup" data-dismiss="modal"><img src="{{ asset('public/images/close.svg')}}" alt=""></div>
                <div class="messageBox">
                    <p class="">{{trans('countries::home/home.msg_txt')}}</p>
                    <input type="hidden" id="DeletePropertyURL" value="">
                    <a href="#" class="btn btnYes" data-dismiss="modal" onclick="DeletePropertyConfirm()">{{trans('countries::home/home.Yes')}}</a>
                    <a href="#" class="btn BtnNo" data-dismiss="modal">{{trans('countries::home/home.No')}}</a>    
                </div>
            </div>
        </div>
    </div>


 

    <div class="modal fade signin-box" tabindex="-1" role="dialog" aria-labelledby="signin-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                  
                    <div class="signin-box">
                        <div class="close-popup" onclick="ContinueinSame()" ><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                         <h4><i class="icon fa fa-check"></i> {{trans('countries::home/home.sorry')}}!</h4>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                     <p>{{trans('countries::home/home.lang_msg')}}</p>
                                </div>
                                <a href="#" class="btn btnYes"  onclick="ContinueinSame()">{{trans('countries::home/home.continue_button_lang_msg')}}</a>
                                <a href="{{URL::to('/logout')}}" class="btn BtnNo"> {{trans('countries::home/home.logout_lang_msg')}} </a>
                            </div>
                          
                        </div>
                    </div>
               
                </div>
            </div>
    </div>

    <div id="OpenSuccess" data-toggle="modal" data-target=".signin-box" style="display:none;"></div>

    <button class="icon" id="DeletePropertyBTN" data-toggle="modal" data-target=".modalDelete"></button>

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });


        $(function() {

           var user_country_id ='{{$user_country_id}}';
           var Selected_countryId = '{{$Selected_countryId}}';
           if(user_country_id !== Selected_countryId )
            { 
                $("#OpenSuccess").trigger("click");
            }


        });
        
        function ContinueinSame()
        {
            var user_country_id ='{{$user_country_id}}';

            $('.dropdown-menu li').each(function(i)
            {
               var cid = $(this).attr('data-cid'); 
               if(cid == user_country_id)
               {
                    $(this).click();
               }
            });

        }
        function DeleteProperty(id)
        {
            $("#DeletePropertyURL").val(id);
            $("#DeletePropertyBTN").trigger('click');
            return false;
           
        }

        function DeletePropertyConfirm()
        {
            var id = $("#DeletePropertyURL").val();
           window.location.href = base_url+'/property/Delete/'+id;
           
        }

    $(function() {

       /* $(".featured_properties .tab-content .property_wrapper .image_wrapper").click(function (){

            alert("hi");
        });*/

    $("#UploadProfileImage").change(function (){
       var fileName = $(this).val();

        var bytes = $("#UploadProfileImage")[0].files[0].size;
        var img_size =  (bytes / 1048576).toFixed(3);
        if(img_size > 2)
        {
            alert("File is too large, maximum file size is 2MB")
        }
        else
        {
           if(fileName !=='')
           {

                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        alert("Only formats are allowed : "+fileExtension.join(', '));
                }
                else
                {
                   


                    var formdata=  new FormData($('#UploadProfileImageForm')[0]);
                    formdata.append('ProfileImage', $('#UploadProfileImage')[0].files[0]);
                    $(".preLoad2").removeClass( "Noloader" );
                    $(".preLoad2").addClass( "addloader" );
                    
                    $.ajax({
                        type: "POST",
                        url:base_url+"/users/UploadProfileImage",
                        dataType: "json",
                        async: false, 
                        data: formdata,
                        processData: false,
                        contentType: false, 
                        success: function(response)
                        {
                      
                          if(response.status==1)
                            { 
                               $(".success-msg").html(response.message);
                               $("#success").addClass('success');
                                setTimeout(function(){location.reload(); }, 3000);
                            } else
                            {
                               $(".success-msg").html(response.message);
                               $("#success").addClass('error');
                               setTimeout(function(){$("#success").removeClass('error'); $(".success-msg").html(''); }, 3000);
                            }
                            // $(".preLoad").addClass( "Noloader" );
                       
                        }
                    }); 
                }
           }
       }
     });

/*
    $("#UploadCoverImage").change(function (e){
      e.preventDefault();
      
       var fileName = $(this).val();
       if(fileName !=='')
       {

            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only formats are allowed : "+fileExtension.join(', '));
            }
            else
            {
                var formdata=  new FormData($('#UploadCoverImageForm')[0]);
                formdata.append('CoverImage', $('#UploadCoverImage')[0].files[0]);
              
                $(".preLoad").removeClass( "Noloader" );
                $(".preLoad").addClass( "addloader" );

                
                $.ajax({
                    type: "POST",
                    url:base_url+"/users/UploadCoverImage",
                    dataType: "json",
                    async: false, 
                    data: formdata,
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {
                  
                      if(response.status==1)
                        { 
                           $(".success-msg").html(response.message);
                           $("#success").addClass('success');
                            setTimeout(function(){location.reload(); }, 3000);
                        } else
                        {
                           $(".success-msg").html(response.message);
                           $("#success").addClass('error');
                           setTimeout(function(){$("#success").removeClass('error'); $(".success-msg").html(''); }, 3000);
                        }
                   
                    }
                }); 
            }
       }
     });*/
  });

    $("#UpdateProfileBTN1").unbind('click').click(function ()
    { 
        var name            =   $("[name='name']").val().trim();
        var a=b=c=0;
         var CodeMobile = $("#Updatephone").intlTelInput("getNumber");

        var formdata=  new FormData($('#UpdateProfile1')[0]);
       
       //        mobile number
        if(CodeMobile.length > 0){ 
            var valid = $("#Updatephone").intlTelInput("isValidNumber");

           
            if(valid == true){
                 b=1; 
                $(".UpdatephoneBox .val-error").html(' '); 
            }else{
               b=0;
                $(".UpdatephoneBox .val-error").html('Invalid Number.'); 
            }
            
        }
        else{ 
            b=0;
            $(".UpdatephoneBox .val-error").html('This field is required '); 
        }
      

       if( $("[name='mainCat[]']:checked").length > 0 )  
       {
            c=1;
            $(".CatBoxval-error").html('');
           formdata.append('cat_type', 'main');
           $("[name='mainCat[]']:checked").each(function( index, value){
                formdata.append('val[]',$(this).val() );
           });
       }
       else  {   c=0;   $(".CatBoxval-error").html('This field is required ');  }

      
//        name
        if(name.length > 0){  a=1;$(".nameBox .val-error").html(' '); }
        else  {   a=0;   $(".nameBox .val-error").html('This field is required ');  }
        

/*
        if(phone.length > 0){  b=1;$(".UpdatephoneBox .val-error").html(' '); }
        else  {   b=0;  alert(phone.length); $(".UpdatephoneBox .val-error").html('This field is required ');  }
        
*/
      
       
       
       if(a===1 && b==1 && c==1)
       {

            $(".UpdateProfileBTN1").html("Processing");
            $(".UpdateProfileBTN1").attr("disabled","true");
         
           formdata.append('name', name);
           
          $.ajax({

                type: "POST",
                url:base_url+"/users/UpdateProfile",
                dataType: "json",
                async: false, 
                data: formdata,
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                  if(response.status==1)
                    { 
                       $(".has-success").html(response.message);
                        location.reload();
                    } else if(response.errstep==2)
                    {
                          $(".UpdatephoneBox .val-error").html(response.errArr); 
                        $(".UpdateProfileBTN1").html("Update");
                        $(".UpdateProfileBTN1").removeAttr("disabled","disabled");
                    }
                    else
                     {
                       
                        $(".UpdateProfileBTN1").html("Update");
                        $(".UpdateProfileBTN1").removeAttr("disabled","disabled");
                    }
                   
                },
                error: function (request, textStatus, errorThrown) 
                {
                    $(".UpdateProfileBTN1").html("Update");
                    $(".UpdateProfileBTN1").removeAttr("disabled","disabled");

                }

            });   
       }
       
        return false;
    });

    </script>

   <!--  <div class="modal fade modal1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg list-detail" role="document">
            <div class="modal-content" id="PropertyDetails">
                
            </div>
        </div>
    </div> -->
    <div id="OpenPropertyDetailModal" data-toggle="modal" data-target=".modal1" style="display:none;"></div>

     <!--  Datatable js -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    


    <script type="text/javascript">
        $(document).ready(function() {
          


             $("#Updatephone").intlTelInput({
              initialCountry: "{{$flag}}",
              allowDropdown: false,
              geoIpLookup: function(callback) {
                 var countryCode = document.getElementById("hidcode1").value;
                 callback(countryCode);
                
              },
              utilsScript: base_url+"/public/site/js/plugin/utils.js" // just for formatting/placeholders etc
            });


             $("#Updatephone").change(function()
                {
                  var telInput = $("#Updatephone");
                  if ($.trim(telInput.val())) 
                  {


                    if (telInput.intlTelInput("isValidNumber")) 
                    {
                       $(".UpdatephoneBox .val-error").html(' '); 
                    }
                    else 
                    {
                      $(".UpdatephoneBox .val-error").html('Invalid Number.'); 
                    }
                  }
                });



          /* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#advertisementTable').length){
        $('#advertisementTable').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/users/getenquirylists",
            columns: [ 
                {
                data: "null",
                sortable: false,
                render: function (data, type, full) { 

                var Proid = parseInt(10000) + parseInt(full.property_id);

                var  u = '<a href="#" onclick="ShowPropertyPopup('+full.property_id+')"> PRY-'+Proid+'</a>';              
                return u;
                }

                },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'subject', name: 'subject' },
                { data: 'message', name: 'message' },
                { data: 'updated_at', name: 'updated_at' }
            ]
       
        });
    }

/* ************************************************************************* */  
/* *************************** data table listing end ********************** */  
/* ************************************************************************* */ 
  });

        jQuery(function($) {
            $('.dashbord .tab-content').on('scroll', function() {
                if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                     var ActivaTab = $('.tab-head li.active').attr('id');
                    if(ActivaTab == 'Properties')
                    {

                        var Pagination_total = $("#Self_Pagination_total").val();
                        var Pagination_page = $("#Self_Pagination_page").val();
                        var nextPage = parseInt(Pagination_page) + 1; 
                        var nextFetch = parseInt(Pagination_page) * 6;

                        $("#Self_Pagination_page").val(nextPage);
                        if(Pagination_total > nextFetch)
                        {
                            $(".preLoad_pro").parent().css("height","200px");
                            $(".preLoad_pro").removeClass( "Noloader" );
                            $(".preLoad_pro").addClass( "addloader" );

                             $.ajax({
                                    type: "GET",
                                    url: base_url+"/property/PropertyPagination/"+nextPage, 
                                    dataType: "json",  
                                    cache:false,
                                    contentType: false,                   
                                    processData:false,
                                    success: function(response){
                                       if(response.status==true){ 

                                        $("#PropertyScroll").append(response.html);
                                        $(".preLoad_pro").addClass( "Noloader" );
                                        $(".preLoad_pro").parent().css("height","0px");

                                     }
                                    },
                                    error: function (request, textStatus, errorThrown) {
                                         $(".preLoad_pro").addClass( "Noloader" );
                                        $(".preLoad_pro").parent().css("height","0px");
                                    }             
                            });


                        }

                    }
                    else
                    {

                        var Pagination_total = $("#favorites_Pagination_total").val();
                        var Pagination_page = $("#favorites_Pagination_page").val();
                        var nextPage = parseInt(Pagination_page) + 1; 
                        var nextFetch = parseInt(Pagination_page) * 6;

                        $("#favorites_Pagination_page").val(nextPage);
                        if(Pagination_total > nextFetch)
                        {

                            $(".preLoad_pro_fvt").parent().css("height","200px");
                            $(".preLoad_pro_fvt").removeClass( "Noloader" );
                            $(".preLoad_pro_fvt").addClass( "addloader" );

                            $.ajax({
                                    type: "GET",
                                    url: base_url+"/property/FavoritesPagination/"+nextPage, 
                                    dataType: "json",  
                                    cache:false,
                                    contentType: false,                   
                                    processData:false,
                                    success: function(response){
                                       if(response.status==true){ 

                                        $("#favorites").append(response.html);
                                        $(".preLoad_pro_fvt").addClass( "Noloader" );
                                        $(".preLoad_pro_fvt").parent().css("height","0px");  
                                    }
                                    },
                                    error: function (request, textStatus, errorThrown) {
                                       $(".preLoad_pro_fvt").addClass( "Noloader" );
                                        $(".preLoad_pro_fvt").parent().css("height","0px");  
                                    }             
                            });


                        }

                    }
                }
            })
        });

         $(document).ready(function() {
           
            $(".editProfilebox .profile-edit").click(function(){
                $(this).addClass("hidden");
                $(".editProfilebox .input-field , .editProfilebox .checkbox-field").removeClass("hidden");
                $(".editProfilebox .editHidden").addClass("hidden");
                $(".editProfilebox .profile-contact").addClass("hiddenLine"); 
                $(".editProfilebox .profile-edit.btnUpdate").removeClass("hidden");
            });

            @if($Tab == 'Favorites')

                $("#Favorites > a").trigger("click");

            @endif

            @if($Tab == 'Enquiry')

                $("#Enquiry > a").trigger("click");

            @endif
            
            
});

         function AddTowishlist(id)
{
    var status = $("#AddTowishlist_status").val();
    $.ajax({

            type: "POST",
            url:base_url+"/search/AddTowishlist",
            dataType: "json",
            async: false, 
            data: new FormData($('#AddTowishlist_'+id)[0]),
            processData: false,
            contentType: false, 
            success: function(response)
            {
                if(response.status == true)
                {

                     $("#Propert_fvt_"+id).hide();
                }
             
               
            },
            error: function (request, textStatus, errorThrown) {
                
                

            }

    });

}

function ShowProperty(id)
    {
        $.ajax({
            type: "GET",
            url: base_url+"/search/ShowProperty/"+id, 
            dataType: "json",  
            cache:false,
            contentType: false,                   
            processData:false,
            success: function(response){
               if(response.status==true){ $("#PropertyDetails").html(response.html);
                     $("#OpenPropertyDetailModal").trigger("click");
                     
                 }
              
            },
            error: function (request, textStatus, errorThrown) {
                
            }             
        });
    }

    $("file").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
            alert(this.width + " " + this.height);
        };
        img.src = _URL.createObjectURL(file);
    }
});


     /*  image crop */
        // vars
          let result = document.querySelector('.result'),
          img_result = document.querySelector('.img-result'),
          img_w = document.querySelector('.img-w'),
          img_h = document.querySelector('.img-h'),
          options = document.querySelector('.options'),
          save = document.querySelector('.save'),
          cancel = document.querySelector('.cancel'),
          cropped = document.querySelector('.cropped'),
          currentCover = document.querySelector('.currentCover'),  
          upload = document.querySelector('#UploadCoverImage'),
          cropper = '';

          // on change show image with crop options
          upload.addEventListener('change', (e) => {
            if (e.target.files.length) {

                $(".editCoverImgbtn").hide();
              // start file reader
              const reader = new FileReader();
              reader.onload = (e)=> {
                if(e.target.result){
                  // create new image
                  let img = document.createElement('img');
                  img.id = 'image';
                  img.src = e.target.result
                  // clean result before
                  result.innerHTML = '';
                  // append new image
                  result.appendChild(img);
                  // show save btn and options
                  currentCover.classList.add('hide');
                  save.classList.remove('hide');
                  cancel.classList.remove('hide');
                  options.classList.remove('hide');
                 //  $(".cover").height("440px");

                  
                  

                 
                  // init cropper
                  cropper = new Cropper(img);
                  /*setTimeout(function(){
                    var h= $( "#image" ).height();
                    alert(h)
                 
                  $(".cover").height(h+"px");

                     }, 3000);*/

                }
              };
              reader.readAsDataURL(e.target.files[0]);


            }
          });

          // save on click
          save.addEventListener('click',(e)=>{
            e.preventDefault();

            $(".preLoad1").removeClass( "Noloader" );
            $(".preLoad1").addClass( "addloader" );
            $(".cancel").hide();
            $(".save").html("processing");
            $(".save").attr("disabled","disabled");

            // get result to data uri
            let imgSrc = cropper.getCroppedCanvas({
              //width: img_w.value, // input value
            }).toDataURL();

            // remove hide class of img
            result.classList.add('hide');
            save.classList.add('hide');
            cancel.classList.add('hide');
            cropped.classList.remove('hide');
            img_result.classList.remove('hide');
            // show image cropped
            cropped.src = imgSrc;

            $("#UploadCoverImageSource").val(imgSrc);

            
          
            var formdata=  new FormData($('#UploadCoverImageForm')[0]);
                formdata.append('CoverImage', $('#UploadCoverImage')[0].files[0]);
              
             

                
                $.ajax({
                    type: "POST",
                    url:base_url+"/users/UploadCoverImage",
                    dataType: "json",
                    async: false, 
                    data: formdata,
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {
                        
                      if(response.status==1)
                        { 
                           
                            $(".success-msg").html(response.message);
                            $("#success").addClass('success');
                            // $(".preLoad1").addClass( "Noloader" );
                            setTimeout(function(){location.reload(); }, 3000);
                        } else
                        {
                          // $(".preLoad1").addClass( "Noloader" );
                           $(".success-msg").html(response.message);
                           $("#success").addClass('error');
                           setTimeout(function(){$("#success").removeClass('error'); $(".success-msg").html(''); }, 3000);
                        }
                   
                    }
                }); 
          });

    $(".cancel").click(function(){
        location.reload();
    });

     $(".save").click(function(){
        


    });

    </script>

<!-- Image crop modal -->
<div class="modal fade" id="CropModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
            <div class="demo-wrap upload-demo">
                <div class="row">
                    <div class="col-sm-12 grid">
                        <div class="col-1-2">
                            <div class="actions">
                               <!--  <a class="btn file-btn">
                                    <span>Upload</span>
                                    <input type="file" id="upload" value="Choose a file" accept="image/*" />
                                </a> -->
                            </div>
                        </div>
                        <div class="col-1-2">
                            <div class="upload-msg">
                                Upload a file to start cropping
                            </div>
                            <div class="upload-demo-wrap">
                                <div id="upload-demo"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        <div class="modal-footer">
          <span id="ImgCropingMsg"></span>
          <button type="button " class="btn btn-primary upload-result ">Save</button>
          <button type="button" class="btn btn-default CloseModal" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>

<script>Demo.init(); </script>

<div id="OpenCropModal" data-toggle="modal" data-target="#CropModal" style="display:none;"></div>

    @stop
