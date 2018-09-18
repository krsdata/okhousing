@extends('admin::admin.master')
@section('title', "Admin Property List")
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

</style>
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/property_list')}}"><i class="icon-list position-left"></i>Property List</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/property_list')}}"><i class="icon-list position-left"></i>Property List</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Property List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create Property List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="property_list_create" autocomplete="off" >
				<div class="row">
					<!---Country-->
						<div class="form-group col-md-6" id="countrybox">
							<label>Country</label>
							<select class="bootstrap-select " data-width="100%"  name="countries" id="country_id" onchange="initMap()" >
								<option value="" >Select</option>
									@foreach($countries as $country)
										<option value="{{$country['id']}}" data-flag="{{$country['created_countries']['flag']}}">{{$country['created_countries']['name']}}</option>
									@endforeach
							</select>
							<span  class="help-block"></span> 
						</div>
						
						<!----/* Country---->
					
						<!--- Property Code-->
						<!-- <div class="form-group col-md-6" id="codebox">
							<label>Property Code</label>
								<input id="property_code" name="property_code" type="text" class="form-control" placeholder="Enter Property Code">
								<span  class="help-block"></span> 
						</div> -->
						<!---Property Name-->
						<div class="form-group col-md-6" id="namebox">
							<label>Property Name</label>
							<input id="property_name" name="property_name" type="text" class="form-control" placeholder="Enter Property Name">
							 <span  class="help-block"></span> 
						</div>
						<!----/* Property Name---->

				</div>

				<div class="row">
					
						<!--- Property Category-->
						<div class="form-group col-md-6" id="catbox">
							<label>Property Category</label>
								<select class="bootstrap-select" data-width="100%" name="category_id" id="property_category" >
									<option value="" >Select</option>
										@foreach($property_categories as $property_category)
											<option value="{{$property_category->id}}" >{{$property_category->name}}</option>
										@endforeach
								</select>
								<span  class="help-block"></span> 
						</div>
						<!---Property Type-->
						<div class="form-group col-md-6" id="typebox">
							<label>Property Type</label>
							<select class="bootstrap-select" data-width="100%" name="type_id" id="property_type">
								<option value="" >Select</option>
									@foreach($property_types as $property_type)
										<option value="{{$property_type->id}}" >{{$property_type->name}}</option>
									@endforeach
							</select>
							<span  class="help-block"></span> 
						</div>
						<!----/* Property Type---->
				</div>

				<div class="row">
					
						<!--- Prize-->
						<div class="form-group col-md-6" id="prizebox">
							<label>Prize</label>
								<input id="property_prize" name="prize" type="text" class="form-control" placeholder="Enter Property Prize">
								<span  class="help-block"></span> 
						</div>
						<!--- Status-->
						<div class="form-group col-md-6" id="statusbox">
							<label>Status</label>
								<select class="bootstrap-select" name="status" data-width="100%">
									<option value="1" selected >Active</option>
									<option value="2">Inactive</option>
								</select>
								<span  class="help-block"></span> 
						</div>
				</div>

				<div class="row">
					
					<!---User Name-->
						<div class="form-group col-md-6" id="userbox">
							<label>User</label>
							<select class="bootstrap-select" data-width="100%" name="user_id" id="user_name">
								<option value="" >Select</option>
								<?php foreach($users as $user){ ?>
									<option value="<?php echo $user->user_id; ?>" ><?php echo $user->created_users->email; ?></option>
								<?php } ?>	
							</select>
							 <span  class="help-block"></span> 
						</div>
						<!----/* User Name---->
						<!----/* lOCATION---->
						<div class="form-group col-md-6" id="locationbox">
							<label>Location</label>
							
							    <input id="pac-input" type="text" placeholder="Enter a location" class="form-control" name="location">

							<span  class="help-block"></span> 
						</div>
						

						<!----/* lOCATION		---->
						

				</div>
				<div class="row">
					<div class="form-group col-md-6" >
                            <label>Latitude</label>
                            <input id="lat" type="text" class="form-control" readonly  placeholder="Enter latitude"  name="lat">
                    </div>
					<div class="form-group col-md-6" >
                            <label>Longitude</label>
                            <input id="lng" type="text" class="form-control" readonly  placeholder="Enter longitude"  name="lng">
                     
					</div>
				</div>

				<div class="lang_section" ><div class="langtitle" style="display:none;"><legend class="text-bold ">Add Property Description</legend></div></div>

				<div class="row">
				<legend class="text-bold ">Property Details</legend>
					<!---Building Area-->
						<div class="form-group col-md-6" id="buildingbox">
							<label>Building Area</label>
							<input id="building_area" name="building_area" type="text" class="form-control" placeholder="Enter Building Area">
							<span  class="help-block"></span> 
						</div>
						<!----/* Building Area---->
						<!--- Building Unit-->
						<div class="form-group col-md-6" id="bunitbox">
							<label>Building Unit</label>
								<select class="bootstrap-select" name="building_unit" data-width="100%" id="building_unit">
									<option value="">Select</option>
									@foreach($buildingunits as $buildingunit)
										<option value="{{$buildingunit->id}}" >{{$buildingunit->unit}}</option>
									@endforeach
								</select>
								<span  class="help-block"></span> 
						</div>

				</div>

				<div class="row">
					<!---Land Area-->
						<div class="form-group col-md-6" id="landbox">
							<label>Land Area</label>
							<input id="land_area" name="land_area" type="text" class="form-control" placeholder="Enter Land Area ">
							<span  class="help-block"></span> 
						</div>
						<!----/* Land Area---->
						<!--- Land Unit-->
						<div class="form-group col-md-6" id="lunitbox">
							<label>Land Unit</label>
								<select class="bootstrap-select" name="land_unit" data-width="100%" id="land_unit">
									<option value="">Select</option>
									@foreach($landunits as $landunit)
										<option value="{{$landunit->id}}" >{{$landunit->land_unit}}</option>
									@endforeach
								</select>
								<span  class="help-block"></span> 
						</div>

				</div>

				<div class="row">
					<!---Bedroom-->
						<div class="form-group col-md-6" id="bedbox">
							<label>Bedroom</label>
							<input id="bed_room" name="bed_room" type="text" class="form-control" placeholder="Enter number of bedrooms">
							<span  class="help-block"></span> 
						</div>
						<!----/* Bedroom---->
						<!--- Bathroom-->
						<div class="form-group col-md-6" id="bathbox">
							<label>Bathroom</label>
								<input id="bath_room" name="bath_room" type="text" class="form-control" placeholder="Enter number of bathrooms">
								<span  class="help-block"></span> 
						</div>

				</div>

				<div class="row">
				<legend class="text-bold ">Select Amenities & Neighbourhood</legend>
					<!---Amenities-->
					<div class="row">
						<div class="form-group col-md-12" id="amenitybox" style="overflow-y: auto;border: 1px solid rgba(128,128,128,.25);margin-left: 28px;min-height: 200px;width: 972px;">
							<legend class="text-semibold">Select Amenities </legend>
							<span  class="help-block"></span> 
							@foreach($amineties as $aminety)
								<label class="checkboxa" style="padding-right: 15px;">
								    <input type="checkbox" class="checker border-success text-success-600  CheckboxStyle amenities" name="aminety[]" value="{{$aminety->id}}">
									{{$aminety->name}}
								</label>
							@endforeach
							
						</div>
					</div>
					<!---Neighbourhood-->
					<div class="row">
						<div class="form-group col-md-12"  style="overflow-y: auto;border: 1px solid rgba(128,128,128,.25);margin-left: 28px;min-height: 200px;width: 972px;">
							<legend class="text-semibold">Select Neighbourhood </legend>
							@foreach($neighbourhoods as $key=>$neighbourhood)
								<div class="form-group col-md-2" id="neighbourbox_{{$key+1}}">
									<label class="checkboxa" style="margin-top: 15px!important;">
									    <input type="checkbox" class="checker border-success text-success-600  CheckboxStyle neighbour" name="neighbourhood[]" value="{{$neighbourhood->id}}" id="neighbourhood_{{$key+1}}" data-id="{{$key+1}}">
										{{$neighbourhood->name}}
									</label>
										<input name="in_km[]" id="km_id_{{$key+1}}"  type="text" class="form-control" placeholder="Enter km" style="width: 123px!important;">
									<span  class="help-block"></span> 		 
								</div>
								
							@endforeach
							
						</div>
					</div>

				</div>
                <!---Featured Image-->
				<div class="row">
					<div class="form-group col-md-12">
						<legend class="text-bold ">Featured Image</legend>
							<div class="form-group col-md-6" id="fimagebox">
								<input name="images" type="file" class="file-styled-primary" id="property_image" />
									<span  class="help-block"></span>
							</div>
						<div id="featuredimage_preview"></div>
					</div>
				</div>
                <!---Gallery Image-->
				<div class="row">
					<div class="form-group col-md-12">
					<legend class="text-bold ">Gallery Image</legend>
						<div class="form-group col-md-6">
							<input id="gimage" type="file" value="" name="gimage[]" multiple class="file-styled-primary"/>
						</div>
					</div>
					<div id="image_preview"></div>
				</div>
				<!----Map--->

				<div style="width:2474px; height:400px;display:none;" id="mapsection">
                            <div id="map"  style="width: 40%; height: 100%"></div>
                </div>

				<!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="property_list_save" class="btn btn-primary legitRipple">Save Property<i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
           <!-- /* Form action -->
			</form>
		</div>
		
	</div>

@stop
  
  
  
@section('js')
   @section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Properties/Resources/assets/js/propertylistControles.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap"
        async defer></script>
		
   <!-- -->
@stop
  
