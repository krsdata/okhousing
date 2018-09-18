 @extends('website::web.common-master')
 @section('title', " Ok4homes | Post your property ")
 @section('css')
 
    <link href="{{asset('public/site/css/imageuploadify.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
     <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"  rel="stylesheet">
@stop

 @section('content')
@php
 if(Auth::guard('front_user')->user()) {$id=Auth::guard('front_user')->user()->id;}else{$id='';}
    $fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];

                            
 $UserData =  Modules\Users\Entities\Users::where('id',$id)->first();
$user_country_id = $UserData->country_id;

@endphp
 <style>
     .dispayNone{display: none}
     .dispayBox{display: block}
     .edit-btn-next {border: none!important;color: #fff;padding: 15px 45px;border-radius: 10px;}
     .edit-btn-back {margin-right: 10px;border: none;color: #fff;padding: 15px 45px;border-radius: 10px;}
     .validation-error-label{color:red!important;font-size: 1rem;}



 </style>

 <section class="add-property">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="left-box">
                      
                       <div style="height:800px;width: 100%; ">
                            <div id="map"  style="height: 100%"></div>
                       </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="right-box">
                        <h2 style="margin-top: 99px;">Edit property</h2>
                         
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
                        <form action="#" id="property_list_edit" autocomplete="off" data-id="{{$property_lists->id}}">
                        <input type="hidden" name="pro_lat" id="pro_lat" value="">
                        <input type="hidden" name="pro_lang" id="pro_lang" value="">
                        <div id="first_step" class="dispayBox">
                            <div class="step-form-box">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        

                                   @if($langugeDetails)
                                   @foreach($langugeDetails as $key=> $language)

                                  
                                    <?php $property_details_language = Modules\Countries\Entities\Alllanguages::where('id',$language->pro_languages->language_id)->first(); ?>


                                    <input type="hidden" name="title_language[]" value="{{$language->id}}">
                                    <div id="title_{{$language->id}}">
                                        <input   name="short_name[]" type="hidden" value='{{$property_details_language->lang_code}}' class="form-control" >
                                        <div class="input-field">
                                            <input id="title_{{$language->id}}" name="title_{{$language->id}}" type="text" class="validate"  value="{{$language->title}}" required>
                                        <label for="property_title">Title in {{$property_details_language->name}}</label>
                                        </div>
                                        <span  class="help-block"></span>


                                    </div>
                                    @endforeach
                                    @endif
                                    
                                        
                                        
                                       <!--  <div class="input-box"  id="property_type">
                                            <select class="browser-default" type="select" id="property_type" name="property_type" required>
                                              <option value="">Type</option>


                                               @if($property_types)
                                                   <?php $selectedcat[] = $property_lists->type_id;
                                                 
                                                    ?>
                                                     @foreach($property_types as $type)
                                                        <option value="{{$select_op_type=($type->parent_id == '')?$type->id:$type->parent_id}}"  @if(in_array($select_op_type,$selectedcat)) selected @endif >{{$type->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                             <span  class="help-block"></span>   
                                        </div> -->



   


                                        <div id="property_prize"> 
                                            <div class="input-field" >
                                                <input id="property_prize" name="property_prize" type="number" min="1" class="validate" required value="{{$property_lists->prize}}">
                                                <label for="property_title">Price</label>
                                                
                                            </div>
                                             <span  class="help-block"></span>   
                                        </div>
                                         

                              



                                       
                                    </div>
                                    <div class="col-sm-6 col-xs-12" >

                                      <div class="input-box" id="property_type">
                                         <?php $selectedcat[] = $property_lists->type_id;
                                                  $property_lists->type_id;
                                                  $Propert_type=explode(',', $property_lists->mastercategory_id);
                                                    ?>


                                            <select class="bootstrap-select" type="select" id="property_categorychanged" name="property_type[]" multiple required>
                                             <option value="" disabled="true" >Select Type</option>
                                               
                                            
                                                   @foreach($CategoryType as $row)
                                                        <option value="{{ ($row['parent_id'] =='')?$row['id']:$row['parent_id'] }}" @if(in_array(($row['parent_id'] =='')?$row['id']:$row['parent_id'],$Propert_type)) selected @endif>{{ $row['title'] }}</option>
                                                    @endforeach
                                              
                                            </select>
                                            <span  class="help-block"></span>   
                                    </div>
                                      <?php $selectedtype[] = $property_lists->category_id; 
                                             ?>

                                     <div class="input-box" id="property_category">
                                            <select class="browser-default" type="select" id="property_typechanged" name="property_category" required>
                                              <option value="">Category</option>

                                             
                                                @foreach ($property_categoriesedit as $key => $category)  
                                              
                                                      <option value="{{ $category_op_id = $category->id}}" @if(in_array($category_op_id,$selectedtype)) selected @endif >{{$category->name}}</option>
                                               
                                                 @endforeach
                                            </select>
                                            <span  class="help-block"></span>   
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                         <div class="input-box" id="location">
                                           
                                              <input id="pac-input" name="location" type="text" placeholder="Enter a location" class="validate" style="font-size: 12px;" onclick="findAddress();" value="{{$property_lists->location}}"  class="validate" required>
                                     
                                          
                                             <span  class="help-block"></span>   
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-box mb30">
                                <div class="button-right">
                                   <input type="button" name="next" data-next="second_step" data-id="2" class="edit-btn-next" value="Continue"  />
                                    
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
                                                <input id="building_area" name="building_area" type="number" min="1"  class="validate" required  value="{{$property_lists->building_area}}">
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
                                                <?php $selectedbunit[] = $property_lists->building_unit_id; ?>
                                                @foreach($building_units as $bunit)
                                                    <option value="{{$bui_op_sele=($bunit->parent_id == '')?$bunit->id:$bunit->parent_id}}" @if(in_array($bui_op_sele,$selectedbunit)) selected @endif >{{$bunit->unit}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                            <span  class="help-block"></span>  
                                        </div>
                                        
                                    </div>

                                    <div class="col-sm-3 col-xs-12">
                                        <div id="land_area">
                                            <div class="input-field">
                                                <input id="land_area" name="land_area" type="number" min="1"  class="validate" required  value="{{$property_lists->land_area}}" >
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
                                                <?php $selectedlunit[] = $property_lists->land_unit_id; ?>
                                                @foreach($land_units as $lunit)
                                                    <option value="{{$lang_op_sel=($lunit->parent_id == '')?$lunit->id:$lunit->parent_id}}" @if(in_array($lang_op_sel,$selectedlunit)) selected @endif >{{$lunit->land_unit}}</option>
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
                                                <input type="number" min="0"  id="bedroom1" value="{{$property_lists->bedroom}}" min="1" name="bedroom" required>
                                                <label for="bedroom1">Bedroom</label>
                                            </div>
                                            <span  class="help-block"></span>  
                                        </div>
                                    </div>

                                    <div class="col-sm-3 col-xs-12">    
                                       <div  id="bathroom">
                                            <div class="input-field">
                                                <input type="number" id="bathroom1" value="{{$property_lists->bathroom}}" min="0" name="bathroom" required>
                                                <label for="bathroom1">Bathroom</label>
                                            </div>
                                            <span  class="help-block"></span> 
                                        </div>

                                    </div>

                                     @if($langugeDetails)
                                   @foreach($langugeDetails as $key=> $language)

                                  
                                    <?php $property_details_language = Modules\Countries\Entities\Alllanguages::where('id',$language->pro_languages->language_id)->first(); ?>


                                    <input type="hidden" name="desc_country_{{$language->id}}" value="{{$language->country_id}}">

                                    <input type="hidden" name="desc_language_{{$language->id}}" value="{{$language->language_id}}">

                                    <input type="hidden" name="country_language_{{$language->id}}" value="{{$language->id}}">

                                    <input type="hidden" name="created_language_{{$language['id']}}" value="{{$language->language_created_id}}">
                                    
                                    <input type="hidden" name="created_country_{{$language['id']}}" value="{{$language->country_created_id}}">

                                  
                                    <input type="hidden" name="desc_language[]" value="{{$language->id}}">

                                    <div class="col-sm-12 col-xs-12"  id="desc_{{$language->pro_languages->id}}">
                                        <input   name="short_name[]" type="hidden" value='{{$property_details_language->lang_code}}' class="form-control" >
                                        <div class="input-field">
                                            <input id="desc_{{$language->id}}" name="desc_{{$language->id}}" type="text" class="validate"  required  value="{{$language->description}}" >
                                        <label for="property_title">Description in {{$property_details_language->name}}</label>
                                        </div>
                                        <span  class="help-block"></span>


                                    </div>
                                    @endforeach
                                    @endif

                                   
                                </div>
                            </div>
                            <div class="button-box mb30">
                                <div class="button-right">
                                    <input type="button"  class="edit-btn-back" data-back="first_step" data-id="2" value="Back" />
                                    <input type="button" name="next" data-next="third_step" data-id="3" class="edit-btn-next" value="Continue" />
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
                                if(count($amenities) > 0 ){
                                $cols = array_chunk($amenities->toArray(), ceil(count($amenities->toArray())/3));  
                                    $amenities=$amenities->toArray();
                                ?>

                                 <?php $selectedvalue = $property_lists->property_created_amenities->pluck('amenity_id')->toArray();

                                 ?>
                                    

                                @foreach ($cols as $amenities)
                                <div class="col-sm-4 col-xs-12 amineties" >
                                     
                                <ul class="propertyAminitesUl">
                                 @foreach($amenities as $amenity)
                                <li>
                                    <span><img src="{{ URL::asset('public/images/amenities/'.$amenity['icon']) }}" alt=""></span>
                                    <p >{{$amenity['name']}}</p>


                                    <input type="checkbox" class="checker border-success text-success-600 amenities" name="aminety[]" style="opacity:1;pointer-events:auto;margin-left: -15px;"  value="{{$amenity['id']}}" @if(in_array($amenity['id'],$selectedvalue) || in_array($amenity['parent_id'],$selectedvalue)) checked @endif>
                                    <i class="fa fa-check checkmark"></i>



                                  
                                      
                                </li>

                                @endforeach
                                  </ul>
                                </div>
                                @endforeach
                               
                                </div>
                               
                                 <?php  } ?>
                            </div>
                            <div class="button-box mb30">
                                <div class="button-right">
                                    <input type="button"  class="edit-btn-back" data-back="second_step" data-id="3" value="Back" />
                                  
                                    <input type="button" name="next" data-next="fourth_step" data-id="4" class="edit-btn-next" value="Continue" />
                                </div>
                            </div>
                          </div>
                     
                          <!--/step 3-->
                          
                          <!-- step 4-->
                      
                          <div id="fourth_step" class="dispayNone">
                              
                              
                           <div class="step-form-box NaibourHoodMap">
                                   <div class="row">
                                
                                    <?php //echo "--".count($neighbourhoods)."--"; 
                                    if(count($neighbourhoods) > 0){
                                    $cols = array_chunk($neighbourhoods->toArray(), ceil(count($neighbourhoods->toArray())/3));  
                                    $neighbourhoods=$neighbourhoods->toArray();
                                    ?>
                                    <?php $selectedneigh = $property_lists->property_created_neighbourhoods->toArray(); 

                                    ?>

                                   
                                    @foreach ($cols as $neighbourhoods)
                                    <div class="col-sm-4 col-xs-12">
                                     
                                     @foreach($neighbourhoods as $neighbourhood)
                                        <div class="input-field">
                                            

                                            <input name="in_km[]" id="km_id_{{$neighbourhood['id']}}"  type="number" class="form-control" placeholder="Enter meter" style="width: 123px!important;" @foreach($selectedneigh as $selected)  @if($selected['neighbourhood_id']==$neighbourhood['id'] || $selected['neighbourhood_id']==$neighbourhood['parent_id']) value="{{$selected['kilometer']}}" @endif @endforeach>



                                            <input type="hidden" class="checker border-success text-success-600  CheckboxStyle neighbour" name="neighbourhood[]" value="{{$neighbourhood['id']}}" id="neighbourhood_{{$neighbourhood['id']}}" data-id="{{$key+1}}" value="{{$neighbourhood['id']}}" @foreach($selectedneigh as $selected)  @if($selected['neighbourhood_id']==$neighbourhood['id'] || $selected['neighbourhood_id']==$neighbourhood['parent_id']) checked  @endif @endforeach>


                                            <label for="Hospital">{{$neighbourhood['name']}}(m)</label>
                                        </div>
                                                    
                                    @endforeach
                                      
                                    </div>
                                    @endforeach
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="button-box mb30">
                                <div class="button-right">
                                    <input type="button"  class="edit-btn-back" data-back="third_step" data-id="4" value="Back" />
                                    <input type="button" name="next" data-next="fifth_step" data-id="5" class="edit-btn-next" value="Continue" />
                              
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

                                <div class="form-group col-md-12">
                                                @foreach($galleryimages as $image)
                                                @if($image->image!='')
                                                    <div class="form-group col-md-3 thumb" id="DeleteImage_{{$image->id}}">
                                                  <span class="fa fa-close" onclick="DeleteImage({{$image->id}})"></span>
                                                    <img class="img-responsive gall" src="{{ URL::asset('public/images/properties/'.$image->image) }}" alt="gallery" style="height: 68px;">
                                                  
                                                    </div>
                                                    
                                                   

                                                    @endif
                                                @endforeach
                                            </div>

                            </div>
                        </div>
                        <div class="button-box mb30">
                            <div class="button-right ">
                                 <input type="button"  class="edit-btn-back" data-back="fourth_step" data-id="5" value="Back" />
                                <input type="submit" data-next="last_step"  class="edit-btn-next" value="Save" />
                                    
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
            <div class="modal-dialog modal-sm signin ed_popup " role="document">
                <div class="modal-content">
                  
                    <div class="signin-box">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        
                        <h4><img src="{{asset('public/images/register.png')}}" alt="" id="mypro" class="mypro"/>
                        <i class="icon fa fa-check"></i> Success!</h4>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                     <p style="margin-left: 7px;">{{Session::get('msg')}}</p>
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



     <script type="text/javascript">
$(function() {
     EditinitMap();
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

     $('#first_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.edit-btn-next').click();
        }
    });

    $('#third_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.edit-btn-next').click();
        }
    });

       $('#fourth_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.edit-btn-next').click();
        }
    });

    $('#second_step').keypress(function(event){
        if(event.which==13){
            event.preventDefault();
            $(this).closest('div').find('input.edit-btn-next').click();
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

<script type="text/javascript">  $('input[type="file"]').imageuploadify();</script>
<script type="text/javascript">
    
    function DeleteImage(id)
    {
           $.ajax({
                type: "GET",
                url: base_url+"/property/DeleteImage/"+id, 
                dataType: "json",  
                cache:false,
                contentType: false,                   
                processData:false,
                success: function(response){
                   if(response.status==true){ $("#DeleteImage_"+id).remove();}
                }
         });
    }
</script>

@stop
