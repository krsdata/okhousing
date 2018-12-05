    <a href="javascript:void(0)" class="dropdown-toggle language" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        {{$countryDefualtLanguage['languages']['name']}} 
        @if (isset($countryLanguages))
            @if (!$countryLanguages->isEmpty()) 
            <span class="caret caret_custom"></span>
            @endif 
        @endif
        
    </a>
@if (isset($countryLanguages))
    @if (!$countryLanguages->isEmpty())  
        <ul class="dropdown-menu">
            
            @foreach($countryLanguages as $lang)

            	@if(Illuminate\Support\Arr::exists($lang, 'languages'))   
                    <li data-lang="{{$lang['languages']['lang_code']}}" ><a href="javascript:void(0)" >{{$lang['languages']['name']}}</a></li>
                @endif 
                                  
            @endforeach 
        </ul>                      
    @endif 
@endif
