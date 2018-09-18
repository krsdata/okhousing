 @php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];

$fcountry=Session::get('fcountry');
$countryId=$fcountry['created_country_id'];

@endphp
<?php 
$Sections = Modules\Admin\Entities\Sections::where('title','News & updates')->first();

if($Sections->status == 1) 
{

$NewsUpdates= Modules\Admin\Entities\NewsUpdates::where('language_id',$Selected_lang)->where('country_id',$countryId)->orderby('updated_at','DESC')->get();

$i= 0; $FinalArray = $array =array();
foreach($NewsUpdates as $news)
{

    if($i == 0 || count($array) < 2)
    {
        $array[] = $news;
        $i++;
    }
    if(count($array) == 2)
    {
        $FinalArray[] = $array;
        $i = 0;
        $array = array();
    }
}
if(count($array) > 0)
{ $FinalArray[] = $array; }

?>


<!--News & Updates-->
@if($FinalArray)
    <section class="news-update desktop">
        <h3 class="green-line">{{trans('countries::home/home.news_updates')}}</h3>
        <div class="news-slide">
            @foreach($FinalArray as $array)
            <div class="item-main">
                <div class="item container">
                    <div class="row">
                        @foreach($array as $news)
                        <div class="item-box col-sm-6">
                             <div class="img-box" style="background-image: url({{asset('public/images/NewsUpdates/'.$news->image)}});"></div>
                            <div class="contant-box">
                                <span><?php echo date_format($news->updated_at,"M - d - Y");?></span>
                                <h4>{{$news->title}}</h4>
                                <p><?php if(strlen($news->content) > 200 ) echo substr($news->content, 0, 200).' ...'; else echo $news->content; ?></p>
                               <!--a href="#" class="link"><img src="{{asset('public/web/images/right-arrow.png')}}"></a-->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <a class="prev-3"><img src="{{asset('public/web/images/left.png')}}" alt=""></a>
        <a class="next-3"><img src="{{asset('public/web/images/right.png')}}" alt=""></a>
        <!--div class="text-center">
            <a href="#" class="viewall">View all</a>
        </div-->
    </section>

     <section class="news-update mobile">
        <h3 class="green-line">{{trans('countries::home/home.news_updates')}}</h3>
        <div class="news-slide1">
            @foreach($NewsUpdates as $news)
            <div class="item-main">
                <div class="item container">
                    <div class="row">
                      
                        <div class="item-box col-sm-6">
                             <div class="img-box" style="background-image: url({{asset('public/images/NewsUpdates/'.$news->image)}});"></div>
                            <div class="contant-box">
                                <img class="slick-slideimg" src="{{asset('public/images/NewsUpdates/'.$news->image)}}">
                                <span><?php echo date_format($news->updated_at,"M - d - Y");?></span>
                                <h4>{{$news->title}}</h4>
                                <p><?php if(strlen($news->content) > 200 ) echo substr($news->content, 0, 200).' ...'; else echo $news->content; ?></p>
                              
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        @endforeach
        </div>
       
    </section>
@endif  
<style type="text/css">
    .slick-slideimg {
    width: 100%;
     border-radius: 8px 8px 0 0;
}
@media (max-width: 767px){
.slick-slideimg {
    
    border-radius: 8px 8px 0 0;
}
.news-update .news-slide .item-main .item .item-box .contant-box
{
border-radius: 0 0 8px 8px;
}
}
</style>
<?php } ?>
