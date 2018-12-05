<li>
    @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
         <input type="hidden" name="name_language[]" value="{{$value['languages']['id']}}">
         <div class="input-field GnameBox thi_name" id="name_{{$value['languages']['id']}}">
            <input id="Gname{{$value['languages']['id']}}" name="name_{{$value['languages']['id']}}" type="text" class="validate" >
            <label for="Gname">{{trans('countries::home/home.name_in_eng')}} {{trans('countries::home/home.'.$value['languages']['name'])}}</label>
            <div class="val-error"></div>
        </div>
                                            
                              
       
       @endif
   @endforeach
 @endif   
</li>

