@php
$fcountry_lang=Session::get('fcountry_lang');
@endphp
<!--our directories-->
<section class="our-dir">
     <div class="container width75 directiory-box">
    <div class="dir-main">
    <div class="dir-items one">
    <div class="contant">
    <img src="{{asset('public/web/images/builder.png')}}">
    <span class="spn-1">{{trans('countries::home/home.builder_directory_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup> {{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items two">
    <div class="contant">
	<a href="ok4/agents_lsting">
    <img src="{{asset('public/web/images/agent.png')}}">
    <span class="spn-1">{{trans('countries::home/home.agent_directory_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup> {{trans('countries::home/home.listing')}}</span>
	</a>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items two">
    <div class="contant">
    <img src="{{asset('public/web/images/utility.png')}}">
    <span class="spn-1">{{trans('countries::home/home.utility_directory_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup> {{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items three">
    <div class="contant">
    <img src="{{asset('public/web/images/home.png')}}">
    <span class="spn-1">{{trans('countries::home/home.home_interiors_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup> {{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    <div class="dir-main">
    <div class="dir-items one">
    <div class="contant">
    <img src="{{asset('public/web/images/home.png')}}">
    <span class="spn-1">{{trans('countries::home/home.home_stay_listings')}}</span>
    <span class="spn-2">1000<sup>+</sup>{{trans('countries::home/home.listing')}}</span>
    </div>
    <div class="bg"></div>
    </div>
    </div>
    </div>
   
    
</section>

<!--/our directories-->
