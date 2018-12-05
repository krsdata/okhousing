<?php 
   use Modules\Admin\Entities\Metropolian;  
   
 $fcountry=Session::get('fcountry');
$countryId=$fcountry['created_country_id'];
$Sections = Modules\Admin\Entities\Sections::where('title','Recent List Properties')->first();

if($Sections->status == 1) 
{


     $Metropolian=Metropolian::select('cities','Images','lat','lang','id')->where('status','1')->where('country_id',$countryId)->get();

  ?>
   @if(!empty($Metropolian))   
    <section class="gallery">
        <h3 class="green-line">{{trans('countries::home/home.recent_list_prop')}}</h3>
        <div class="container">
             <div class="gallery-img">
                <div class="grid-1">
                   
                  @php $metro =  $Metropolian[0];
                  @endphp
                  <div class="view view-1"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">
                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                    @php $metro =  $Metropolian[1];
                  @endphp
                  <div class="view view-2"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>


                   @php $metro =  $Metropolian[2];
                  @endphp
                  <div class="view view-3"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>


                   @php $metro =  $Metropolian[3];
                  @endphp
                  <div class="view view-4"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>


                   @php $metro =  $Metropolian[4];
                  @endphp
                  <div class="view view-5"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>

                </div>
                <div class="grid-2">
                    @php $metro =  $Metropolian[5];
                  @endphp
                  <div class="view view-1"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                    @php $metro =  $Metropolian[6];
                  @endphp
                  <div class="view view-2"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                </div>
                <div class="grid-3">
                    @php $metro =  $Metropolian[7];
                  @endphp
                  <div class="view view-3"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                     @php $metro =  $Metropolian[8];
                  @endphp
                  <div class="view view-1"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                    @php $metro =  $Metropolian[9];
                  @endphp
                  <div class="view view-2"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                    <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                    @php $metro =  $Metropolian[10];
                  @endphp
                  <div class="view view-3"  onclick="SearchByCity('Search_form_{{ trim($metro['id'])}}')">

                    <a href="javascript::vois(0);" title="{{  $metro->cities }}">
                    <form method="GET" id="Search_form_{{ trim($metro['id'])}}" name="Search_form_{{ trim($metro['id'])}}" action="{{URL('/search/filter')}}">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="lat" name="lat" value="{{ trim($metro['lat'])}}">
                    <input type="hidden" name="MetropolianId" value="{{ trim($metro['id'])}}">
                     <input type="hidden" name="cities" value="{{  $metro->cities }}">
                    
                     <input type="hidden" name="Metropolian" value="1">
                    <input type="hidden" name="lang" name="lang" value="{{ trim($metro['lang'])}}">
                    </form>
                    <img src="{{ URL::asset('public/images/Metropolian/'.$metro->Images) }}">
                    <span>{{  $metro->cities }}</span>
                  </a>
                  </div>
                </div>

            </div>
        </div>
    </section>
  <script type="text/javascript">
      
      function SearchByCity(id)
      {
        $("#"+id).submit();
      }
    </script>
    @endif

    <?php } ?>
 
