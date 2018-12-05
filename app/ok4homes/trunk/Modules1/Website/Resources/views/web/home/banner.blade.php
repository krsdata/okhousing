@php
$fcountry_lang=Session::get('fcountry_lang');
@endphp
<input type="hidden" name="is_home" value="1"/>
<!--banner and search-->
<section class="banner_section" id="container">

    <div class="banner_image">
        <!-- {{asset('public/web/images/slider-1.jpg')}}-->
        <img src="" alt="" id="Background_banner_image"class="img-responsive">
    </div>

    <div class="search_wrapper">
       
	    <h2>{{trans('countries::home/home.banner_text')}}</h2>
	  
        <ul class="search_nav">
			<li><a href="#">{{trans('countries::home/home.banner_buy')}}</a></li>
			<li><a href="#">{{trans('countries::home/home.banner_rent/lease')}}</a></li>
			<li><a href="#">{{trans('countries::home/home.banner_sell_property')}}</a></li>
			<li><a href="#">{{trans('countries::home/home.banner_unique_id_search')}}</a></li>
		<!--
            <li class="active"><a href="">Buy</a></li>
            <li><a href="">Rent/Lease</a></li>
            <li><a href="">Sell Property</a></li>
            <li><a href="">Uniue ID Search</a></li>-->
        </ul>

        <div class="moileVisible">
            <div class="row">
                <div class="col-xs-6">
                    <select>
                        <option value="1">Buy </option>
                        <option value="2">Rent/Lease </option>
                        <option value="3">Sell Property </option>
                        <option value="4">Uniue ID Search </option>
                    </select>
                </div>
                <div class="col-xs-6">
                    <select>
                        <option value="" disabled selected>Category</option>
                        <option value="1">Residential Apartment </option>
                        <option value="2">Independent/Builder Floor </option>
                        <option value="3">Independent House/Villa </option>
                        <option value="4">Residential Land  </option>
                        <option value="5">Studio Apartment </option>
                        <option value="6">Farm House  </option>
                        <option value="7">Serviced Apartments</option>
                        <option value="8">Other </option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form_wrapper">

        
        <div class="input-field input_category input_wrapper">
            <select>
                <option value="" disabled selected>{{trans('countries::home/home.banner_category')}}</option>
                <option value="1">{{trans('countries::home/home.residential_apartment')}}</option>
                <option value="2">{{trans('countries::home/home.independent_floor/builder')}} </option>
                <option value="3">{{trans('countries::home/home.independent_house/villa')}} </option>
                <option value="3">{{trans('countries::home/home.residential_land')}} </option>
                <option value="3">{{trans('countries::home/home.studio_apartment')}} </option>
                <option value="3">{{trans('countries::home/home.farmhouse')}} </option>
                <option value="3">{{trans('countries::home/home.serviced_apartments')}}</option>
                <option value="3">{{trans('countries::home/home.other')}} </option>
            </select>
       </div>

        <div class="input-field input_wrapper location_input">
        <input placeholder="{{trans('countries::home/home.banner_location/tower/landmark')}}" id="first_name" type="text" class="validate">
        </div>

        <div class="search_btn input_wrapper">
        <a href="#">{{trans('countries::home/home.search')}}</a>
        </div>

        <div class="map_search_btn input_wrapper">
        <a href="#">Search</a>
        </div>

        </div>

    </div>

    <!--banner ads-->
    <div class="outer_wrapper">
    <div class="mesh_wrapper">
    
   

    
    </div>
    <!--/banner ads-->


</section>
<!--/banner and search-->

  <input type="hidden" id="hidden_active_div" value="">
