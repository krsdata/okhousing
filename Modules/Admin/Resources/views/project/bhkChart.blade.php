 
@if(isset($bhk))
    <?php $total = count($bhk);
        $bh = array(1,2,3,4,5,6);
     ?>
    @foreach($bhk as $val)
    <?php 
        if (!in_array($val, $bh))
         continue; 
        ?>
        <div class="col-md-12">
            <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px">  </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="panel-title">{{$val}} BHK </h5> 
               <!--  <button type="button" class=" btn bg-indigo legitRipple pull-right" style="margin-top: -20px">
                    ADD More {{$val}} BHK  
                </button> --> 
                <br/>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label  ">Area <span class="required"> * </span></label>
                        {!! Form::text($val.'bhk_area',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div> 
                <div class="col-md-3">
                    <div class="form-group ">
                        <label class="control-label">Unit <span class="required"> * </span></label> 
                        {!!Form::select($val.'bhk_unit', $unit, null, ['class' => 'form-control'])!!}
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label  ">Price <span class="required"> * </span></label>
                        {!! Form::text($val.'bhk_price',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div> 
                <div class="col-md-3">
                    <div class="form-group ">
                        <label class="control-label  ">Display <span class="required"> * </span></label> 
                        <select class="form-control"   name="{{$val.'bhk_display'}}" id="{{$val.'bhk_display'}}">
                            <option value="select" >select</option> 
                            <option>yes</option> 
                            <option>no</option> 
                        </select>
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label ">2D Floor Plan </label>
                        {!! Form::file($val.'bhk_flats[2d_plan]',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label  ">3D Floor Plan </label>
                        {!! Form::file($val.'bhk_flats[3d_plan]',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label  ">Key Plan  </label>
                        {!! Form::file($val.'bhk_flats[key_plan]',null, ['class' => 'form-control btn btn-success','data-required'=>1])  !!} 
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div>  

                 <div class="col-md-4">
                    <div class="form-group">
                         <?php $code = $val."BHK".$total;  ?>
                       <button type="button" class="btn btn-primary" onclick="generateCode('{{$code}}','{{$val}}')"> Generate Code </button>


                      
                        {!! Form::text("generate_code_".$val,null, ['class' => 'form-control generate_code_'.$val])  !!} 
                        <span class="help-block" style="color:red"> </span>
                    </div> 
                </div>  
            </div>
           
        </div> 

    @endforeach

@endif


<!--  <div class="row">
    <div class="col-md-12 " >
        <h5 class="panel-title">1 BHK </h5>   
        <button type="button" class=" btn bg-danger legitRipple pull-right" style="margin-top: -20px">
            Remove 
        </button>
        <br/>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label  ">Area <span class="required"> * </span></label>
                {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div> 
        <div class="col-md-3">
            <div class="form-group ">
                <label class="control-label  ">Unit <span class="required"> * </span></label> 
                <select class="form-control"   name=" " id=" ">
                    <option value="select" >select</option> 
                </select>
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label  ">Price <span class="required"> * </span></label>
                {!! Form::text(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div> 
        <div class="col-md-3">
            <div class="form-group ">
                <label class="control-label  ">Display <span class="required"> * </span></label> 
                <select class="form-control"   name=" " id=" ">
                    <option value="select" >select</option> 
                    <option>yes</option> 
                    <option>no</option> 
                </select>
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div> 
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label  ">2D Floor Plan </label>
                {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div>  
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label  ">3D Floor Plan </label>
                {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div>  
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label  ">Key Plan  </label>
                {!! Form::file(' ',null, ['class' => 'form-control','data-required'=>1])  !!} 
                <span class="help-block" style="color:red"> </span>
            </div> 
        </div>  
    </div>
    <div class="col-md-12 " >
        <div style="height: 2px;width: 100%;background-color: #2196F3;margin-bottom: 20px;margin-top: 20px"></div>
    </div>
</div -->

