 @php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
@endphp
<?php

$Sections = Modules\Admin\Entities\Sections::where('title','Mobile app')->first();

if($Sections->status == 1) 
{


 $MobileApp= Modules\Admin\Entities\Mobileapp::where('language_id',$Selected_lang)->first();

if($MobileApp)
{

?>

<!--mobile app-->
 <section class="app-download">
        <div class="app-main">
            <div class="app-img-box">
                <img src="{{asset('public/images/phone1.png')}}">
                <img src="{{asset('public/images/Mobileapp/'.$MobileApp->image)}}" class="overImg">
            </div>
            <div class="app-contant-box">
                <h3>{{$MobileApp->title}}</h3>
                <p>{{$MobileApp->sub_title}}</p>
                <ul>
                    @if($MobileApp->appstore_status == 1)
                    <li><a href="{{$MobileApp->appstore_link}}"><img src="{{asset('public/images/Mobileapp/'.$MobileApp->appstore_image)}}" alt=""></a></li>
                    @endif
                    @if($MobileApp->googleplay_status == 1)
                    <li><a href="{{$MobileApp->googleplay_link}}"><img src="{{asset('public/images/Mobileapp/'.$MobileApp->googleplay_image)}}" alt=""></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
<!--/mobile app-->
<?php } } ?>
