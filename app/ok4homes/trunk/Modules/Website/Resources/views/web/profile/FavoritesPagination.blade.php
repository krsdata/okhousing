 @php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$Selected_countryId=$ffcountry_language['created_country_id'];


$fcountry=Session::get('fcountry');


$countryId=$fcountry['created_country_id'];

@endphp

@foreach($FvrtPropertyList as $pro)

                                 @php 

                                    $pro1 = Modules\Website\Entities\PropertyViewCount::where('property_id',$pro->id)->first();
                                        $count = $pro1->count;
                                         $count = (!empty($count))?$count:0;


                                     $Property = Modules\Properties\Entities\PropertyList::with('property_created_amenities','property_created_neighbourhoods')->where('id',$pro->property_id)->first();


                                    $property_details_cl = Modules\Countries\Entities\Countrylangs::where('language_id',$Selected_lang)->where('created_country_id',$Selected_countryId)->first();

                                     $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id',$property_details_cl->id)->where('country_id',$Selected_countryId)->where('property_id',$pro->property_id)->first();

                                    if(is_null($property_details))
                                    {
                                         $property_details= Modules\Properties\Entities\PropertyCountryLangs::where('language_id','1')->where('country_id','1')->where('property_id',$pro->id)->first();
                                     }

                                      $building_area = Modules\Properties\Entities\BuildingUnits::with(['types' => function ($query) use ($Selected_lang)
                                            {
                                            $query->where('language_id',$Selected_lang);

                                        }])->where('id',$Property->building_unit_id)->first();
                                     
                                    $image = Modules\Properties\Entities\PropertyImages::where('property_id',$Property->id)->where('is_featured','1')->first();

                                    @endphp
                                   

                                     <div class="col-lg-4 col-md-6 col-xs-12 property_container "id="Propert_fvt_{{$Property->id}}">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent"><span id="Count_pro_{{$Property->id}}">{{$count}}</span> Views</div>

                                               <img src="{{asset('public/images/properties/'.@$image->image)}}" alt="" class="img-responsive"    onclick="ShowPropertyPopup({{$Property->id}})"   onerror="this.src='{{asset('public/default-property.jpg')}}';" >
                                                <div class="property_deatil"  onclick="ShowPropertyPopup({{$Property->id}})"  >
                                                    <h4>{{ $property_details['title']}}</h4>
                                                    <span class="loaction">{{$Property->location}}</span>
                                                </div>

                                                <form method="POST" id="AddTowishlist_{{$Property->id}}" name="AddTowishlist_{{$Property->id}}">
                                                    @php  $status = 'active'; @endphp
                                                    <input type="hidden" name="property_id" value="{{$Property->id}}">

                                                   <input  type="hidden" id="AddTowishlist_status" value="{{ $status }}" />
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            
                                                        
                                                    <div class="right-btn">
                                                       
                                                       <a class="icon  {{@$status}}"  id="i_AddTowishlist_{{$Property->id}}" onclick="AddTowishlist('{{$Property->id}}','{{$status}}')" ><i class="fas fa-heart"></i></a>
                                                    </div>
                                                </form>

                                         
                                            </div>
                                            <div class="content_wrapper"  onclick="ShowPropertyPopup({{$Property->id}})"  >
                                               <h5><span>{{trans('countries::home/home.rupee')}}</span> {{$Property->prize}}/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>{{$Property->bedroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>{{$Property->bathroom}}</li>
                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>{{$Property->building_area}} {{ @$building_area->types[0]->unit}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
