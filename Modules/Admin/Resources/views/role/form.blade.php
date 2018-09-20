
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group {{ $errors->first('name', ' has-error') }}">
                    <label>Name: <span class="text-danger">*</span></label>
                    
                     {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                      <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->first('role_type', ' has-error') }}">
                    <label>Role Type: <span class="text-danger">*</span></label> 
                     
                        {!!  Form::select('role_type', 
                             ['0'=>'developer','1'=>'admin','2'=>'user'], 
                             null,['class' => 'form-control']) 
                        !!}


                      <span class="help-block">{{ $errors->first('role_type', ':message') }}</span>
                </div>
            </div>


             <div class="col-md-12">
                <div class="form-group {{ $errors->first('description', ' has-error') }}">
                    <label>Description: <span class="text-danger">*</span></label> 
                     {!! Form::text('description',null, ['class' => 'form-control required' ,'data-required'=>1])  !!} 
                      <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                </div>
            </div>

 

             <div class="col-md-12">
                
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}


                <a href="{{route('role')}}">
                    {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset >