
      <p><b><span id="lang_in">In Thailand</span> </b></p>

       <div class="form-group {{ $errors->first('name_th', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
          <label class="control-label  ">Name <span class="required"> * </span></label>
              {!! Form::text('name_th' ,$neighborhood->name_th, ['class' => 'form-control','data-required'=>1,'placeholder'=>'example: Church, Temple or School'])  !!} 
              
              <span class="help-block" style="color:red">{{ $errors->first('name_th', ':message') }} </span>
      </div>

     <div class="form-group {{ $errors->first('distance_th', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
            <label class="control-label">Distance(KM)<span class="required"> * </span></label>
            
                {!! Form::text('distance_th',$neighborhood->distance_th, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'1 KM'])  !!} 
                
        <span class="help-block" style="color:red">{{ $errors->first('distance_th', ':message') }}  </span>
           
      </div>  

       <div class="form-group  {{ $errors->first('icon_th', ' has-error') }}">
            <label class="control-label col-md-2"> Icon <span class="required"> * </span></label>
            <div class="col-lg-6">
                @if(isset($url_th))
                 <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src=" {{ $url_th ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;"> </div>
            @endif
                <input type="file" class="file-input" name="icon_th">
                 <span class="help-block" style="color:#e73d4a">{{ $errors->first('icon_th', ':message') }}</span>
            </div>
        </div>  

   