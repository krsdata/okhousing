 
<a href="javascript:void(0)" class="dropdown-toggle country" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <span class="flag">
    <img src="{{asset('public/admin/images/flags/'.$userCountry->flag.'.png' )}}" alt="" class="img-responive">
    </span>
    {{strtoupper($userCountry->flag)}}
    <span class="caret caret_custom"></span>
</a>

@if (!$AllCountry->isEmpty())  
<ul class="dropdown-menu">
    @foreach($AllCountry as $country)
    
        @if(Illuminate\Support\Arr::exists($country, 'created_countries'))
        
        
            <li data-lang="{{$country['created_countries']['flag']}}"><a href="javascript:void(0)" >{{$country['created_countries']['name']}}</a></li>  
        
        
        @endif 
        
    @endforeach
    </ul>
@endif
