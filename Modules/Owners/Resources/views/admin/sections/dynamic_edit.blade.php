<div class="row"> 
  @if(isset($nameArray))
    @foreach ($nameArray as $key => $value)
      
        
       <div class="form-group col-md-6 name{{$key}} chkname">
            <label>Name in {{$value['lang_name']}}</label>

            <input   type="hidden" value="{{$value['lang_id']}}" name="langages[]">
            <input   type="hidden" value="{{$value['id']}}" name="ids[]">
            <input   type="text" placeholder="Enter Name in {{$value['lang_name']}}" data-lagname="{{$key}}"  data-namelan="{{$value['country_lang_id']}}"  data-name_langcode="{{$value['lang_code']}}" class="form-control" name="name_{{$value['lang_id']}}" value="{{$value['user_name']}}">
            <span  class="help-block"></span> 
        </div>
       
       
      
   @endforeach
 @endif   
</div>


<div class="row"> 
    
  @if(isset($nameArray))
    @foreach ($nameArray as $key => $value)
  
        
       <div class="form-group col-md-6 about{{$key}} chkabout" >
            <label>About Us in {{$value['lang_name']}}</label>
            
            <textarea style="resize: none" rows="3" cols="5" data-lagabout="{{$value['lang_id']}}" data-aboutlan="{{$value['country_lang_id']}}" data-about_langcode="{{$value['lang_code']}}" class="form-control" placeholder="About Us in {{$value['lang_name']}}"  name="about_{{$value['lang_id']}}" >{{$value['user_about']}}</textarea>
            <span  class="help-block"></span> 
        </div>
       

   @endforeach
 @endif 
 
</div>
