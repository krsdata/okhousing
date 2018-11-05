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

    <div class="tab-pane active" id="Builder">
        <div class="col-md-12 row">
            <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" class="form-control pickadate-accessibility" placeholder="Try me&hellip;">
                                    </div>
                                    
            <h2> Builder Detail </h2>
            <hr>
            <div class=" col-md-6 " id="propertybox">
                <label>Builder<span class="required"> * </span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="builder_code" name="builder_code" placeholder="search by Builder ID Ex. BLD-10001">
                    <span class="input-group-btn">
                        <button class="btn btn-default legitRipple" type="button" id="Search_by_id" onclick="getBuilder()"> <i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
                 <span  class="builder_name"></span> 
                <span  class="help-block"></span> 
            </div> 
            <div class="col-md-4"> 
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSAz2_S45rnJTpba6XhwhmwHhlLHZ1tgmwD8gLjyoSRGj4fozZYg" class="img-responsive burl"  style="height: 150px" />
                <h3 class="bname"></h3> 
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
                <div class="form-group ">
                    <label class="control-label  ">Select Plan <span class="required"> * </span></label> 
                    <select class="form-control"   name=" " id=" ">
                        <option value="select" >select</option> 
                    </select>
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
                <div class="form-group">
                    <label class="control-label  ">Project Name <span class="required"> * </span></label>
                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div>  
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label  ">Project Grade  </label>
                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Category <span class="required"> * </span></label> 
                    <select class="form-control"   name=" " id=" ">
                        <option value="select" >select</option> 
                    </select>
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Type <span class="required"> * </span></label> 
                    <select class="form-control"   name=" " id=" ">
                        <option value="select" >select</option> 
                    </select>
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="control-label  ">Area <span class="required"> * </span></label> 
                    <select class="form-control"   name=" " id=" ">
                        <option value="select" >select</option> 
                    </select>
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div> 
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label  ">Possession date  </label>
                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                    <span class="help-block" style="color:red"> </span>
                </div> 
            </div>

            <div class="col-md-12  " align="right"  > 
                <a href="#Property_Availability" data-toggle="tab" aria-expanded="true">
                       
                    <button type="button" class="btn btn-info legitRipple ">
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
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">No.Of Flats <span class="required"> * </span></label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label  ">Plot/Land area <span class="required"> * </span></label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="control-label  ">Unit <span class="required"> * </span></label> 
                                    <select class="form-control"   name=" " id=" ">
                                        <option value="select" >select</option> 
                                    </select>
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>  
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label class="control-label  ">Project Status <span class="required"> * </span></label> 
                                    <select class="form-control"   name=" " id=" ">
                                        <option value="select" >select</option> 
                                    </select>
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label  ">Location <span class="required"> * </span></label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">No.Of BHK <span class="required"> * </span></label>
                                    <div>
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                            <p style="margin-top: 3px">1</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                            <p style="margin-top: 3px">2</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                            <p style="margin-top: 3px">3</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                            <p style="margin-top: 3px">4</p>
                                        </label>

                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                            <p style="margin-top: 3px">5</p>
                                        </label>
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                            <p style="margin-top: 3px">6</p>
                                        </label>
                                    </div>
                                </div> 
                            </div>  
                            <div class="col-md-6 " align="center"  style="margin-top: 20px"> 
                                <button type="button" class="btn btn-warning legitRipple">
                                    Prepare Availability Chart  
                                </button>
                            </div>
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px"></div>
                            </div>
                            <div class="col-md-12 ">        
                                <h5 class="panel-title">Availability Chart </h5>
                                <br/>
                                <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                                <tr>
                                                        <th>Floor</th>
                                                        <th>A</th>
                                                        <th>B</th>
                                                        <th>C</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                        <td>Ground</td>
                                                         <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>
                                                         <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>
                                                         <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>

                                                </tr>

                                                  <tr>
                                                        <td>First</td>
                                                         <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>
                                                         <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>

                                                </tr>

                                                  <tr>
                                                        <td>Second</td>
                                                        <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div> 
                                                                <label class="checkbox-inline">  
                                                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >

                                                                </label>
                                                            </div>
                                                        </td>

                                                </tr>


                                        </tbody>
                                </table>
                            </div> 
                            </div> 
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-md-12 " >
                                <h5 class="panel-title">1 BHK </h5> 
                                <button type="button" class=" btn bg-indigo legitRipple pull-right" style="margin-top: -20px">
                                    ADD More 1 BHK  
                                </button> 
                                <br/>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Area <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Unit <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Price <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Display <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                            <option>yes</option> 
                                            <option>no</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">2D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">3D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">Key Plan  </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                            </div>
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12 " >
                                <h5 class="panel-title">1 BHK </h5>   
                                <button type="button" class=" btn bg-danger legitRipple pull-right" style="margin-top: -20px">
                                    Remove 
                                </button>
                                <br/>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Area <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Unit <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Price <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Display <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                            <option>yes</option> 
                                            <option>no</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">2D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">3D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">Key Plan  </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                            </div>
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 " >
                                <h5 class="panel-title">2 BHK </h5> 
                                <button type="button" class=" btn bg-indigo legitRipple pull-right" style="margin-top: -20px">
                                    ADD More 2 BHK  
                                </button> 
                                <br/>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Area <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Unit <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Price <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Display <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                            <option>yes</option> 
                                            <option>no</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">2D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">3D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">Key Plan  </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                            </div>
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12 " >
                                <h5 class="panel-title">2 BHK </h5>   
                                <button type="button" class=" btn bg-danger legitRipple pull-right" style="margin-top: -20px">
                                    Remove 
                                </button> 
                                <br/>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Area <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Unit <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label  ">Price <span class="required"> * </span></label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label class="control-label  ">Display <span class="required"> * </span></label> 
                                        <select class="form-control"   name=" " id=" ">
                                            <option value="select" >select</option> 
                                            <option>yes</option> 
                                            <option>no</option> 
                                        </select>
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">2D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">3D Floor Plan </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label  ">Key Plan  </label>
                                        {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>  
                            </div>
                            <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                            </div>
                        </div>       
                        <div class="col-md-12  " align="right"  > 
                            <a href="#Status_Image" data-toggle="tab" aria-expanded="true">
                 
                            <button type="button" class="btn btn-info legitRipple " >
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
                        <div class="row">
                            <button type="button" class=" btn bg-indigo legitRipple pull-right" >
                                    Add more 
                            </button>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">Date </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">Status image </label>
                                    {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                        </div>
                        
                        <div class="row">
                            <button type="button" class=" btn bg-danger legitRipple pull-right" >
                                    Remove 
                            </button>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">Date </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">Status image </label>
                                    {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                        </div> 
                        <div class="col-md-12  " align="right"  > 
                            <a href="#Image_Video_Gallery" data-toggle="tab" aria-expanded="true">
                 
                            <button type="button" class="btn btn-info legitRipple ">
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
                        <h5 class="panel-title">Image </h5> <br/>
                        add any plugin with remove image option
                        <div class="col-md-12 " >
                                <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
                        </div>
                        <h5 class="panel-title">Video </h5>
                        <button type="button" class=" btn bg-indigo legitRipple pull-right" >
                                    Add more 
                         </button>
                        <br/><br/><br/>
                            <div class="row">
                               
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="control-label  ">Youtube URL </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                            <div class="col-md-1">
                                <button type="button" class=" btn bg-danger legitRipple pull-right" style="margin-top: 20px">
                                        Remove 
                                </button>  
                           </div>
                              
                        </div> 
                        <div class="col-md-12  " align="right"  > 
                            <a href="#About_Project" data-toggle="tab" aria-expanded="true">
                 
                            <button type="button" class="btn btn-info legitRipple ">
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
                                    {!! Form::textarea(' ',null, ['class' => 'form-control','data-required'=>1,'rows' => 4, 'cols' => 5, 'style' => 'resize:none'])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                                <div style="color: #EF6C00;">To display this for your page visitors, tick it</div>
                                <br/>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">Prize on Request </p>
                                   </label>
                                </div> 
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">Area Sq.Ft Rate</p>
                                   </label>
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">toll-free number</p>
                                   </label>
                                </div>
                                 <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">Price</p>
                                   </label>
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">Customer Care</p>
                                   </label>
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">EMI Start</p>
                                   </label>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label  ">Request for more ( comma (,) seprated )  </label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                        </div> 
                        
                        <div class="col-md-12  " align="right"  > 
                            <a href="#Amenities" data-toggle="tab" aria-expanded="true">
                 
                            <button type="button" class="btn btn-info legitRipple ">
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
                <div class="col-md-4"> 
                    <label class="checkbox-inline">  
                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                        <p style="margin-top: 3px">Amenities 1 </p>
                   </label>
                </div> 
                <div class="col-md-4"> 
                    <label class="checkbox-inline">  
                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                        <p style="margin-top: 3px">Amenities 2 </p>
                   </label>
                </div>
                <div class="col-md-4"> 
                    <label class="checkbox-inline">  
                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                        <p style="margin-top: 3px">Amenities 3 </p>
                   </label>
                </div> 
            </div> 
                        
            <div class="col-md-12" align="right"> 
                <br><br>

                <a href="#Neighbourhood" data-toggle="tab" aria-expanded="true">
                    <button type="button" class="btn btn-info legitRipple ">
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
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">church (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>  
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">hindu_temple (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">mosque (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">supermarket (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">hospital (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">bus_station (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">atm (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">school (in m) </p>
                                   </label>
                                    {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1,'style' => 'margin-bottom:20px'])  !!} 
                                </div>
                                
                            </div> 
                        
                        <div class="col-md-12  " align="right"  > 
                           <a href="#Finishes" data-toggle="tab" aria-expanded="true">
                 
                            <button type="button" class="btn btn-info legitRipple ">
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
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">Flooring </p>
                                   </label> 
                                </div>  
                                <div class="col-md-3"> 
                                    <label class="checkbox-inline">  
                                        <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                        <p style="margin-top: 3px">Wall </p>
                                   </label> 
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label  ">Request for more ( comma (,) seprated )  </label>
                                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                                        <span class="help-block" style="color:red"> </span>
                                    </div> 
                                </div>
                                 
                            </div> 
                        
                        <div class="col-md-12  " align="right"  > 
                           <a href="#Specification" data-toggle="tab" aria-expanded="true">
                                <button type="button" class="btn btn-info legitRipple ">
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
                    {!! Form::textarea(' ',null, ['class' => 'form-control','data-required'=>1,'rows' => 4, 'cols' => 5, 'style' => 'resize:none'])  !!} 
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
