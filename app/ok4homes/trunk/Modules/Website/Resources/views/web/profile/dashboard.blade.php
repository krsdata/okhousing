@extends('website::web.common-master')
@section('title', "Ok4homes | Dashboard")
@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];


$fcountry=Session::get('fcountry');


$countryId=$fcountry['created_country_id'];

$fcountry=Session::get('fcountry');
$flag = $fcountry['flag'];


@endphp
@section('content')

 <input type="hidden" name="hidcode" id="hidcode" value="{{$flag}}">

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
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.preLoad.addloader {
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url({{asset('public/loader.gif')}}) center no-repeat #fff;
}
.preLoad.Noloader{
  display: none;
}

a.status:hover {
    text-decoration: none !important;
}
</style>


 <section class="dashbord">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12 xspx0">
                    <div class="left-box editProfilebox">
                        <div class="" id="success"><p class="success-msg"></p></div>
                        <span class="has-success"></span>
                        <div class="profile">
                            <div class="preLoad Noloader"></div>
                            <div class="cover">
                                <div class="img-box">
                                <img src="{{asset('public/images/user_cover_pics')}}/{{$user->cover_image}}" onerror=this.src="{{asset('public/images/cover.jpg')}}" alt=""></div>
                                <form method="post" enctype="multipart/form-data" id="UploadCoverImageForm" name="UploadCoverImageForm">
                               <button class="editCoverImgbtn">
                                    <i class="far fa-edit"></i> Edit Cover page
                                    <input type="file" name="CoverImage" id="UploadCoverImage" class="changeCoverImg"></span>
                                </button>
                                </form>
                                 <div class="dp-box profileImg">
                                    <form method="post" enctype="multipart/form-data" id="changeProfileimgForm" name="changeProfileimgForm">
                                    <img src="{{asset('public/images/user_pics')}}/{{$user->image}}" alt="" onerror="this.src='{{asset('public/no-image.png')}}';">
                                    <span class="editBox">Upload image
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
                                <br>
                                <form method="post" id="UpdateProfile1" name="UpdateProfile1" >
                                <buttion class="profile-edit editHiddenbtn"><i class="far fa-edit"></i> Edit</buttion>
                                <buttion class="profile-edit btn btnUpdate hidden" id="UpdateProfileBTN1"> Update </buttion>
                                 <input  type="hidden"  name="user_countries_id" id="user_countries_id" value="{{$countryId}}">

                                 <input  type="hidden"  name="UserDetailsId" id="UserDetailsId" value="{{$UserDetailsId}}">

                                <input  type="hidden"  name="cat_type" id="cat_type" value="@if($UserData->cat_type == 0)main @else other @endif">

                                <div class="row">
                                    <div class="col-sm-6">  
                                        <h2 class="editHidden">{{$UserName}}</h2>
                                        <div class="input-field hidden mt30 nameBox">
                                            <input id="name" name="name" type="text" class="validate" value="{{$UserName}}">
                                            <div class="val-error"></div>
                                            <label for="username" class="">Name</label>
                                        </div>
                                        <span class="user-designation editHidden"><?php echo implode(",",$listCat); ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="user-id editHidden ">U.ID - {{$user->unique_code}}</span>
                                        
                                    </div>
                                </div>

                                
                                
                                <ul class="profile-contact ">
                                    <li><span class="editHidden">Email</span>
                                        <span class="editHidden">:</span>
                                        <span class="editHidden">{{$user->email}}</span>
                                       
                                        <div class="input-field hidden mt30">
                                            <input id="email" name="email" type="text" class="validate" value="{{$user->email}}" readonly="true">
                                            <div class="val-error"></div>
                                            <label for="username" class="">Email</label>
                                        </div>

                                    </li>
                                    <li><span class="editHidden">Phone</span>
                                        <span class="editHidden">:</span>
                                        <span class="editHidden">{{$user->mobile}}</span>
                                         <div class="input-field hidden mt30 UpdatephoneBox number">

                                             <div class="intl-tel-input"><div class="flag-container"><div class="selected-flag" title="India (भारत): +91"><div class="iti-flag in"></div></div></div><input type="tel" name="phone" id="Updatephone" class="validate" placeholder="Mobile" value="{{$user->mobile}}" autocomplete="off"></div>
                                            <input type="hidden" name="hidcode" id="hidcode" value="{{$flag}}">

                                            <!--input id="Updatephone" name="phone" type="text" class="validate" value="{{$user->mobile}}"-->
                                            <div class="val-error"></div>
                                            <label for="username" class="">Phone</label>
                                        </div>
                                    </li>
                                </ul>
                                 <ul class="profile-user-type " id="CatBox">
                                    @foreach($CategoriesTypeList as $cat)
                                  

                                    <li>
                                        <div class="checkbox-field hidden mt30" >
                                            <input type="checkbox" class="filled-in chk-main-cat" name="mainCat[]" id="filled-in-box{{$cat->module_name}}" value="{{$cat->id}}" @if(in_array($cat->module_name,$listCat)) checked="true" @endif />
                                            <label for="filled-in-box{{$cat->module_name}}">{{$cat->module_name}}</label>

                                            
                                        </div>
                                    </li>  

                                   @endforeach
                                </ul>
                                <div class="CatBoxval-error val-error "></div>

                                <div class="abotmeTextWrap editHidden">
                                <h3>About me</h3>
                                <p>{{$AboutUs}}</p>
                                <a href="{{ URL('property/Add')}}" class="btn-box btn" >Add Property</a>
                                </div>

                                <div class="input-field hidden mt30">
                                    <textarea id="about" name="about_me" type="text" class="validate" value="{{$AboutUs}}">{{$AboutUs}}</textarea>
                                    <div class="val-error"></div>
                                    <label for="about" class="">About me</label>

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
                                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                                        {{Session::get('msg')}}
                                    </div>
                                @endif
                            @endif
                            
                        <div class="profile-tab-box featured_properties">
                            <ul class="tab-head" role="tablist">
                                <li class="active" role="presentation" id="Properties" ><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab">Properties </a></li>
                                <li role="presentation" id="Favorites"><a href="#favorites" aria-controls="favorites" role="tab" data-toggle="tab">Favorites </a></li>
                                @if($Enquiry > 0) <li  role="presentation"><a href="#advertisement" aria-controls="advertisement" role="tab" data-toggle="tab">Enquiry</a></li> @endif
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


                                      $building_area = Modules\Properties\Entities\BuildingUnits::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->building_unit_id)->first();



                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                    @endphp
                                    <div class="col-lg-4 col-md-6 col-xs-12 property_container "  >
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">{{$count}} Views</div>

                                                <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="" class="img-responsive"  onerror="this.src='{{asset('public/default-property.jpg')}}';">
                                                <div class="property_deatil"  onclick="ShowPropertyPopup({{$Property->id}})" >
                                                    <h4>{{ $property_details['title']}}</h4>
                                                    <span class="loaction">{{$Property->location}}</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="{{ URL('property/Edit/'.$Property->id)}}" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon" onclick="DeleteProperty('{{$Property->id}}')"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper"  onclick="ShowPropertyPopup({{$Property->id}})" > 
                                                <h5><span>{{trans('countries::home/home.rupee')}}</span> {{$Property->prize}}/- <small>Per Month</small> 

                                                <a href="#" class="status {{ ($Property->status == 1)?'Active':'Pending'}}" title="{{ ($Property->status == 1)?'Active':'Pending'}}">&bull;</a>

                                             </h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{$Property->bedroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{$Property->bathroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{$Property->building_area}} {{ (count($building_area->types)> 0)?$building_area->types[0]->unit:$building_area->unit}}</li>
                                                    </ul>
                                                </div>

                                               
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                @endforeach
                                    
                                 <div id="PropertyScroll"></div>
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

                                    

                                      $building_area = Modules\Properties\Entities\BuildingUnits::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->building_unit_id)->first();
                                     


                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                    @endphp
                                   

                                     <div class="col-lg-4 col-md-6 col-xs-12 property_container "id="Propert_fvt_{{$Property->id}}">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> Views</div>

                                               <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="" class="img-responsive"    onclick="ShowPropertyPopup({{$Property->id}})"   onerror="this.src='{{asset('public/default-property.jpg')}}';" >
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
                                               <h5><span>{{trans('countries::home/home.rupee')}}</span> {{$Property->prize}}/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{$Property->bedroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{$Property->bathroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{$Property->building_area}} {{ (count($building_area->types)> 0)?$building_area->types[0]->unit:$building_area->unit}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                  
                                </div>                                
                                  @if($Enquiry > 0)
                                <div role="tabpanel" class="tab-pane " id="advertisement">
                                    <div class="advertisementwrapper">
                                        <table id="advertisementTable" class="table table-striped table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
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
                    <p class="">Are you sure you want to delete the selected property</p>
                    <input type="hidden" id="DeletePropertyURL" value="">
                    <a href="#" class="btn btnYes" data-dismiss="modal" onclick="DeletePropertyConfirm()">Yes</a>
                    <a href="#" class="btn BtnNo" data-dismiss="modal">No</a>    
                </div>
            </div>
        </div>
    </div>


 

     <div class="modal fade signin-box" tabindex="-1" role="dialog" aria-labelledby="signin-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                  
                    <div class="signin-box">
                        <div class="close-popup" onclick="ContinueinSame()" ><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                         <h4><i class="icon fa fa-check"></i> Sorry!</h4>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                     <p>You can not access dashboard & add property in other language </p>
                                </div>
                                <a href="#" class="btn btnYes"  onclick="ContinueinSame()">Continue</a>
                                <a href="{{URL::to('/logout')}}" class="btn BtnNo"> {{trans('countries::home/home.logout')}} </a>
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
           
        }

        function DeletePropertyConfirm()
        {
            var id = $("#DeletePropertyURL").val();
           window.location.href = base_url+'/property/Delete/'+id;
           
        }

    $(function() {
    $("#UploadProfileImage").change(function (){
       var fileName = $(this).val();

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
                $(".preLoad").removeClass( "Noloader" );
                $(".preLoad").addClass( "addloader" );
                
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
     });


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
     });
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
                        $(".UpdateProfileBTN1").html("Update");
                        $(".UpdateProfileBTN1").removeAttr("disabled","disabled");
                    }
                    else
                     {
                         $(".UpdatephoneBox .val-error").html(response.errArr); 
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
              initialCountry: "auto",
              allowDropdown: false,
              geoIpLookup: function(callback) {
                 var countryCode = document.getElementById("hidcode").value;
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
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'subject', name: 'subject' },
                { data: 'message', name: 'message' }
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
                                    }
                                    },
                                    error: function (request, textStatus, errorThrown) {
                                        
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
                                    }
                                    },
                                    error: function (request, textStatus, errorThrown) {
                                        
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

   

    </script>
    @stop
