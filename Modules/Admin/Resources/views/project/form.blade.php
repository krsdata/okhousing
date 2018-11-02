<div class="panel-group" id="accordion-styled">
    <!-- accordion start --> 
    <!--Builder search and details-->
    <div class="panel"> 
        <div class="panel-heading bg-orange">
            <h6 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group1">Builder Details</a>
            </h6>
        </div> 
        <div id="accordion-styled-group1" class="panel-collapse collapse in">
            <div class="panel-body"> 
                <div class="form-group col-md-6 " id="propertybox">
                    <label>Builder<span class="required"> * </span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="builder_code" name="builder_code" placeholder="search by Builder ID Ex. BLD-10001">
                        <span class="input-group-btn">
                            <button class="btn btn-default legitRipple" type="button" id="Search_by_id" onclick="getBuilder()"> <i class="glyphicon glyphicon-search"></i></button>
                        </span>
                    </div>
                    <span  class="help-block"></span> 
                </div> 
                <div class="col-md-4"> 
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSAz2_S45rnJTpba6XhwhmwHhlLHZ1tgmwD8gLjyoSRGj4fozZYg" class="img-responsive burl"  height="200px" />
                    <h3 class="bname"></h3> 
                </div> 
                
                <div class="col-md-12" align="right">
                    <button type="button" class="btn btn-primary legitRipple">
                        Next
                         <i class="icon-next position-right"></i>
                     </button>
                </div>
            </div>    
        </div>
    </div> 
    <!-- //Builder search and details-->
    
    <!--  select plan--> 
    <div class="panel">
        <div class="panel-heading bg-primary">
            <h6 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group2">Select Your Plan</a>
            </h6>
        </div>
        <div id="accordion-styled-group2" class="panel-collapse collapse">
            <div class="panel-body"> 
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Bronze</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="the-price">
                                        <h1>
                                            $10<span class="subscript">/mo</span></h1>
                                        <small>1 month FREE trial</small>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>
                                                1 Account
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                1 Project
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                100K API Access
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                100MB Storage
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Custom Cloud Services
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                Weekly Reports
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <div style="margin: 20px"> 
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                             Select this plan
                                       </label>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="panel panel-success">
                                <div class="cnrflash">
                                    <div class="cnrflash-inner">
                                        <span class="cnrflash-label">MOST
                                            <br>
                                            POPULR</span>
                                    </div>
                                </div>
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Silver</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="the-price">
                                        <h1>
                                            $20<span class="subscript">/mo</span></h1>
                                        <small>1 month FREE trial</small>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>
                                                2 Account
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                5 Project
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                100K API Access
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                200MB Storage
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Custom Cloud Services
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                Weekly Reports
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <div style="margin: 20px"> 
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                             Select this plan
                                       </label>
                                    </div>  
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Gold</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="the-price">
                                        <h1>
                                            $35<span class="subscript">/mo</span></h1>
                                        <small>1 month FREE trial</small>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>
                                                5 Account
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                20 Project
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                300K API Access
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                500MB Storage
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Custom Cloud Services
                                            </td>
                                        </tr>
                                        <tr class="active">
                                            <td>
                                                Weekly Reports
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <div style="margin: 20px"> 
                                        <label class="checkbox-inline">  
                                            <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name=" " >
                                             Select this plan
                                       </label>
                                    </div>  
                                </div>
                            </div>
                        </div> 
                    </div>       
                </div>
                <div class="clearfix"></div>   
                <div class="col-md-12  " align="center" style="padding-top: 20px"> 
                    <button type="button" class="btn btn-primary legitRipple ">
                        Next
                        <i class="icon-next position-right"></i>
                    </button>
                </div> 
            </div>
        </div>
    </div>
    <!--  //select plan-->
 
    <!--  Project Details-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group3">Project Details</a>
                    </h6>
            </div>
            <div id="accordion-styled-group3" class="panel-collapse collapse">
                    <div class="panel-body">
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
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  //Project Details-->  
    
     <!--  Project Details-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group4">Property Availability</a>
                    </h6>
            </div>
            <div id="accordion-styled-group4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label  ">No.Of Floors <span class="required"> * </span></label>
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
                            <button type="button" class="btn btn-primary legitRipple " >
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>  
                    </div>
            </div>
    </div> 
    <!--  //Project Details-->
    
    <!--  Status image-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group5">Status image</a>
                    </h6>
            </div>
            <div id="accordion-styled-group5" class="panel-collapse collapse">
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
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  //Status image-->  
    
    <!--  Image Gallery-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group6">Image & Video Gallery</a>
                    </h6>
            </div>
            <div id="accordion-styled-group6" class="panel-collapse collapse">
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
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  // Image Gallery-->  
    
    <!-- About Project-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group7">About Project</a>
                    </h6>
            </div>
            <div id="accordion-styled-group7" class="panel-collapse collapse">
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
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  // About Project-->
    
    <!-- Amenities-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group8">Amenities</a>
                    </h6>
            </div>
            <div id="accordion-styled-group8" class="panel-collapse collapse">
                    <div class="panel-body">
                        
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
                        
                        <div class="col-md-12  " align="right"  > 
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  // Amenities-->
    
    <!-- Neighbourhood-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group9">Neighbourhood</a>
                    </h6>
            </div>
            <div id="accordion-styled-group9" class="panel-collapse collapse">
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
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  // Neighbourhood-->
    
    <!-- Finishes-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group10">Finishes</a>
                    </h6>
            </div>
            <div id="accordion-styled-group10" class="panel-collapse collapse">
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
                            <button type="button" class="btn btn-primary legitRipple ">
                                Next
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  // Finishes-->
    
    <!-- Specification-->
    <div class="panel">
            <div class="panel-heading bg-primary">
                    <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion-styled" href="#accordion-styled-group11">Specification</a>
                    </h6>
            </div>
            <div id="accordion-styled-group11" class="panel-collapse collapse">
                    <div class="panel-body">
                        
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label  ">Specification </label>
                                    {!! Form::textarea(' ',null, ['class' => 'form-control','data-required'=>1,'rows' => 4, 'cols' => 5, 'style' => 'resize:none'])  !!} 
                                    <span class="help-block" style="color:red"> </span>
                                </div> 
                            </div> 
                        
                        <div class="col-md-12  " align="right"  > 
                            <button type="submit" class="btn btn-primary legitRipple ">
                                Submit
                                <i class="icon-next position-right"></i>
                            </button>
                        </div>
                        
                    </div>
            </div>
    </div> 
    <!--  // Specification-->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- accordion end --> 
</div>
 
<!-- 


    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
   
        <div class="row">
            
            
                  <div class="form-group col-md-6 "  >
                                            <label>Builder</label>
                                            <div class="input-group">
                                                    <input type="text" class="form-control" id="property_id" name="unique_property_id" placeholder="search by Property ID Ex.  BLS-10001">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default legitRipple" type="button" id="Search_by_id"><i class="glyphicon glyphicon-search"></i></button>
                                                    </span>

                                                </div>
                                                 <span  class="help-block"></span> 
                                        </div>
         <div class="col-md-4">
                    <div>
                        <img src="http://localhost/ok/public/images/properties/1538895217_889.jpeg" class="img-responsive"  />
                        <h3>Builder name</h3>  
                    </div>
                </div>
            
            
            
            
              <div class="col-md-6">
                <div class="form-group {{ $errors->first(' ', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Find Builder  ( builder id )</label>
                    
                        {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first(' ', ':message') }} @if(session('field_errors')) {{ ' ' }} @endif</span>
                     
                </div> 
            </div>
            
            
            
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('project_name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Project Name <span class="required"> * </span></label>
                    
                        {!! Form::text('project_name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('project_name', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                     
                </div> 
            </div>  


            <div class="col-md-6">
                <div class="form-group {{ $errors->first('type', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Type <span class="required"> * </span></label>
                        {!! Form::text('type',null, ['class' => 'form-control','data-required'=>1,'id'=>'type'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('type', ':message') }}  </span>
                </div> 
            </div>
 
 
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('category', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Category <span class="required"> * </span></label>
                        
                             <select class="  form-control"   name="status" id="status">
                                    <option value="select" >Select Status</option>
                                
                            </select>
                        <span class="help-block" style="color:red">{{ $errors->first('category', ':message') }}    </span>
                </div> 
            </div>

            
            
            
              <div class="col-md-6">
                <div class="form-group {{ $errors->first('category', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Category <span class="required"> * </span></label>
                        
                             <select class="  form-control"   name="status" id="status">
                                    <option value="select" >Select Status</option>
                                
                            </select>
                        <span class="help-block" style="color:red">{{ $errors->first('category', ':message') }}    </span>
                </div> 
            </div>
            
            
            
            
            
             <div class="col-md-12">
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

                 <a href="{{route('plan')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset > 

 <style type="text/css">
	.required-field{color:red;}
</style>
 
  
 
 
 
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 -->