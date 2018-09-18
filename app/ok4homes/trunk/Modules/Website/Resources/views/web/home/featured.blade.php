@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];

$fcountry=Session::get('fcountry');

$countryId=$fcountry['created_country_id'];

@endphp
<?php

$Sections = Modules\Admin\Entities\Sections::where('title','Featured Properties')->first();

if($Sections->status == 1) 
{


$PropertyCategory= Modules\Properties\Entities\PropertyCategory::with('created_type')->where('is_featured',1)->where('language_id',$Selected_lang)->where('status',1)->orderBy('id', 'DESC')->get();



$LoopFeaturedPro = $propertyList= array();
$getfrom =0;
if($PropertyCategory)
{


                $i= 0; $FinalArray = $array =$FeaturedpropertyList=array();
                foreach($PropertyCategory as $key=>$fc)
                {
                    $catId = ($fc->parent_id == null)?$fc->id:$fc->parent_id;

                    $propertyList = Modules\Admin\Entities\FeaturedProperties::where('category_id',$fc->id)->orWhere('category_id',$fc->parent_id)->where('start','<',date('Y-m-d H:i:s'))->where('end','>',date('Y-m-d H:i:s'))->get();

                   
                  //  echo"<pre>"; print_r($propertyList);

                    if(count($propertyList) > 0)
                    {
                        $FeaturedpropertyList[$catId]=array();
                        foreach ($propertyList as $featured) {
                    
                            $checkFetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$featured->property_id)->where('status',1)->first();

                            if(!is_null($checkFetchedproperty))
                            {

                                $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$countryId)->first();


                                $Fetchedproperty= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$countryId)->where('property_id',$featured->property_id)->first();

                               
                                if($Fetchedproperty)
                                {
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
                   
                        <li class="@if($c==1)active @endif FeaCat_{{$category['id']}}"><a data-toggle="tab" href="#featured" data-id="{{$category['id']}}"class="FeaturedPropertyEvent">{{$category['name']}}</a></li>
                    @php $c++; @endphp
                    @endforeach
                    
                </ul>
               <?php if(count($PropertyCategory) > 3){ ?>
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
                            <a class="prevtab1"><img src="{{asset('public/web/images/left.png')}}" alt=""></a>
                            <a class="nexttab1"><img src="{{asset('public/web/images/right.png')}}" alt=""></a>
                        </div>
                     <?php } ?>
                     <div class="featuredSliderTab1">
                        
                     @foreach($FinalArray as $propertys)
                    
                        <div class="featured_slider_item">
                            <div class="container featured_container">
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
                                        $selectedPropertyType =array();
                                        foreach($PropertyType as $t)
                                        {
                                            $selectedPropertyType[] =$t->title;
                                        }
                                      
                                         $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Fetchedproperty->category_id)->first();

                                  
                                     $building_area = Modules\Properties\Entities\BuildingUnits::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Fetchedproperty->building_unit_id)->first();



                                     
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
                                              <h5><span>{{trans('countries::home/home.rupee')}}</span> {{ $Fetchedproperty->prize}}/- <small>{{trans('countries::home/home.featured_per_month')}}</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{ $Fetchedproperty->bedroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{ $Fetchedproperty->bathroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{ $Fetchedproperty->building_area}} {{ (count($building_area->types)> 0)?$building_area->types[0]->unit:$building_area->unit}}</li>
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
                                               <h5><span>{{trans('countries::home/home.rupee')}}</span> {{ $Fetchedproperty->prize}}/- <small>{{trans('countries::home/home.featured_per_month')}}</small></h5>

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
         $('.featuredSliderTab1').slick({
                centerMode: true,
                infinite: true,
                centerPadding: '150px',
                slidesToShow: 1,
                prevArrow: $('.prevtab1'),
                nextArrow: $('.nexttab1'),
                speed: 900
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
                        
                         $('.featuredSliderTab1').slick({
                                centerMode: true,
                                infinite: true,
                                centerPadding: '150px',
                                slidesToShow: 1,
                                prevArrow: $('.prevtab1'),
                                nextArrow: $('.nexttab1'),
                                speed: 900
                            });

                           $('.featured_slider2').slick({
                                centerMode: true,
                                centerPadding: '50px',
                                slidesToShow: 1,
                                infinite: true,

                            });

                        }
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                               

                    }
                   
                });
});

    </script>
    <style type="text/css">
        
        body {
    background: #fff !important;
}

    </style>
