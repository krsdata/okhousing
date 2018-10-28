
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
          <div class="col-md-12">
             <div class="form-group col-md-6 {{ $errors->first('country', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Country Name  <span class="required"> * </span></label>
                        
                        <select name="country" class="form-control" onchange="changeCountry(this.value)">
                          <option value="">Select Country</option>
                          @foreach($country as $key => $result)
                          <option value="{{$result->id}}" @if(old("country")==$result->id) selected="" @endif  @if(isset($plan->country) && $plan->country==$result->id) selected="" @endif>
                            {{$result->name}}
                          </option>
                          @endforeach
                        </select>
                        
                        <span class="help-block" style="color:red">{{ $errors->first('country', ':message') }}    </span>
                </div>
          </div>
          <div class="col-md-6" class="lang_india">

                
                <p><b><span id="lang_in">In English</span> </b></p>

                 <div class="form-group {{ $errors->first('name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Plan Name <span class="required"> * </span></label>
                        {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1,'placeholder'=>'example: Platinum, Gold or Diamond'])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('name', ':message') }} </span>
                </div>

                 <div class="form-group {{ $errors->first('image_size', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Max image size allowed <span class="required"> * </span></label>
                    
                        {!! Form::text('image_size',null, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'Example 10 MB'])  !!} 
                        
                <span class="help-block" style="color:red">{{ $errors->first('image_size', ':message') }}  </span>
                     
                </div> 

            <div class="form-group {{ $errors->first('price_in_india', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                  <label class="control-label  ">Price <span class="required"> * </span></label>
                  
                      {!! Form::text('price_in_india',null, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'Price'])  !!} 
                      
              <span class="help-block" style="color:red">{{ $errors->first('price_in_india', ':message') }}  </span>
                 
            </div> 

 

                  <div class="form-group {{ $errors->first('description', ' has-error') }}">
                    <label class="control-label  "><u>Plan Features </u><span class="required"> </span></label>
                     
                        {!! Form::textarea('features',null, ['class' => 'form-control summernote','data-required'=>1,'rows'=>7,'cols'=>5])  !!} 
                        
                      <span class="help-block" style="color:#e73d4a">{{ $errors->first('features', ':message') }}</span>
                     
                </div> 

         

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
            
            <div class="col-md-6" id="lang_thailand" @if(old("country")==43) style="display: none" @endif  @if(isset($plan->country) && $plan->country==43) style="display: none" @endif>
              {!! $thai_html !!}
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