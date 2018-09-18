 @extends('website::web.common-master')
 @section('title', " Ok4homes | Post your property ")
 @section('css')
 
    <link href="{{asset('public/site/css/imageuploadify.min.css')}}" rel="stylesheet">

@stop

 @section('content')

 <style>
     .dispayNone{display: none}
     .dispayBox{display: block}
     .btn-next {border: none!important;color: #fff;padding: 15px 45px;border-radius: 10px;}
     .btn-back {margin-right: 10px;border: none;color: #fff;padding: 15px 45px;border-radius: 10px;}
     .validation-error-label{color:red!important;font-size: 1rem;}



 </style>

 <section class="add-property">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="left-box">
                       <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d205469.69984329806!2d76.45357493413802!3d9.952257009672524!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1521473564889" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                       <div style="width:1500px; height:800px;">
                            <div id="map"  style="width: 40%; height: 100%"></div>
                       </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="right-box">
                        <h2 style="margin-top: 99px;">Add new property</h2>
                         @if(Session::has('val')) 
                            @if(Session::get('val')==1)
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 14px;">×</button>
                                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                                    {{Session::get('msg')}}
                                </div>
                            @endif
                        @endif
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
                                           <i id="title_2" class="dispayNone"> Property Details</i>
                                        </p>
                                    </a>
                                </li>
                                <li id="tab_3">
                                    <a href="#" >
                                        <p><span>3</span>
                                            <i id="title_3" class="dispayNone">Amineties</i>
                                        </p>
                                    </a>
                                </li>
                                <li id="tab_4">
                                    <a href="#" >
                                        <p><span>4</span> 
                                            <i id="title_4" class="dispayNone"> Neighbourhood Map</i>
                                        </p>
                                    </a>
                                </li>
                                <li id="tab_5">
                                    <a href="#" >
                                        <p><span>5</span> 
                                            <i id="title_5" class="dispayNone">Gallery</i>
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!--step 1-->
                        <form action="#" id="property_list_add" autocomplete="off">

                        <div id="first_step" class="dispayBox">
                            <div class="step-form-box">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div id="property_title"> 
                                            <div class="input-field" >
                                           
                                            <input id="property_title" name="property_title" type="text" class="validate"  required>
                                            <label for="property_title">Title</label>

                                        </div>
                                        <span  class="help-block"></span>
                                        </div>
                                        
                                        
                                        <div class="input-box"  id="property_type">
                                            <select class="browser-default" type="select" id="property_type" name="property_type" required>
                                              <option value="">Type</option>
                                               @if($property_types)
                                                    @foreach($property_types as $type)
                                                        <option value="{{$type->id}}" >{{$type->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                             <span  class="help-block"></span>   
                                        </div>
                                        <div class="input-box" id="location">
                                           
                                              <input id="pac-input" name="location" type="text" placeholder="Enter a location" class="validate" style="    font-size: 12px;">
                                     
                                          
                                             <span  class="help-block"></span>   
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12" id="property_category">
                                         <div class="input-box">
                                            <select class="browser-default" type="select" id="property_category" name="property_category" required>
                                              <option value="">Category</option>
                                                @if($property_categories)
                                                    @foreach($property_categories as $category)
                                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span  class="help-block"></span>   
                                        </div>
                                        <div id="property_prize"> 
                                            <div class="input-field" >
                                                <input id="property_prize" name="property_prize" type="text" class="validate" required>
                                                <label for="property_title">Prize</label>
                                                
                                            </div>
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
                                        
                                       <div class="input-box" id="bedroom">
                                            <select class="browser-default" type="select" id="bedroom" name="bedroom" required>
                                              <option value="">Bedroom</option>
                                              <option value="1">1 </option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                            </select>
                                            <span  class="help-block"></span>  
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-12">
                                        
                                         <div class="input-box" id="building_unit">
                                            <select class="browser-default" id="building_unit" type="select" name="building_unit" required>
                                              <option value="">Building Unit</option>
                                              @if($building_units)
                                                @foreach($building_units as $bunit)
                                                    <option value="{{$bunit->id}}" >{{$bunit->unit}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                            <span  class="help-block"></span>  
                                        </div>
                                        <div class="input-box" id="bathroom">
                                            <select class="browser-default" type="select" id="bathroom" name="bathroom" required>
                                              <option value="">Bathroom</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
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
                                                    <option value="{{$lunit->id}}" >{{$lunit->land_unit}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                            <span  class="help-block"></span> 
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="input-field">
                                            <input id="description" name="description" type="text" class="validate">
                                            <label for="Description">Description</label>
                                        </div>
                                    </div>
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
                                     
                                 <ul>
                                 @foreach($amenities as $amenity)
                                 <li><span><img src="{{ URL::asset('public/images/amenities/'.$amenity['icon']) }}" alt=""></span>
                                                <p >{{$amenity['name']}}</p><li class=""></li><input type="checkbox"  id="amenities" name="amenities[]" class="checker border-success text-success-600 amenities" style="opacity:1;pointer-events:auto;margin-left: -15px;" value="{{$amenity['id']}}" ></li>

                                @endforeach
                                  </ul>
                                </div>
                                @endforeach
                               
                                </div>
                                <div class="text-center">
                                        <a href="#" class="more">More</a>
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
                              
                              
                            <div class="step-form-box">
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
                                            <input id="neighbourhood" name="km[]" type="text" class="validate" >
                                            <input id="neighbourhood" name="neighbourhood[]" value="{{$neighbourhood['id']}}" type="hidden" class="validate"  >
                                            <label for="Hospital">{{$neighbourhood['name']}}</label>
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
                                        <input id="file-upload" type="file" name="images[]"  accept="image/*" multiple/>
                                </div>
                            </div>
                        </div>
                        <div class="button-box">
                            <div class="button-right">
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
 
 @stop
 
 @section('js')
<!-- controls -->
<script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/site/js/plugin/imageuploadify.min.js')}}"></script>
<script src="{{asset('public/site/js/property.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap"async defer></script>
<script type="text/javascript">  $('input[type="file"]').imageuploadify();</script>
@stop
