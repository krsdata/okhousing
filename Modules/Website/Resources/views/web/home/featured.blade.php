@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];



$fcountry=Session::get('fcountry');
$country_flag = $fcountry['flag'];
$countryId=$fcountry['created_country_id'];


$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];
$country_flag = $fcountry['flag'];

 function money_format_fe($money){

    $fcountry=Session::get('fcountry');
    $country_flag = $fcountry['flag'];


    if($country_flag == 'in')
    {
        $len = strlen($money);
        $m = '';
        $money = strrev($money);
        for($i=0;$i<$len;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$len){
                $m .=',';
            }
            $m .=$money[$i];
        }
         return strrev($m);
    }
    else
    {
        return number_format($money);
    }
    
   
}

@endphp
<?php

$Sections = Modules\Admin\Entities\Sections::where('title','Featured Properties')->first();

if($Sections->status == 1) 
{

$languages= Modules\Countries\Entities\Countrylangs::with('languages')->where('created_country_id',$countryId)->orderBy('id', 'ASC')->get()->pluck("language_id");

    $SQL = "SELECT * FROM ok4_property_category WHERE is_featured  = 1 ";
    if(count($languages) > 1)
    {
        $SQL .=" AND ( language_id = '".$languages[0] ."'";


        for($i=1 ; $i< count($languages); $i++)
        {
            $SQL .=" OR language_id = '".$languages[$i] ."'";
        }

        $SQL .=")";
    }
    elseif(count($languages) == 1)
    {
        $SQL .=" AND  language_id = '".$languages[0] ."'";
    }

    $SQL .=" AND  deleted_at IS NULL";
    $PropertyCategory = DB::select($SQL);

//dd($PropertyCategory);


//$PropertyCategory= Modules\Properties\Entities\PropertyCategory::with('created_type')->where('is_featured',1)->where('language_id',$Selected_lang)->where('status',1)->orderBy('id', 'DESC')->get();

$LoopFeaturedPro = $propertyList= array();
$getfrom =0;
if($PropertyCategory)
{


                $i= 0; $FinalArray = $array =$FeaturedpropertyList=array();
                foreach($PropertyCategory as $key=>$fc)
                {
                    $catId = $fc->id;

                    //$propertyList = Modules\Admin\Entities\FeaturedProperties::where('category_id',$fc->id)->orWhere('category_id',$fc->parent_id)->where('start','<',date('Y-m-d H:i:s'))->where('end','>',date('Y-m-d H:i:s'))->get();

                    $propertyList = Modules\Admin\Entities\FeaturedProperties::where('start','<',date('Y-m-d H:i:s'))->where('end','>',date('Y-m-d H:i:s'))->where(function ($query) use ($fc) {
                        $query->where('category_id',$fc->id)->orWhere('category_id',$fc->parent_id);
                    })->get();

                   
                 // dd($propertyList);

                    if(count($propertyList) > 0)
                    {
                        $FeaturedpropertyList[$catId]=array();
                        foreach ($propertyList as $featured) {
                    
                            $checkFetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$featured->property_id)->where('status','Active')->first();

                            if(!is_null($checkFetchedproperty))
                            {

                                $Fetchedproperty= Modules\Properties\Entities\PropertyCountryLangs::where('country_id',$countryId)->where('property_id',$featured->property_id)->first();

                               
                                if($Fetchedproperty)
                                {
                                     $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$countryId)->first();


                                    $Fetchedproperty= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$countryId)->where('property_id',$featured->property_id)->first();


                                     $FeaturedpropertyList[$catId][] = $Fetchedproperty;
                                }

                            }
                            
                        }

                        if(count($FeaturedpropertyList[$catId]) < 1 )
                        {
                            unset($PropertyCategory[$key]);
                            unset($FeaturedpropertyList[$catId]);
                        }

                    }
                    else
                    {
                        unset($PropertyCategory[$key]);
                       
                    }

                }
           if(count($FeaturedpropertyList) > 0)
           {
            foreach($FeaturedpropertyList[key($FeaturedpropertyList)]  as $news)
                {

                    if($i == 0 || count($array) < 6)
                    {
                        $array[] = $news;
                        $i++;
                    }
                    if(count($array) == 6)
                    {
                        $FinalArray[] = $array;
                        $i = 0;
                        $array = array();
                    }
                }
                if(count($array) > 0)
                { $FinalArray[] = $array; }

           }

          // dd($PropertyCategory);
                 ?>

            
@if(count($PropertyCategory)> 0)
  <section class="featured_properties">
        <div class="container">
            <div class="row">
                <div class="col-md-12 heading_wrapper">
                    <h3>{{trans('countries::home/home.featured_properties')}}</h3>
                </div>
            </div>
        </div>

        
        <div class="tab-control">
            <div class="tab-button-main container">
                <ul class="nav nav-tabs tab-title-slide">
                    @php $c =1; @endphp
                    @foreach($PropertyCategory as $category)
                    @if($category->language_id == $Selected_lang)
                        <li class="@if($c==1)active @endif FeaCat_{{$category->id}}"><a data-toggle="tab" href="#featured" data-id="{{$category->id}}"class="FeaturedPropertyEvent">{{$category->name}}</a></li>
                    @else
                        @php 
                        $othercat = Modules\Properties\Entities\PropertyCategory::where("language_id",$Selected_lang)->where("id",$category->parent_id)->first(); @endphp
                        <li class="@if($c==1)active @endif FeaCat_{{$category->id}}"><a data-toggle="tab" href="#featured" data-id="{{$category->id}}"class="FeaturedPropertyEvent">{{$othercat->name}}</a></li>

                    @endif

                    @php $c++; @endphp
                    @endforeach
                    
                </ul>
               <?php if(count($PropertyCategory) > 4){ ?>
                <div class="slider_controls-2 desktop">
                    <a class="prev-tab-title"><img src="{{asset('public/web/images/tab-left.svg')}}" alt=""></a>
                    <a class="next-tab-title"><img src="{{asset('public/web/images/tab-right.svg')}}" alt=""></a>
                </div>
                <?php } ?>
            </div>
            <div class="tab-content desktop">

               
                <div id="featured-1" class="tab-pane fade in active">
                    <?php if(count($FinalArray) > 1){ ?>
                        <div class="container slider_controls  desktop">
                            <a class="prevtab1" style="display:none;"><img src="{{asset('public/web/images/left.png')}}" alt=""></a>
                            <a class="nexttab1"><img src="{{asset('public/web/images/right.png')}}" alt=""></a>
                        </div>
                     <?php } ?>
                     <div class="featuredSliderTab1">
                        
                     @foreach($FinalArray as $propertys)
                    
                        <div class="featured_slider_item">
                            <div class="container featured_container">
                                 <div class="preLoad Noloader"></div>

                                <div class="row">
                                     @foreach($propertys as $property)
                                    @php

                                    $Fetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$property->property_id)->first();
                            

                                     
                                     if(!empty($property))
                                     {

                                        $TypeList = $Fetchedproperty->mastercategory_id;
                                        $TypeListArray = explode(",",$TypeList);
                                        if(count($TypeListArray) > 1)
                                        {
                                             $PropertyType1 = Modules\Admin\Entities\CategoryType::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                                $query->where('language_id',$Selected_lang);

                                            }])->where('id',$TypeListArray[0]);

                                            for($i=1 ; $i< count($TypeListArray); $i++)
                                            {
                                                 $PropertyType1->orWhere('id',$TypeListArray[$i]);
                                            }

                                            $PropertyType =  $PropertyType1->get();


                                        }
                                        elseif(count($TypeListArray) == 1)
                                        {
                                           $PropertyType = Modules\Admin\Entities\CategoryType::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                                $query->where('language_id',$Selected_lang);

                                            }])->where('id',$TypeListArray[0])->get();
                                        }

                                        $selectedPropertyType =$selectedPropertyTypeId = array();
                                        foreach($PropertyType as $t)
                                        {
                                            $selectedPropertyType[] =$t->title;
                                            $selectedPropertyTypeId[] =$t->id;
                                        }
                                      
                                         $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Fetchedproperty->category_id)->first();

                                  
                                    

                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Fetchedproperty->id)->where('is_featured','1')->first();

                                     @endphp
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container"  onclick="ShowProperty({{$property->property_id}})">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">{{ implode(" , ",$selectedPropertyType)}}</div>
                                                <img src="{{asset('public/images/properties/'.@$image->image)}}"  onerror="this.src='{{asset('public/default-property.jpg')}}';"   alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>{{ $property->title}}</h4>
                                                    <span class="loaction">{{ $Fetchedproperty->location}}</span>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                              <h5>
                                                <?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?>
                                                {{  money_format_fe($Fetchedproperty->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

                                                 <div class="quick_detail_list">
                                                    <ul>
                                                         @if($Fetchedproperty-> bedroom_show == 1)
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{$Fetchedproperty->bedroom}}</li>
                                                        @endif
                                                        @if($Fetchedproperty->bathroom_show == 1)
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{$Fetchedproperty->bathroom}}</li>
                                                        @endif
                                                        @if($Fetchedproperty->bulding_area_show == 1)
                                                        @php
                                                            $building_area = Modules\Properties\Entities\BuildingUnits::where('language_id',$Selected_lang)->where(function ($query) use ($Fetchedproperty) {
                                                            $query->where('id',$Fetchedproperty->building_unit_id)->orWhere('parent_id',$Fetchedproperty->building_unit_id);
                                                            })->first();

                                                        $area = $Fetchedproperty->building_area;
                                                        $unit = @$building_area->unit;

                                                        @endphp
                                                        @elseif($Fetchedproperty->landarea_show == 1)
                                                        @php
                                                        
                                                        $building_area = Modules\Properties\Entities\LandUnits::where('language_id',$Selected_lang)->where(function ($query) use ($Fetchedproperty) {
                                                            $query->where('id',$Fetchedproperty->land_unit_id)->orWhere('parent_id',$Fetchedproperty->land_unit_id);
                                                            })->first();

                                                        $area = $Fetchedproperty->land_area;
                                                        $unit = @$building_area->land_unit;
                                                        @endphp

                                                        @endif

                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{@$area}} {{ @$unit}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>



            </div>

            <div class="tab-content mobile" id="Mobiledata">
                <div id="home" class="tab-pane fade in active featured_slider2">
                     @foreach($FeaturedpropertyList[key($FeaturedpropertyList)] as $property)
                    
                     <div class="featured_slider_item">
                        <div class="container featured_container">
                            <div class="row">
                              
                                     @php
                                       if(!empty($property))
                                     {

                                        $Fetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$property->property_id)->first();
                            

                                     $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$property->category_id)->first();

                                    $PropertyType = Modules\Properties\Entities\PropertyType::with(['types' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$property->type_id)->first();


                                    $building_area = Modules\Properties\Entities\LandUnits::with(['types' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$property->building_unit_id)->first();
                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$property->id)->where('is_featured','1')->first();

                                     @endphp
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container"  onclick="ShowProperty({{$Fetchedproperty->id}})">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">{{ @$Type->created_type->title}}</div>
                                                <img src="{{asset('public/images/properties/'.@$image->image)}}"  onerror="this.src='{{asset('public/default-property.jpg')}}';"   alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>{{ $property->title}}</h4>
                                                    <span class="loaction">{{ $Fetchedproperty->location}}</span>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                               <h5><?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?> {{  money_format_fe($Fetchedproperty->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{ $Fetchedproperty->bedroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{ $Fetchedproperty->bathroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{ $Fetchedproperty->building_area}} {{ @$building_area->land_unit}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                   
                            </div>
                        </div>
                    </div>
                     @endforeach

                </div>
            </div>

          
         </div>   
    </section>

    <script type="text/javascript">
         var slider1 = $('.featuredSliderTab1').slick({
                centerMode: true,
                infinite: true,
                centerPadding: '150px',
                slidesToShow: 1,
                prevArrow: $('.prevtab1'),
                nextArrow: $('.nexttab1'),
                speed: 900
            });


        $('.prevtab1').attr('style',"display:none !important");
     
      slider1.on('afterChange', function(event, slick, currentSlide) {      
                           //If we're on the first slide hide the Previous button and show the Next
        if (currentSlide === 0) {
          $('.prevtab1').attr('style',"display:none !important");
          $('.nexttab1').attr('style',"display:block !important");
        }
       else if (slick.slideCount === currentSlide + 1) {
             $('.nexttab1').attr('style',"display:none !important");
            $('.prevtab1').attr('style',"display:block !important");
        }
         else {
            $('.prevtab1').attr('style',"display:block");
            $('.nexttab1').attr('style',"display:block");
        }
        
        //If we're on the last slide hide the Next button.
        
      });

    </script>
    @endif

    <?php } } ?>

    <script type="text/javascript">
        
$('.FeaturedPropertyEvent').click(function(e) {
   e.preventDefault();
   var id = $(this).data('id');
    $(".slick-slide").removeClass("active");
    $(".FeaCat_"+id).addClass("active");
    $(".preLoad").removeClass( "Noloader" );
    $(".preLoad").addClass( "addloader" );
   $.ajax({
                    type: "GET",
                    url: base_url+"/featuredProperty/"+id, 
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){

                        $("#featured-1").html(response.html);
                        $("#Mobiledata").html(response.mobilehtml);
                        
                         var slider1 = $('.featuredSliderTab1').slick({
                                centerMode: true,
                                infinite: true,
                                centerPadding: '150px',
                                slidesToShow: 1,
                                prevArrow: $('.prevtab1'),
                                nextArrow: $('.nexttab1'),
                                speed: 900
                            });

                         $('.prevtab1').attr('style',"display:none !important");
     
  
                          slider1.on('afterChange', function(event, slick, currentSlide) {      
                             //If we're on the first slide hide the Previous button and show the Next
                                if (currentSlide === 0) {
                                  $('.prevtab1').attr('style',"display:none !important");
                                  $('.nexttab1').attr('style',"display:block !important");
                                }
                               else if (slick.slideCount === currentSlide + 1) {
                                     $('.nexttab1').attr('style',"display:none !important");
                                    $('.prevtab1').attr('style',"display:block !important");
                                }
                                 else {
                                    $('.prevtab1').attr('style',"display:block");
                                    $('.nexttab1').attr('style',"display:block");
                                }
                                                 
                             });

                           $('.featured_slider2').slick({
                                centerMode: true,
                                centerPadding: '50px',
                                slidesToShow: 1,
                                infinite: true,

                            });

                        }
                        $(".preLoad").addClass( "Noloader" );
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                                $(".preLoad").addClass( "Noloader" );

                    }
                   
                });
});

    </script>
    <style type="text/css">
        
        body {
    background: #fff !important;
}
.featured_properties .tab-content .slick-active .container {
    position: relative;
}
    </style>
