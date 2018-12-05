             
@if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
       
       
       
       @endif
   @endforeach
 @endif

<div class="row"> 
    @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
       <div class="form-group col-md-6 name{{$key}} chkname">
            <label>Name in {{$value['languages']['name']}}</label>
            <input   type="text" placeholder="Enter Name in {{$value['languages']['name']}}" data-lagname="{{$key}}"  data-namelan="{{$value['languages']['id']}}"  data-name_langcode="{{$value['languages']['lang_code']}}" class="form-control" name="name[]">
            <span  class="help-block"></span> 
        </div>
       
       
       @endif
   @endforeach
 @endif   
</div>


<div class="row"> 
    
      @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
       <div class="form-group col-md-6 about{{$key}} chkabout" >
            <label>About Us in {{$value['languages']['name']}}</label>
            
            <textarea style="resize: none" rows="3" cols="5" data-lagabout="{{$key}}" data-aboutlan="{{$value['languages']['id']}}" data-about_langcode="{{$value['languages']['lang_code']}}" class="form-control" placeholder="About Us in {{$value['languages']['name']}}"  name="about[]" ></textarea>
            <span  class="help-block"></span> 
        </div>
       
       
       @endif
   @endforeach
 @endif 
 
</div>
