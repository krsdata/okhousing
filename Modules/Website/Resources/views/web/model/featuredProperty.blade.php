@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];

$fcountry=Session::get('fcountry');

$countryId=$fcountry['created_country_id'];


 $fcountry=Session::get('fcountry');
    $country_flag = $fcountry['flag'];


$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];


function money_format_1($money)
{

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
                $i= 0; $FinalArray = $array =$FeaturedpropertyList=array();
               //$propertyList = Modules\Admin\Entities\FeaturedProperties::where('category_id',$catId)->orWhere('category_id',$parent_id)->where('start','<',date('Y-m-d H:i:s'))->where('end','>',date('Y-m-d H:i:s'))->get();


                $propertyList = Modules\Admin\Entities\FeaturedProperties::where('start','<',date('Y-m-d H:i:s'))->where('end','>',date('Y-m-d H:i:s'))->where(function ($query) use ($parent_id,$catId) {
                        $query->where('category_id',$catId)->orWhere('category_id',$parent_id);
                    })->get();

                foreach ($propertyList as $featured) {
                    

                            $checkFetchedproperty = Modules\Properties\Entities\PropertyList::where('id',$featured->property_id)->where('status','Active')->first();

                            if(!is_null($checkFetchedproperty))
                            {

                                


                                    $Fetchedproperty= Modules\Properties\Entities\PropertyCountryLangs::where('country_id',$countryId)->where('property_id',$featured->property_id)->first();

                                   
                                    if($Fetchedproperty)
                                    {

                                       $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$countryId)->first();

                                        $Fetchedproperty= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$countryId)->where('property_id',$featured->property_id)->first();

                                         $FeaturedpropertyList[] = $Fetchedproperty;
                                    }

                            }

                        
                     

                }

               if($FeaturedpropertyList)
            {

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

        }

               // dd($FinalArray);
                ?>

                <?php if(count($FinalArray) > 1){ ?>
                    <div class="container slider_controls  desktop">
                        <a class="prevtab1" style="display: none;"><img src="{{asset('public/web/images/left.png')}}" alt=""></a>
                        <a class="nexttab1"><img src="{{asset('public/web/images/right.png')}}" alt=""></a>
                    </div>
                <?php } ?>
                     <div class="featuredSliderTab1">
                        @foreach($FinalArray as $propertys)
                    
                        <div class="featured_slider_item">
                            <div class="container featured_container">
                                  <div class="preLoad Noloader preLoad1"></div>

                                <div class="row">
                                     @foreach($propertys as $property)
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
                                        $selectedPropertyType =$selectedPropertyTypeId = array();
                                        foreach($PropertyType as $t)
                                        {
                                            $selectedPropertyType[] =$t->title;
                                            $selectedPropertyTypeId[] =$t->id;
                                        }

                                    
                                     
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
                                               <h5><span><?php if($country_flag == 'in'){ ?>
                                                    <span class="WebRupee">Rs.</span>
                                                <?php } else { ?>
                                                     <span>{{@$currency_symbol}}</span>
                                                <?php } ?></span> {{  money_format_1($Fetchedproperty->prize) }}/- <small><?php echo (in_array('3',$selectedPropertyTypeId) || in_array('4',$selectedPropertyTypeId))?trans('countries::home/home.featured_per_month'):''; ?></small></h5>

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

                                    @endforeach
                                </div>
                            </div>
                        </div>
                       @endforeach
                    </div>
