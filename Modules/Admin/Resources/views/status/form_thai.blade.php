
      <p><b><span id="lang_in">In Thailand</span> </b></p>

       <div class="form-group {{ $errors->first('name_th', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
          <label class="control-label  ">Name <span class="required"> * </span></label>
              {!! Form::text('name_th' ,$status->name_th, ['class' => 'form-control','data-required'=>1,'placeholder'=>'example: 1000 Sqr Feet'])  !!} 
              
              <span class="help-block" style="color:red">{{ $errors->first('name_th', ':message') }} </span>
      </div>
 