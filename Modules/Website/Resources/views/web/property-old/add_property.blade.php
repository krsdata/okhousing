 @extends('website::web.common-master')
 @section('title', " Ok4homes | Post your property ")
 @section('css')
 
    <link href="{{asset('public/site/css/imageuploadify.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@stop

 @section('content')

 <style>
     .dispayNone{display: none}
     .dispayBox{display: block}
     .btn-next {border: none!important;color: #fff;padding: 15px 45px;border-radius: 10px;}
     .btn-back {margin-right: 10px;border: none;color: #fff;padding: 15px 45px;border-radius: 10px;}
     .validation-error-label{color:red!important;font-size: 1rem;}



 </style>
@php
 if(Auth::guard('front_user')->user()) {$id=Auth::guard('front_user')->user()->id;}else{$id='';}
    $fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];

                            
 $UserData =  Modules\Users\Entities\Users::where('id',$id)->first();
$user_country_id = $UserData->country_id;

@endphp

 <section class="add-property">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="left-box">
                       <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d205469.69984329806!2d76.45357493413802!3d9.952257009672524!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1521473564889" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                       <div style="height:800px;width: 100%; ">
                            <div id="map"  style="height: 100%"></div>
                       </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="right-box">
                        <h2 style="margin-top: 99px;">Add new property</h2>
                        
                        <div class="step-box">
                            <ul>
                                <li class="active"  id="tab_1">
                                    <a href="#">
                                        <p><span>1</span><i id="title_1" > Basic Details</i></p>
                                    </a>
                                </li>
                                <li id="tab_2">
                                    <a href="#" >
                                        <p><span>2</span> 
                                           <i id="title_2" class=""> Property Details</i>
                                        </p>
                                    </a>
                                </li>
                                <li id="tab_3">
                                    <a href="#" >
                                        <p><span>3</span>
                                            <i id="title_3" class="">Amineties</i>
                                        </p>
                                    </a>
                                </li>
                                <li id="tab_4">
                                    <a href="#" >
                                        <p><span>4</span> 
                                            <i id="title_4" class=""> Neighbourhood Map</i>
                                        </p>
                                    </a>
                                </li>
                                <li id="tab_5">
                                    <a href="#" >
                                        <p><span>5</span> 
                                            <i id="title_5" class="">Gallery</i>
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!--step 1-->
                        <form action="#" id="property_list_add" autocomplete="off">
                        <input type="hidden" name="pro_lat" id="pro_lat" value="">
                        <input type="hidden" name="pro_lang" id="pro_lang" value="">
                        <div id="first_step" class="dispayBox">
                            <div class="step-form-box">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        

                                    @foreach($languages as $language)


                                    <input type="hidden" name="title_language[]" value="{{$language['id']}}">
                                    <div id="title_{{$language['id']}}">
                                        <input   name="short_name[]" type="hidden" value='{{$language['languages']['lang_code']}}' class="form-control" >
                                        <div class="input-field">
                                            <input id="title_{{$language['id']}}" name="title_{{$language['id']}}" type="text" class="validate"  required>
                                        <label for="property_title">Title in {{$language['languages']['name']}}</label>
                                        </div>
                                        <span  class="help-block"></span>


                                    </div>
                                    @endforeach

                                        
                                        
                                        <div class="input-box"  id="property_type">
                                            <select class="browser-default" type="select" id="property_type" name="property_type" required>
                                              <option value="">Type</option>
                                               @if($property_types)
                                                    @foreach($property_types as $type)
                                                        <option value="{{($type->parent_id == '')?$type->id:$type->parent_id}}" >{{$type->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                             <span  class="help-block"></span>   
                                        </div>
                                       
                                    </div>
                                    <div class="col-sm-6 col-xs-12" id="property_category">
                                         <div class="input-box">
                                            <select class="browser-default" type="select" id="property_category" name="property_category" required>
                                              <option value="">Category</option>
                                                @if($property_categories)
                                                    @foreach($property_categories as $category)
                                                        <option value="{{($category->parent_id == '')?$category->id:$category->parent_id}}" >{{$category->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span  class="help-block"></span>   
                                        </div>
                                        <div id="property_prize"> 
                                            <div class="input-field" >
                                                <input id="property_prize" name="property_prize" type="text" class="validate" required>
                                                <label for="property_title">Price</label>
                                                
                                            </div>
                                             <span  class="help-block"></span>   
                                        </div>
                                         
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                         <div class="input-box" id="location">
                                           
                                              <input id="pac-input" name="location" type="text" placeholder="Enter a location" class="validate" style="font-size: 12px;" onclick="findAddress();" >
                                     
                                          
                                             <span  class="help-block"></span>   
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-box">
                                <div class="button-right">
                                   <input type="button" name="next" data-next="second_step" data-id="2" class="btn-next" value="Continue"  />
                                    
                                </div>
                            </div>
                        </div>
                        
                        <!--/step 1-->
                        
                        <!--step 2-->
                       
                        <div id="second_step" class="dispayNone">
                             <div class="step-form-box">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                        <div id="building_area">
                                            <div class="input-field">
                                                <input id="building_area" name="building_area" type="text" class="validate" required>
                                                <label for="Building_Area">Building Area</label>
                                            </div>
                                            <span  class="help-block"></span>  
                                        </div>
                                    </div> 

                                    <div class="col-sm-3 col-xs-12">                                        
                                        <div class="input-box" id="building_unit">
                                            <select class="browser-default" id="building_unit" type="select" name="building_unit" required>
                                              <option value="">Building Unit</option>
                                              @if($building_units)
                                                @foreach($building_units as $bunit)
                                                    <option value="{{($bunit->parent_id == '')?$bunit->id:$bunit->parent_id}}" >{{$bunit->unit}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                            <span  class="help-block"></span>  
                                        </div>
                                        
                                    </div>

                                    <div class="col-sm-3 col-xs-12">
                                        <div id="land_area">
                                            <div class="input-field">
                                                <input id="land_area" name="land_area" type="text" class="validate" required>
                                                <label for="land_area">Plot/Land Area</label>
                                             </div>
                                             <span  class="help-block"></span> 
                                        </div>
                                    </div>

                                    <div class="col-sm-3 col-xs-12">
                                        <div class="input-box" id="land_unit">
                                            <select class="browser-default" id="land_unit" name="land_unit" required type="select">
                                              <option value="">Unit</option>
                                              @if($land_units)
                                                @foreach($land_units as $lunit)
                                                    <option value="{{($lunit->parent_id == '')?$lunit->id:$lunit->parent_id}}" >{{$lunit->land_unit}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                            <span  class="help-block"></span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">    
                                    <div class="col-sm-3 col-xs-12">    
                                       <div  id="bedroom">
                                            <div class="input-field">
                                                <input type="number" min="1" id="bedroom1" name="bedroom" required>
                                                <label for="bedroom1">Bedroom</label>
                                            </div>
                                            <span  class="help-block"></span>  
                                        </div>
                                    </div>

                                    <div class="col-sm-3 col-xs-12">    
                                       <div  id="bathroom">
                                            <div class="input-field">
                                                <input type="number" min="1" id="bathroom1" name="bathroom" required>
                                                <label for="bathroom1">Bathroom</label>
                                            </div>
                                            <span  class="help-block"></span> 
                                        </div>

                                    </div>

                                    @foreach($languages as $language)

                                    
                                    <input type="hidden" name="desc_language[]" value="{{$language['id']}}">
                                    <div class="col-sm-12 col-xs-12"  id="desc_{{$language['language_id']}}">
                                        <input   name="short_name[]" type="hidden" value='{{$language['languages']['lang_code']}}' class="form-control" >
                                        <div class="input-field">
                                        
                                        <input id="desc_{{$language['id']}}" name="desc_{{$language['id']}}" type="text" class="validate"  required>

                                        <input type="hidden" name="created_language_{{$language['id']}}" value="{{$language['languages']['id']}}">

                                       
                                        <label for="property_title">Description in {{$language['languages']['name']}}</label>
                                        </div>
                                        <span  class="help-block"></span>


                                    </div>
                                    @endforeach

                                   
                                </div>
                            </div>
                            <div class="button-box">
                                <div class="button-right">
                                    <input type="button"  class="btn-back" data-back="first_step" data-id="2" value="Back" />
                                    <input type="button" name="next" data-next="third_step" data-id="3" class="btn-next" value="Continue" />
                                </div>
                            </div>
                        </div>
                      
                         <!--/step 2-->
                         
                          <!-- step 3-->
                      
                          <div id="third_step" class="dispayNone">
                            <div class="step-form-box">
                                <div class="row" id="amenities">
                                    <span  class="help-block"></span> 
                                <?php 
                                if(sizeof($amenities) >0){
                                $cols = array_chunk($amenities->toArray(), ceil(count($amenities->toArray())/3));  
                                    $amenities=$amenities->toArray();
                                ?>
                                @foreach ($cols as $amenities)
                                <div class="col-sm-4 col-xs-12 amineties" >
                                     
                                <ul class="propertyAminitesUl">
                                 @foreach($amenities as $amenity)
                                <li>
                                    <span><img src="{{ URL::asset('public/images/amenities/'.$amenity['icon']) }}" alt=""></span>
                                    <p >{{$amenity['name']}}</p>
                                    <input type="checkbox"  name="amenities[]" class="checker border-success text-success-600 amenities" style="opacity:1;pointer-events:auto;margin-left: -15px;" value="{{($amenity['parent_id'] == '')?$amenity['id']:$amenity['parent_id']}}" >
                                     <i class="fa fa-check checkmark"></i> 
                                </li>

                                @endforeach
                                  </ul>
                                </div>
                                @endforeach
                               
                                </div>
                               
                                 <?php } ?>
                            </div>
                            <div class="button-box">
                                <div class="button-right">
                                    <input type="button"  class="btn-back" data-back="second_step" data-id="3" value="Back" />
                                  
                                    <input type="button" name="next" data-next="fourth_step" data-id="4" class="btn-next" value="Continue" />
                                </div>
                            </div>
                          </div>
                     
                          <!--/step 3-->
                          
                          <!-- step 4-->
                      
                          <div id="fourth_step" class="dispayNone">
                              
                              
                           <div class="step-form-box NaibourHoodMap">
                                   <div class="row">
                                
                                    <?php 
                                    if(sizeof($neighbourhoods)){
                                    $cols = array_chunk($neighbourhoods->toArray(), ceil(count($neighbourhoods->toArray())/3));  
                                    $neighbourhoods=$neighbourhoods->toArray();
                                    ?>
                                    @foreach ($cols as $neighbourhoods)
                                    <div class="col-sm-4 col-xs-12">
                                     
                                     @foreach($neighbourhoods as $neighbourhood)
                                        <div class="input-field">
                                            <input  class="neighbourhood" name="km[]" type="text" class="validate" >
                                            <input  name="neighbourhood[]" value="{{($neighbourhood['parent_id'] == '')?$neighbourhood['id']:$neighbourhood['parent_id']}}" type="hidden" class="validate"  >
                                            <label for="Hospital">{{$neighbourhood['name']}}(m)</label>
                                        </div>
                                                    
                                    @endforeach
                                      
                                    </div>
                                    @endforeach
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="button-box">
                                <div class="button-right">
                                    <input type="button"  class="btn-back" data-back="third_step" data-id="4" value="Back" />
                                    <input type="button" name="next" data-next="fifth_step" data-id="5" class="btn-next" value="Continue" />
                              
                                </div>
                            </div>
                    
                              
                              
                          </div>
                      
                          <!--/step 4-->
                          
                          <!--step 5-->
                  
                          <div id="fifth_step" class="dispayNone">
                               <div class="step-form-box">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">  
                                    <div class="uploader" id="file-upload-form" >             
                                        <input id="file-upload" type="file" name="images[]"  accept="image/*" multiple ="true" />
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-box mb30">
                            <div class="button-right ">
                                 <input type="button"  class="btn-back" data-back="fourth_step" data-id="5" value="Back" />
                                <input type="submit" data-next="last_step"  class="btn-next" value="Save" />
                                    
                            </div>
                        </div>
                    
                           </div>
                     
                          <!--/step 5-->
                          
                         </form>
                         
                         
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>

 @if(Session::has('val')) 
    @if(Session::get('val')==1)
     <div class="modal fade signin-box" tabindex="-1" role="dialog" aria-labelledby="signin-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                  
                    <div class="signin-box">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <img src="{{asset('public/images/register.png')}}" alt="" id="mypro" class="mypro"/>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                     <p>{{Session::get('msg')}}</p>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                          
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
 @endif
@endif
 @if($user_country_id !== $Selected_countryId)
 

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
@endif
        <div id="OpenSuccess" data-toggle="modal" data-target=".signin-box" style="display:none;"></div>

@php
 if(Auth::guard('front_user')->user()) {$id=Auth::guard('front_user')->user()->id;}else{$id='';}
    $fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];

                            
 $UserData =  Modules\Users\Entities\Users::where('id',$id)->first();
$user_country_id = $UserData->country_id;

@endphp
 <script type="text/javascript">
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
     $('#first_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.btn-next').click();
        }
    });
     
    $('#third_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.btn-next').click();
        }
    });

       $('#fourth_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.btn-next').click();
        }
    });

    $('#second_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.btn-next').click();
        }
    });
 </script>
     
<!--/sign up-->
 @if(Session::has('val')) 
    @if(Session::get('val')==1)
         <div id="OpenSuccess" data-toggle="modal" data-target=".signin-box" style="display:none;"></div>
        <script type="text/javascript">
            
           $("#OpenSuccess").trigger("click");

        </script>    
    @endif
@endif
 @stop

 @section('js')
<!-- controls -->
<script src="{{asset('public/site/js/plugin/imageuploadify.min.js')}}"></script>
<script src="{{asset('public/site/js/property.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap"async defer></script>
<script type="text/javascript">  $('input[type="file"]').imageuploadify();</script>
@stop
