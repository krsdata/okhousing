@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];

$fcountry=Session::get('fcountry');

$countryId=$fcountry['created_country_id'];

@endphp


 <div id="home" class="tab-pane fade in active featured_slider2">

<?php 
                $i= 0; $FinalArray = $array =$FeaturedpropertyList=array();
                $propertyList = Modules\Admin\Entities\FeaturedProperties::where('category_id',$catId)->orWhere('category_id',$parent_id)->where('start','<',date('Y-m-d H:i:s'))->where('end','>',date('Y-m-d H:i:s'))->get();


                foreach ($propertyList as $featured) {
                    

                         $checkFetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$featured->property_id)->where('status',1)->first();

                            if(!is_null($checkFetchedproperty))
                            {

                                 $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$countryId)->first();


                                $Fetchedproperty= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$countryId)->where('property_id',$featured->property_id)->first();

                               
                                if($Fetchedproperty)
                                {
                                     $FeaturedpropertyList[] = $Fetchedproperty;
                                }

                            }


                    
                     

                }
                foreach($FeaturedpropertyList as $news)
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

               // dd($FinalArray);
                ?>

                        @foreach($FeaturedpropertyList as $property)
                     <div class="featured_slider_item">
                        <div class="container featured_container">
                            <div class="row">
                              
                                   @php


                                      $Fetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$property->property_id)->first();
                            

                                     $Type = Modules\Properties\Entities\PropertyCategory::with(['created_type' => function ($query) use ($Selected_lang)
                                        {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Fetchedproperty->category_id)->first();

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


                                      $building_area = Modules\Properties\Entities\BuildingUnits::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Fetchedproperty->building_unit_id)->first();


                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Fetchedproperty->id)->where('is_featured','1')->first();

                                     @endphp
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container" onclick="ShowProperty({{$Fetchedproperty->id}})">
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

                                   
                            </div>
                        </div>
                    </div>
                     @endforeach

         </div>
