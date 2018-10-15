

<?php if(!empty($user->created_builders[0])){ ?>
<div class="builders_section">
    <legend class="text-bold"></legend>
    <div class="row">
<!--    <div class="col-md-1"></div>-->
        <div class="panel-body"> 
            <div class="row">
                <!--Builder Name-->
                <div class="form-group col-md-6" id="buildernamebox">
                    <label>Builder Name <span class="required-field">*</span> </label>
                    <input  id="builder_name" name= "builder_name" type="text" class="form-control" placeholder="Enter Builder Name" value="{{$user->created_builders[0]['builder_name']}}">
                    <span  class="help-block"></span>
                </div>
                <!--/*Builder Name-->
                
                <!--Mobile Number-->
                <div class="form-group col-md-6" id="buildermbox">
                    <label>Mobile Number<span class="required-field">*</span></label>
                    <input  id="mobile_number" name= "mobile_number" type="text" class="form-control" placeholder="Enter Mobile Number" value="{{$user->created_builders[0]['mobile']}}">
                    <span  class="help-block"></span>
                </div>
                <!--/*Mobile Number-->
            </div>

            <div class="row">
            <!--Established Year-->
                <div class="form-group col-md-6" id="builderybox">
                    <label>Established Year<span class="required-field">*</span></label>
                    <input  id="builder_year" name= "builder_year" type="text" class="form-control " placeholder="Enter Year" value="{{$user->created_builders[0]['established_year']}}">
                    <span  class="help-block"></span>
                </div>
            <!--/*Established Year-->
            
            <!--Builder Logo-->
            <div class="form-group col-md-6" id="builderlbox">
                <label>Builder Logo<span class="required-field">*</span></label> 
                    <div class="media no-margin-top">
                        @if($user->created_builders[0]['builder_logo']!="")
                            <div style="float: right;padding-right: 143px;">
                                <a href="#"><img src="{{asset('public/images/builders/')}}/{{$user->created_builders[0]['builder_logo']}}" style="width: 58px; height: 58px; border-radius: 2px;" alt=""></a>
                            </div>
                        @endif
                        <div class="media-body">
                            <input name="builder_logo" type="file" class="file-styled-primary">
                        </div>

                    </div>


                
            </div>
            <!--/*Builder Logo-->
            </div>

            <div class="row">
            <!--Street Name-->
                <div class="form-group col-md-6" > 
                    <label>Street Name</label>
                    <input  id="street_name" name= "street_name" type="text" class="form-control" placeholder="Enter Street Name" value="{{$user->created_builders[0]['street_name']}}">
                </div>
            <!--/*Street Name-->
            
            <!--Pin Number-->
                <div class="form-group col-md-6" id="builderpinbox">
                    <label>Pin Number<span class="required-field">*</span></label>
                    <input  id="pin_number" name= "pin_number" type="text" class="form-control" placeholder="Enter Pin Number" value="{{$user->created_builders[0]['post_code']}}">
                    <span  class="help-block"></span>
                </div>
            <!--/*Pin Number-->
            </div>

            <div class="row">
                <!--Location-->
                <div class="form-group col-md-6">
                <label>Location</label>
                <input  id="location" name= "location" type="text" class="form-control" placeholder="Enter Builder Name" value="{{$user->created_builders[0]['location']}}">
                </div> 
                <!--/*Location-->
            </div>
        </div>
    </div>
</div> 
<?php } ?>
