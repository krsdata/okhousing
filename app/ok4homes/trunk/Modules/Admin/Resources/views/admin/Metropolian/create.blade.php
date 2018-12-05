@extends('admin::admin.master')
@section('title', "Admin Metropolian  List")
@section('css')
<style>
#featuredimage_preview {
width: 80px;
height: 80px;
background-position: center center;
background-size: cover;
-webkit-box-shadow: 0 0 0px 0px rgba(0, 0, 0, .3);
display: inline-block;
}
#mapsection{
	display: none  !important;
}

</style>
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('metropoloancity')}}"><i class="icon-list position-left"></i>Metropolian  List</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('metropoloancity')}}"><i class="icon-list position-left"></i>Metropolian  List</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Metropolian  List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

    </div>
@stop
@section('content') 
    <div class="panel panel-flat">
        <div class="showalert">
            @if(Session::has('val')) 
                @if(Session::get('val')==0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right:14px;">×</button>
                        <h4><i class="icon fa fa-ban"> Alert!</i></h4> 
                        {{Session::get('msg')}}
                    </div>
                @endif
       
            @endif
        </div>

         <div class="panel-heading">
            <h5 class="panel-title">Create Metropolian cities<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        	 <form action="{{URL('/metropoloancity/store')}}" enctype="multipart/form-data" id="metropolian_list_create" autocomplete="off" method="POST" >

        	 	<input name="_token" type="hidden" value="{{ csrf_token() }}" >
				<div class="row">
					<!---Country-->
					<!-- <?php echo "<pre>"; print_r($countries ); echo "</pre>"; ?> -->
						<div class="form-group col-md-6" id="countrybox">
							<label>Country</label>
							
							<input type="hidden" value="{{$countries['id']}}" name="countries" id="country_id" countryid onload="initMap()" data-flag="{{$countries['created_countries']['flag']}}">


							<input type="text" class="form-control" value="{{$countries['created_countries']['name']}}" readonly="true" >

							<span  class="help-block"></span> 
						</div>
						<input type="hidden" name="Maincountryid" value="" id="Maincountryid">
	
					
				</div>

				<input id="metro_city_lat" type="hidden"  name="metro_city_lat">
				<input id="metro_city_lang" type="hidden"  name="metro_city_lang">
				
				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="1" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							 <p>Note : Image size shoulde be 180px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input1" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="2" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							 <p>Note : Image size shoulde be 420px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input2" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>



				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="3" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 600px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input3" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="4" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 360px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input4" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>


				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="5" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 240px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input5" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>


				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="6" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 240px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input6" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="7" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 240px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input7" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="8" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 360px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input8" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="9" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 108px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input9" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="10" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 272px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input10" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>

				<div class="row">
						<div class="form-group col-md-4" id="statusbox">
							<label>Position</label>
							<input type="text" placeholder="Enter a location" class="form-control" name="position[]" value="11" readonly="true">
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<legend class="text-bold ">Featured Image</legend>
							<input name="images[]" type="file" class="file-styled-primary" id="property_image" required="true" />
							<p>Note : Image size shoulde be 360px x 178px </p>
						</div>

						<div class="form-group col-md-4" id="statusbox">
							<label>City</label>
							<input id="pac-input11" type="text" placeholder="Enter a location" class="form-control" name="location[]" required="true">
						</div>

				</div>






			 	<div style="width:2474px; height:400px" id="mapsection">
                            <div id="map"  style="width: 40%; height: 100%"></div>
                </div> 


				<!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="property_list_save" class="btn btn-primary legitRipple">Save Cities<i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
           <!-- /* Form action -->
			</form>
						

				</div>

        </div>
		
	</div>

@stop
  
  
  
@section('js')
   @section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/MetropolianlistController.js')}}"></script>	
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap"
        async defer></script>
		
   <!-- -->

  <script type="text/javascript">
  	
  	$(document).ready(function(){

  		initMap();
  	})
  </script>
@stop
