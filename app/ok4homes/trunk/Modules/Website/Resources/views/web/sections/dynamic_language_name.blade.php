<li>
    @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
         <input type="hidden" name="name_language[]" value="{{$value['languages']['id']}}">
         <div class="input-field GnameBox" id="name_{{$value['languages']['id']}}">
            <input id="Gname" name="name_{{$value['languages']['id']}}" type="text" class="validate" >
            <label for="Gname">Name in {{$value['languages']['name']}}</label>
            <div class="val-error"></div>
        </div>
                                            
                              
       
       @endif
   @endforeach
 @endif   
</li>

