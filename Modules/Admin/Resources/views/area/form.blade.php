
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
          <div class="col-md-12">
             <div class="form-group col-md-6 {{ $errors->first('country', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Country Name  <span class="required"> * </span></label>
                        
                        <select name="country" class="form-control" onchange="changeCountry(this.value)">
                          <option value="">Select Country</option>
                          @foreach($country as $key => $result)
                          <option value="{{$result->id}}" @if(old("country")==$result->id) selected="" @endif  @if(isset($area->country) && $area->country==$result->id) selected="" @endif>
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
                    <label class="control-label  ">Name <span class="required"> * </span></label>
                        {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1,'placeholder'=>'example: 1000 Sqr Feet'])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('name', ':message') }} </span>
                </div>

                 <div class="form-group {{ $errors->first('unit', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">unit <span class="required"> * </span></label>
                    
                      {!!Form::select('unit', $project_units, null, ['class' => 'form-control'])!!}

                        
                <span class="help-block" style="color:red">{{ $errors->first('unit', ':message') }}  </span>
                     
                </div> 
          
            </div>
            
            <div class="col-md-6" id="lang_thailand" @if(old("country")==43) style="display: none" @endif  @if(isset($area->country) && $area->country==43) style="display: none" @endif>
              {!! $thai_html !!}
            </div>
 
             <div class="col-md-12">
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

                 <a href="{{route('area')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset > 