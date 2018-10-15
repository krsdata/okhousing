    @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))

        <div class="input-field" id="aboutus_{{$value['languages']['id']}}">
          <textarea id="about" name="aboutus_{{$value['languages']['id']}}" type="text" class="validate"></textarea>
          <label for="about">{{trans('countries::home/home.about_us_eng')}} {{trans('countries::home/home.'.$value['languages']['name'])}}</label>
          <div class="val-error"></div>
        </div>
                                            
                              
       
       @endif
   @endforeach
 @endif   


