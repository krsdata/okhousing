
      <p><b><span id="lang_in">In Thailand</span> </b></p>

       <div class="form-group {{ $errors->first('name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
          <label class="control-label  ">Plan Name <span class="required"> * </span></label>
              {!! Form::text('name_'.$th ,null, ['class' => 'form-control','data-required'=>1,'placeholder'=>'example: Platinum, Gold or Diamond'])  !!} 
              
              <span class="help-block" style="color:red">{{ $errors->first('name', ':message') }} </span>
      </div>

     <div class="form-group {{ $errors->first('image_size', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
            <label class="control-label  ">Max image size allowed <span class="required"> * </span></label>
            
                {!! Form::text('image_size_'.$th,null, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'Example 10 MB'])  !!} 
                
        <span class="help-block" style="color:red">{{ $errors->first('image_size', ':message') }}  </span>
           
      </div> 


      <div class="form-group {{ $errors->first('price_in_thailand', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
            <label class="control-label  ">Price <span class="required"> * </span></label>
            
                {!! Form::text('price_in_thailand',null, ['class' => 'form-control','data-required'=>1,'Placeholder'=>'Price in thailand'])  !!} 
                
        <span class="help-block" style="color:red">{{ $errors->first('price_in_thailand', ':message') }}  </span>
           
      </div> 


        <div class="form-group {{ $errors->first('description', ' has-error') }}">
          <label class="control-label  "><u>Plan Features </u><span class="required"> </span></label>
           
              {!! Form::textarea('features_th',$plan->features_th??null, ['class' => 'form-control summernote','data-required'=>1,'rows'=>7,'cols'=>5])  !!} 
              
            <span class="help-block" style="color:#e73d4a">{{ $errors->first('features', ':message') }}</span>
           
      </div> 


       <div class="form-group  {{ $errors->first('plan_image', ' has-error') }}">
          <label class="control-label col-md-2"> Plan Image <span class="required"> * </span></label>
          <div class="col-lg-6">
              @if(isset($url_th))
               <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
          <img src=" {{ $url_th ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" style="width: 200px; height: 150px;"> </div>
          @endif
              <input type="file" class="file-input" name="plan_image_{{$th}}">
               <span class="help-block" style="color:#e73d4a">{{ $errors->first('plan_image', ':message') }}</span>
          </div>
      </div> 

   