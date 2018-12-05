
<?php 
 $ccode = $_REQUEST['country']??43;
?>
<input type="hidden" name="country_id" value="{{$ccode}}">
<fieldset class="step ui-formwizard-content" id="step1" style="display: block; margin-left: 30px">
   <style type="text/css">
       .col-md-12 > h2, .tab-pane > h2 {
            text-align: center;
       }
       .btn-info{
        margin-bottom: 30px;
        margin-top: 30px;
       }
   </style>

<div class="row"> 

<div class="tabbable">
        <ul class="nav nav-tabs nav-tabs-highlight">
        <li class="active">
            <a href="#Builder" data-toggle="tab" aria-expanded="true">Builder</a>
        </li>
        <li class="">
            <a href="#Select_Plan" data-toggle="tab" aria-expanded="true">Select Plan</a>
        </li>

         <li class="">
            <a href="#Project_Details" data-toggle="tab" aria-expanded="true">Project Details</a>
        </li>

        <li class="">
            <a href="#Property_Availability" data-toggle="tab" aria-expanded="true">Property availability</a>
        </li>

        <li class="">
            <a href="#Status_Image" data-toggle="tab" aria-expanded="true">Status Image</a>
        </li>

        <li class="">
            <a href="#Image_Video_Gallery" data-toggle="tab" aria-expanded="true">Image & video gallery</a>
        </li>

        <li class="">
            <a href="#About_Project" data-toggle="tab" aria-expanded="true">About Project</a>
        </li>

         <li class="">
            <a href="#Amenities" data-toggle="tab" aria-expanded="true">Amenities</a>
        </li>

         
         <li class="">
            <a href="#Neighbourhood" data-toggle="tab" aria-expanded="true">Neighbourhood</a>
        </li>
        <li class="">
            <a href="#Finishes" data-toggle="tab" aria-expanded="true">Finishes</a>
        </li>
        
        <li class="">
            <a href="#Specification" data-toggle="tab" aria-expanded="true">Specification</a>
        </li> 
    </ul>
    <div class="tab-content">

              @if(Session::has('flash_alert_notice'))
               <div class="alert alert-success alert-dismissable" style="margin:10px">
                  <button aria-hidden="true" data-dismiss="alert"  class="close" type="button">×</button>
                <i class="icon fa fa-check"></i>  
               {{ Session::get('flash_alert_notice') }} 
               </div>
          @endif

          @if ($errors->any())
            <div class=" alert-danger alert"> <ul>   {!! implode('', $errors->all('<li>:message</li>')) !!} </ul>
                </div>
        @endif

    <div class="tab-pane active" id="Builder">
        <div class="col-md-12 row">
            
                                    
            <h2> Builder Detail </h2>
            <hr>
            <div class=" col-md-6 " id="propertybox">
                <label>Builder Id<span class="required"> * </span></label>
                <div class="input-group {{ $errors->first('builder_code', ' has-error') }}">
                    
                     {!! Form::text('builder_code',null, ['class' => 'form-control','id'=>'builder_code',   'style' => 'resize:none','placeholder'=>"search by Builder ID Ex. BLD-1001"])  !!} 



                    <span class="input-group-btn">
                        <button class="btn btn-default legitRipple" type="button" id="Search_by_id" onclick="getBuilder()"> <i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
                 <span  class="builder_name"></span> 
                <span  class="help-block"></span> 
                <span class="help-block" style="color:red">{{ $errors->first('builder_code', ':message') }} </span>
            </div> 
            <div class="col-md-4"> 
                @if(isset($builder))
                <img src="{{url($builder->profile_picture)}}" class="img-responsive burl"  style="height: 150px" />
                @else
                     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSAz2_S45rnJTpba6XhwhmwHhlLHZ1tgmwD8gLjyoSRGj4fozZYg" class="img-responsive burl"  style="height: 150px" />
                @endif

                <h3 class="bname">{{$builder->builder_name??''}}</h3> 
            </div> 
            <div class="col-md-12 pull-left">
             <a href="#Select_Plan" data-toggle="tab" aria-expanded="true">
                <button type="button" class="btn btn-info pull-right legitRipple">
                    Next
                     <i class="icon-next position-right"></i>
                 </button>
             </a>
            </div>

        </div>

    </div>
    <div class="tab-pane " id="Select_Plan">
        <div class="col-md-12">
            <h2>Plans </h2>
            <hr>
              <div class="col-md-6">
                <div class="form-group {{ $errors->first('plan', ' has-error') }}">
                    <label class="control-label  ">Select Plan <span class="required"> * </span></label> 
                    {!!Form::select('plan', $plans, null, ['class' => 'form-control', 'id'=>"plans",'placeholder'=>'Select Plan'])!!}
 
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
        </div>
        <div class="col-md-12 pull-left">
             <a href="#Project_Details" data-toggle="tab" aria-expanded="true">
                <button type="button" class="btn btn-info pull-right legitRipple">
                    Next
                     <i class="icon-next position-right"></i>
                 </button>
             </a>
             <a href="#Builder" data-toggle="tab" aria-expanded="true">
                <button type="button" class="btn btn-info pull-left legitRipple">
                    Previous
                     <i class="icon-next position-left"></i>
                 </button>
             </a>
         </div> 
    </div>

    <div class="tab-pane" id="Project_Details">
        <div class="col-md-12">
             <h2 style="text-align: center;">Project Details </h2>
            <hr>

             <div class="col-md-6">
                <div class="form-group {{ $errors->first('name', ' has-error') }}">
                    <label class="control-label  ">Project Name <span class="required"> * </span></label>
                    {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div>  
            
          <!--   <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label  ">Project Grade  </label>
                    {!! Form::text('grade_id',null, ['class' => 'form-control','data-required'=>1])  !!} 
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div>  -->


            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Grade <span class="required"> * </span></label> 
                    <select class="form-control"   name="category" id="category">
                        @foreach($grade as $result)
                        <option value="{{$result->id}}"  style="margin-left: 100px" >{{$result->name}}</option> 
                        @endforeach
                    </select>
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Category <span class="required"> * </span></label> 
                    <select class="form-control"   name="category" id="category">
                        @foreach($category as $result)
                        <option value="{{$result->id}}"  style="margin-left: 100px" >{{$result->name}}</option> 
                        @endforeach
                    </select>
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Type <span class="required"> * </span></label> 
                    <select class="form-control"   name="type" id=" ">
                       @foreach($type as $result)
                        <option value="{{$result->id}}"  style="margin-left: 100px" >{{$result->name}}</option> 
                        @endforeach
                    </select>
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Area <span class="required"> * </span></label> 
                       {!! Form::text('area',null, ['class' => 'form-control','data-required'=>1])  !!}
                     
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label  ">Possession date  </label>
                    {!! Form::text('possession_date',null, [
                        'class' => 'form-control',
                        'data-required'=>1,
                        'data-date-format'=>"dd/mm/yyyy", 
                        'id'=>"startdate",
                        'aria-invalid'=>"false"
                        ])  !!}  



                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 


        <div class="col-md-12 pull-left">
             <a href="#Property_Availability" data-toggle="tab" aria-expanded="true">
                <button type="button" class="btn btn-info pull-right legitRipple">
                    Next
                     <i class="icon-next position-right"></i>
                 </button>
             </a>
             <a href="#Select_Plan" data-toggle="tab" aria-expanded="true">
                <button type="button" class="btn btn-info pull-left legitRipple">
                    Previous
                     <i class="icon-next position-left"></i>
                 </button>
             </a>
         </div> 




        </div>
    </div>

    <div class="tab-pane" id="Property_Availability">
        <h2 style="text-align: center;">Project Availability </h2>
            <hr>
        <div class="col-md-12">
            <div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">No.Of Floors <span class="required"> * </span></label>
                                    {!! Form::text('no_of_floors',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block no_of_floors" style="color:red"> </span>
                                </div> 
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">No.Of Flats <span class="required"> * </span></label>
                                    {!! Form::text('no_of_flats',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block no_of_flats" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label  ">Plot/Land area <span class="required"> * </span></label>
                                    {!! Form::text('land_area',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label  ">Unit <span class="required"> * </span></label>  

                                    {!!Form::select('unit', $unit, null, ['class' => 'form-control'])!!}
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="control-label  ">Project Status <span class="required"> * </span></label> 
                                    {!!Form::select('project_status', $project_status, null, ['class' => 'form-control'])!!}
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            


            <div class="col-md-3">
                <div class="form-group {{ $errors->first('location', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Location <span class="required"> * </span></label>
                        {!! Form::text('location',null, ['class' => 'form-control','data-required'=>1,'id'=>'location','onkeyup'=>'initMap()'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('location', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

            <div class="col-md-3">
                <div class="form-group {{ $errors->first('latitude', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Latitude <span class="required"> * </span></label>
                        {!! Form::text('latitude',null, ['class' => 'form-control','data-required'=>1,'id'=>'latitude'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('latitude', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

             <div class="col-md-3">
                <div class="form-group {{ $errors->first('longitude', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Longitude <span class="required"> * </span></label>
                        {!! Form::text('longitude',null, ['class' => 'form-control','data-required'=>1,'id'=>'longitude'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('longitude', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">No.Of BHK <span class="required"> * </span></label>
                                    <div>
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success  bhk text-success-600 modulecountry  CheckboxStyle" name="1bhk" value="1">
                                            <p style="margin-top: 3px">1</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success bhk text-success-600 modulecountry  CheckboxStyle" name="2bhk" value="2">
                                            <p style="margin-top: 3px">2</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success bhk  text-success-600 modulecountry  CheckboxStyle" name="3bhk" value="3">
                                            <p style="margin-top: 3px">3</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success bhk  text-success-600 modulecountry  CheckboxStyle" name="4bhk" value="4">
                                            <p style="margin-top: 3px">4</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success bhk  text-success-600 modulecountry  CheckboxStyle" name="5bhk" value="5">
                                            <p style="margin-top: 3px">5</p>
                                        </label>
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success bhk text-success-600 modulecountry  CheckboxStyle" name="6bhk" value="6">
                                            <p style="margin-top: 3px">6</p>
                                        </label>
                                    </div>
                                    <label class="bhk_error"></label>
                                </div> 
                            </div>  
                            <div class="col-md-4 " align="center"  style="margin-top: 20px"> 
                                <button type="button" class="btn btn-warning legitRipple" onclick="prepareChart()">
                                    Prepare Availability Chart  
                                </button>
                            </div>
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px"></div>
                            </div>
                            <!-- prepare chart -->
                            <div id="prepareChart"> 

                            </div>
                            {!!  $prepareChart !!}
                            {!!  $bhkChart !!}
                            <!-- end prepare chart -->
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                            </div>
                        </div> 


                        <div class="bhkChart">
 

                         </div> 

                    <div class="col-md-12 pull-left">
                         <a href="#Status_Image" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-right legitRipple">
                                Next
                                 <i class="icon-next position-right"></i>
                             </button>
                         </a>
                         <a href="#Project_Details" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-left legitRipple">
                                Previous
                                 <i class="icon-next position-left"></i>
                             </button>
                         </a>
                     </div>  

                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane " id="Status_Image">
         <h2>Status Image </h2>
            <hr>
        <div class="col-md-12">
                <div class="panel-body">


                        <div class="row" id="statusImage">
                           <button type="button" class=" btn bg-indigo legitRipple pull-right" onclick="addImage()">
                                    Add more 
                            </button>  
                        @if(isset($project->status_date)) 
                            <?php $status_date = json_decode($project->status_date,true);   ?>
                                @foreach($status_date as   $value)


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status Date </label>
                                    {!! Form::text('status_date[]',$value??null, [
                                        'class' => 'form-control startdate',
                                        'data-required'=>1,
                                        'data-date-format'=>"dd/mm/yyyy", 
                                        'id'=>"startdate",
                                        'aria-invalid'=>"false"
                                        ])  !!}  
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status image </label>
                                    {!! Form::file('status_image[]',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>

                            @endforeach 

                            @else

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status Date </label>
                                    {!! Form::text('status_date[]',null, [
                                        'class' => 'form-control startdate',
                                        'data-required'=>1,
                                        'data-date-format'=>"dd/mm/yyyy", 
                                        'id'=>"startdate",
                                        'aria-invalid'=>"false"
                                        ])  !!}  
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Status image </label>
                                    {!! Form::file('status_image[]',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            @endif


                        </div>
                        
                    <div class="col-md-12 pull-left">
                         <a href="#Image_Video_Gallery" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-right legitRipple">
                                Next
                                 <i class="icon-next position-right"></i>
                             </button>
                         </a>
                         <a href="#Property_Availability" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-left legitRipple">
                                Previous
                                 <i class="icon-next position-left"></i>
                             </button>
                         </a>
                     </div> 
 
                        
                    </div>
        </div>
    </div>

    <div class="tab-pane " id="Image_Video_Gallery">
        <h2>Image Video Gallery </h2>
            <hr>
        <div class="col-md-12">
            <div class="panel-body">
                         
                        <h5 class="panel-title">Video Url </h5>
                        <button type="button" class=" btn bg-indigo legitRipple pull-right" onclick="videoUrl()">
                                    Add more 
                         </button>
                        <br/><br/><br/>
                        @if(isset($project->video_url))
                        <div class="row" id="video_url"> 
                            <?php $vdo = json_decode($project->video_url,true);   ?>
                                @foreach($vdo as   $value)
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label class="control-label  ">Youtube URL </label>
                                        {!! Form::text('video_url[]',$value??null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                            @endforeach

                        </div>
                        @else
                            <div class="row" id="video_url"> 
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label class="control-label  ">Youtube URL </label>
                                        {!! Form::text('video_url[]',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>   
                        </div>
                        @endif 

                    <div class="col-md-12 pull-left">
                         <a href="#About_Project" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-right legitRipple">
                                Next
                                 <i class="icon-next position-right"></i>
                             </button>
                         </a>
                         <a href="#Status_Image" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-left legitRipple">
                                Previous
                                 <i class="icon-next position-left"></i>
                             </button>
                         </a>
                     </div>  
                        
                    </div>
        </div>
    </div>

    <div class="tab-pane " id="About_Project">
        <h2>About Project </h2>
            <hr>
        <div class="col-md-12">
            <div class="panel-body">
                        
                        <div class="row">
                               
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label  ">About the project </label>
                                    {!! Form::textarea('about_project',null, ['class' => 'form-control','data-required'=>1,'rows' => 4, 'cols' => 5, 'style' => 'resize:none'])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                                <div style="color: #EF6C00;">To display this for your page visitors, tick it</div>
                                <br/>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="advantage[]" value="prize_on_request"

                                        @if(isset($project->advantage))
                                           @if(in_array('prize_on_request', json_decode($project->advantage,true)))
                                            checked
                                           @endif
                                        @endif

                                        >
                                        <p style="margin-top: 3px">Prize on Request </p>
                                   </label>
                                </div> 
                                
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="advantage[]" value="toll_free_number"

                                          @if(isset($project->advantage))
                                           @if(in_array('toll_free_number', json_decode($project->advantage,true)))
                                            checked
                                           @endif
                                        @endif

                                        >
                                        <p style="margin-top: 3px">Toll-free number</p>
                                   </label>
                                </div>
                                 <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="advantage[]" value="price"
                                         @if(isset($project->advantage))
                                           @if(in_array('price', json_decode($project->advantage,true)))
                                            checked
                                           @endif
                                        @endif
                                        >
                                        <p style="margin-top: 3px">Price</p>
                                   </label>
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="advantage[]" value="customer_care"

                                         @if(isset($project->advantage))
                                           @if(in_array('customer_care', json_decode($project->advantage,true)))
                                            checked
                                           @endif
                                        @endif

                                        >
                                        <p style="margin-top: 3px">Customer Care</p>
                                   </label>
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="advantage[]"  value="emi_start"

                                         @if(isset($project->advantage))
                                           @if(in_array('emi_start', json_decode($project->advantage,true)))
                                            checked
                                           @endif
                                        @endif

                                        >
                                        <p style="margin-top: 3px">EMI Start</p>
                                   </label>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Request for more ( comma (,) seprated )  </label>

                                        {!! Form::text("advantage[request]",$advantage_request??null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                        </div>


                        <div class="col-md-12 pull-left">
                         <a href="#Amenities" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-right legitRipple">
                                Next
                                 <i class="icon-next position-right"></i>
                             </button>
                         </a>
                         <a href="#Image_Video_Gallery" data-toggle="tab" aria-expanded="true">
                            <button type="button" class="btn btn-info pull-left legitRipple">
                                Previous
                                 <i class="icon-next position-left"></i>
                             </button>
                         </a>
                     </div>   
                        
                    </div>
        </div>
    </div>

    <div class="tab-pane " id="Amenities">
        <h2>Amenities </h2>
            <hr>
        <div class="col-md-12"> 
            <div class="row"> 
                @foreach($amenities as $key => $value)
                <div class="col-md-3"> 
                    <label class="checkbox-inline">  
                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="amenities[]" value="{{$value->id}}"
                       @if(isset($project->amenities))
                        <?php $amn = array_search($value->id,json_decode($project->amenities)); ?>
                       @if($amn===0 || $amn)
                          checked
                       @endif

                       @endif
                        >
                        <p style="margin-top: 3px">{{$value->name}}   </p>
                   </label>
                    
                </div>  
            @endforeach
                 
            </div> 

            <div class="col-md-12 pull-left">
                  <br><br>
                 <a href="#Neighbourhood" data-toggle="tab" aria-expanded="true">
                    <button type="button" class="btn btn-info pull-right legitRipple">
                        Next
                         <i class="icon-next position-right"></i>
                     </button>
                 </a>
                 <a href="#About_Project" data-toggle="tab" aria-expanded="true">
                    <button type="button" class="btn btn-info pull-left legitRipple">
                        Previous
                         <i class="icon-next position-left"></i>
                     </button>
                 </a>
             </div>   


            
        </div>
    </div>

    <div class="tab-pane " id="Neighbourhood">
        <h2>Neighbourhood </h2>
            <hr>
        <div class="col-md-12">
            <div class="panel-body">
                        <div class="row"> 
                            @foreach($neighbourhood as $key => $value)
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="neighbourhood[]" value="{{$value->id}}"

                                         @if(isset($project->neighbourhood))
                                           @if(in_array($value->id, json_decode($project->neighbourhood,true)))
                                            checked
                                           @endif
                                        @endif

                                        >
                                    <?php 
                                    if(isset($project->neighbourhood_distance)){

                                        $nbhd = json_decode($project->neighbourhood_distance,true);
                                        }else{
                                            $nbhd = []; 
                                        } 
                                    ?>


                                        <p style="margin-top: 3px">{{$value->name}} (in m) </p>
                                   </label>
                                    {!! Form::text('neighbourhood_distance['.$value->id.']',$nbhd[$value->id]??null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>  
                            @endforeach
                            
                        </div> 


            <div class="col-md-12 pull-left">
                  
                 <a href="#Finishes" data-toggle="tab" aria-expanded="true">
                    <button type="button" class="btn btn-info pull-right legitRipple">
                        Next
                         <i class="icon-next position-right"></i>
                     </button>
                 </a>
                 <a href="#Amenities" data-toggle="tab" aria-expanded="true">
                    <button type="button" class="btn btn-info pull-left legitRipple">
                        Previous
                         <i class="icon-next position-left"></i>
                     </button>
                 </a>
             </div>  
                        
                    </div>
        </div>
    </div>

    <div class="tab-pane " id="Finishes">
        <h2>Finishes </h2>
            <hr>
        <div class="col-md-12">
             <div class="panel-body">
                        
                            <div class="row"> 
                                
                                @foreach($finishes as $key => $value)
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="finishes[]" value="{{$value->id}}"
                                     @if(isset($project->amenities))
                                       @if(in_array($value->id, json_decode($project->finishes,true)))
                                        checked
                                       @endif
                                    @endif
                                        >
                                        <p style="margin-top: 3px">{{$value->name}} </p>
                                   </label> 
                                </div>  

                                @endforeach
                                
                                <br/><br/><br/><br/>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label  ">Request for more ( comma (,) seprated )  </label>
                                        
                                        {!! Form::text('finishes[request]',$finishes_request??null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                                 
                            </div>

                        <div class="col-md-12 pull-left">
                              
                             <a href="#Specification" data-toggle="tab" aria-expanded="true">
                                <button type="button" class="btn btn-info pull-right legitRipple">
                                    Next
                                     <i class="icon-next position-right"></i>
                                 </button>
                             </a>
                             <a href="#Neighbourhood" data-toggle="tab" aria-expanded="true">
                                <button type="button" class="btn btn-info pull-left legitRipple">
                                    Previous
                                     <i class="icon-next position-left"></i>
                                 </button>
                             </a>
                         </div>   
                       
            </div>
        </div>
    </div>


    <div class="tab-pane" id="Specification">
         <h2>Specification </h2>
            <hr>
        <div class="col-md-12">
            <div class="panel-body">

                <div class="col-md-12">
                    <div class="form-group">
                    <label class="control-label  ">Specification </label>
                    {!! Form::textarea('specification',null, ['class' => 'form-control','data-required'=>1,'rows' => 4, 'cols' => 5, 'style' => 'resize:none'])  !!} 
                    <span class="help-block" style="color:red"> </span>
                    </div> 
                </div> 
 

            </div>
        </div>
    </div>

     <div class="col-md-12">

        <div class="form-group pull-right ">
        {!! Form::submit('Save & Continue', ['class'=>'btn  btn-primary text-white','id'=>'save_continue']) !!}
            <input type="hidden" name="btn_name" id='btn_name' value="save_continue">
           {!! Form::submit('Save & Publish ', ['class'=>'btn  btn-success text-white','id'=>'save_publish']) !!}

            <a href="{{route('project')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white',]) !!} </a>
        </div>
    </div> 

</div>

</fieldset >
