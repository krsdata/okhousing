    @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))

        <div class="input-field">
          <textarea id="about" name="about" type="text" class="validate"></textarea>
          <label for="about">About Us {{$value['languages']['name']}}</label>
          <div class="val-error"></div>
        </div>
                                            
                              
       
       @endif
   @endforeach
 @endif   


