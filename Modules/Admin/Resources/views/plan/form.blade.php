
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Plan Name <span class="required"> * </span></label>
                    
                        {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('name', ':message') }} @if(session('field_errors')) {{ 'The Name name already been taken!' }} @endif</span>
                     
                </div> 
            </div>

             <div class="col-md-6">
                <div class="form-group {{ $errors->first('image_size', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Max image size allowed <span class="required"> * </span></label>
                    
                        {!! Form::text('image_size',null, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'Example 10 MB'])  !!} 
                        
                <span class="help-block" style="color:red">{{ $errors->first('image_size', ':message') }}  </span>
                     
                </div> 
            </div>
             <div class="col-md-6">
                <div class="form-group  {{ $errors->first('plan_image', ' has-error') }}">
                    <label class="control-label col-md-2"> Plan Image <span class="required"> * </span></label>
                    <div class="col-lg-6">
                        @if(isset($url))
                         <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src=" {{ $url ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;"> </div>
                    @endif
                        <input type="file" class="file-input" name="plan_image">
                         <span class="help-block" style="color:#e73d4a">{{ $errors->first('plan_image', ':message') }}</span>
                    </div>
                </div>
            </div>  
 

             <div class="col-md-12" style="margin-top: 30px">
               
                <div class="form-group {{ $errors->first('description', ' has-error') }}">
                    <label class="control-label  "><u>Plan Features </u><span class="required"> </span></label>
                     
                        {!! Form::textarea('features',null, ['class' => 'form-control summernote','data-required'=>1,'rows'=>3,'cols'=>5])  !!} 
                        
                      <span class="help-block" style="color:#e73d4a">{{ $errors->first('features', ':message') }}</span>
                     
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