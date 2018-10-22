
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('builder_name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Builer Name <span class="required"> * </span></label>
                    
                        {!! Form::text('builder_name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('builder_name', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                     
                </div> 
            </div>


 
          

            <div class="col-md-6">
                <div class="form-group {{ $errors->first('mobile', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Mobile Number <span class="required"> * </span></label>
                        {!! Form::text('mobile',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('mobile', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->first('email', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Email <span class="required"> * </span></label>
                        {!! Form::text('email',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('email', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>



             <div class="col-md-6">
                <div class="form-group {{ $errors->first('country', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Country <span class="required"> * </span></label>
                        
                     <select class="  form-control"   name="country" id="country_id">
                        <option value="select" >Select</option>
                            @foreach($countries as $country)
                                <option value="{{$country['id']}}" data-flag="{{$country['created_countries']['flag']}}" @if(isset($builder->country) && $builder->country==$country['id']) selected @endif>{{$country['created_countries']['name']}}</option>
                            @endforeach
                        </select>
  <span class="help-block" style="color:red">{{ $errors->first('country', ':message') }} </span>
                </div> 
            </div>




            <div class="col-md-6">
                <div class="form-group {{ $errors->first('location', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Location <span class="required"> * </span></label>
                        {!! Form::text('location',null, ['class' => 'form-control','data-required'=>1,'id'=>'location','onkeyup'=>'initMap()'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('location', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->first('latitude', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Latitude <span class="required"> * </span></label>
                        {!! Form::text('latitude',null, ['class' => 'form-control','data-required'=>1,'id'=>'latitude'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('latitude', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

             <div class="col-md-6">
                <div class="form-group {{ $errors->first('longitude', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Longitude <span class="required"> * </span></label>
                        {!! Form::text('longitude',null, ['class' => 'form-control','data-required'=>1,'id'=>'longitude'])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('longitude', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->first('street_name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Street name <span class="required"> * </span></label>
                        {!! Form::text('street_name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('street_name', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

              <div class="col-md-6">
                <div class="form-group {{ $errors->first('post_code', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Post code <span class="required"> * </span></label>
                        {!! Form::text('post_code',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('post_code', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>

             <div class="col-md-6">
                <div class="form-group {{ $errors->first('established_year', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Established year <span class="required"> * </span></label>
                        {!! Form::text('established_year',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red">{{ $errors->first('established_year', ':message') }} @if(session('field_errors')) {{ 'The Name  already been taken!' }} @endif</span>
                </div> 
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('status', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Status <span class="required"> * </span></label>
                        
                             <select class="  form-control"   name="status" id="status">
                                    <option value="select" >Select Status</option>
                                
                                    <option value="1"  @if(isset($builder->status) && $builder->status==1) selected @endif>Active </option>
                                    <option value="2"  @if(isset($builder->status) && $builder->status==2) selected @endif>InActive </option>
                                
                            </select>
                        <span class="help-block" style="color:red">{{ $errors->first('status', ':message') }}    </span>
                </div> 
            </div>



            <div class="col-md-12">
                <div class="form-group  {{ $errors->first('builder_logo', ' has-error') }}">
                    <label class="control-label col-md-3"> Builder logo<span class="required"> * </span></label>
                    <div class="col-lg-9">
                        @if(isset($builder->builder_logo))
                         <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                   <a href="{{url($builder->builder_logo)}}" target="_blank"> <img src=" {{ url($builder->builder_logo) ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;"> </a> </div>
                    @endif
                        <input type="file" class="file-input" name="builder_logo" class="form-control">
                         <span class="help-block" style="color:#e73d4a">{{ $errors->first('builder_logo', ':message') }}</span>
                    </div>
                </div>
            </div>  


            <div class="col-md-12">
                <div class="form-group  {{ $errors->first('builder_cover_picture', ' has-error') }}">
                    <label class="control-label col-md-3"> Builder cover picture <span class="required"> * </span></label>
                    <div class="col-md-9">
                        @if(isset($builder->builder_cover_picture))
                         <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <a href="{{url($builder->builder_cover_picture)}}" target="_blank">  <img src=" {{ url($builder->builder_cover_picture) ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;"> </a> </div>
                    @endif
                        <input type="file" class="file-input" name="builder_cover_picture" class="form-control">
                         <span class="help-block" style="color:#e73d4a">{{ $errors->first('builder_cover_picture', ':message') }}</span>
                    </div>
                </div>
            </div>  

                
             <div class="col-md-12">
                <div class="form-group  {{ $errors->first('profile_picture', ' has-error') }}">
                    <label class="control-label col-md-3"> Profile Picture <span class="required"> * </span></label>
                    <div class="col-lg-9">
                        @if(isset($builder->profile_picture))
                         <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <a href="{{url($builder->profile_picture)}}" target="_blank">  <img src="{{ url($builder->profile_picture) ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;">  </a></div>
                    @endif
                     
                        <input type="file" class="file-input" name="profile_picture" class="form-control">
                         <span class="help-block" style="color:#e73d4a">{{ $errors->first('profile_picture', ':message') }}</span>
                    </div>
                </div>
            </div>  

 
             <div class="col-md-12">
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

                 <a href="{{route('builder')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset > 

 <style type="text/css">
	.required-field{color:red;}
</style>
 