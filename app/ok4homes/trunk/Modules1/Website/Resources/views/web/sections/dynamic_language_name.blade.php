<li>
    @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
        <div class="input-field GnameBox">
            <input id="Gname" name="Gname" type="text" class="validate" >
            <label for="Gname">Name in {{$value['languages']['name']}}</label>
            <div class="val-error"></div>
        </div>
                                            
                              
       
       @endif
   @endforeach
 @endif   
</li>

