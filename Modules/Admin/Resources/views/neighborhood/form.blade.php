
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
          <div class="col-md-12">
             <div class="form-group col-md-6 {{ $errors->first('country', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Country Name  <span class="required"> * </span></label>
                        
                        <select name="country" class="form-control" onchange="changeCountry(this.value)">
                          <option value="">Select Country</option>
                          @foreach($country as $key => $result)
                          <option value="{{$result->id}}" @if(old("country")==$result->id) selected="" @endif  @if(isset($neighborhood->country) && $neighborhood->country==$result->id) selected="" @endif>
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
                        {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1,'placeholder'=>'example: Church, Temple or School'])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('name', ':message') }} </span>
                </div>

                 <div class="form-group {{ $errors->first('distance', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label  ">Distance(KM) <span class="required"> * </span></label>
                    
                        {!! Form::text('distance',null, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'1 KM'])  !!} 
                        
                <span class="help-block" style="color:red">{{ $errors->first('distance', ':message') }}  </span>
                     
                </div> 

                <div class="form-group  {{ $errors->first('icon', ' has-error') }}">
                  <label class="control-label col-md-2"> Icon <span class="required"> * </span></label>
                  <div class="col-lg-6">
                      @if(isset($url))
                       <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img src=" {{ $url ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;"> </div>
                  @endif
                      <input type="file" class="file-input" name="icon">
                       <span class="help-block" style="color:#e73d4a">{{ $errors->first('icon', ':message') }}</span>
                  </div>
              </div>  

          
            </div>
            
            <div class="col-md-6" id="lang_thailand" @if(old("country")==43) style="display: none" @endif  @if(isset($neighborhood->country) && $neighborhood->country==43) style="display: none" @endif>
              {!! $thai_html !!}
            </div>
 
             <div class="col-md-12">
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

                 <a href="{{route('neighborhood')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset > 