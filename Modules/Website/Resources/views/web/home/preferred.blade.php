@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
@endphp

 <?php 

$Sections = Modules\Admin\Entities\Sections::where('title','What make us the Preferred choice')->first();

if($Sections->status == 1) 
{

 $whyWelist= Modules\Admin\Entities\whyWe::where('language_id',$Selected_lang)->get();
?>

  <!--Preferred-->

  @if($whyWelist)
    <section class="preferred-choice">
        <div class="container">
            <h3 class="orange-line">{{trans('countries::home/home.what_makes_us_the_preferred')}}
                <Choice></Choice>
            </h3>
            <div class="row mobileHidden">
                @foreach($whyWelist as $whyWe)
                <div class="col-sm-4 col-xs-12 xsmb15">
                    <img src="{{asset('public/images/whyWe/'.$whyWe->image)}}" class="img-responive">

                    <div class="lineBlock rightLine">
                        <span class="fa fa-check checkCircle @if($whyWe->section == 2) active @endif"></span>
                    </div>
                    <div class="dataWrap">
                       <h4 class="t1">{{$whyWe->title}}</h4>
                       <p>{{$whyWe->sub_title}}</p> 
                    </div>
                </div>

               @endforeach
            </div>

            <div class="row mobileVisible">
                <div class="PreferredSliderMob col-xs-12 ">
                    <div class="slider slider-nav">
                        @foreach($whyWelist as $whyWe)

                        <div class="col-sm-4 col-xs-12 xsmb15">
                            <img src="{{asset('public/images/whyWe/'.$whyWe->image)}}" class="img-responive">

                            <div class="lineBlock ">
                                <span class="fa fa-check checkCircle @if($whyWe->section == 2) active @endif"></span>
                            </div>
                            <div class="dataWrap">
                               <h4 class="t1">{{$whyWe->title}}</h4>
                               <p>{{$whyWe->sub_title}}</p> 
                            </div>
                        </div>

                        @endforeach
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
  <!--/Preferred-->

    @endif
  <?php } ?>
