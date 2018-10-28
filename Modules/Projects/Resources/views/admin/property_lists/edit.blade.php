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

.property_categorychanged
{
	width: 100%;
    padding: 8px;
    border: none;
    border-bottom: 1px solid #d2cdcd;
 }
 .labelstyle {display:block;}

</style>
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/property_list')}}"><i class="icon-list position-left"></i>Property List</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/property_list')}}"><i class="icon-list position-left"></i>Property List</a></li>
            <li class="active">Edit</li>
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
            <h5 class="panel-title">Edit Property List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="property_list_update" autocomplete="off" data-id="{{$property_lists->id}}">
				<div class="row">
					<!---User Name-->
						<div class="form-group col-md-6" id="userbox">
							<label>User</label>
							<?php  use Illuminate\Support\Arr;
								 $selecteduser[] = $property_lists->user_id; 

								  ?>
							<select class="bootstrap-select" data-width="100%" name="user_id" id="user_name">
								<option value="" >Select</option>

									@foreach($users as $user)
									<?php if( Arr::exists($user, 'created_users') )
							        { ?>
										<option value="{{$user['user_id']}}" @if(in_array($user['user_id'],$selecteduser)) selected @endif>{{$user['created_users']['email']}}</option>
									<?php } ?>
								    @endforeach
							</select>
							 <span  class="help-block"></span> 
						</div>
						<!----/* User Name---->
						<!--- Property Code-->
						<div class="form-group col-md-6" id="codebox">
							<label>Property Code</label>
								<input id="property_code" name="property_code" type="text" readonly class="form-control" placeholder="Enter Property Code"  value="{{$property_lists->uid}}">
								<span  class="help-block"></span> 
						</div>
				</div>
<input type="hidden" name="bulding_area_show" id="bulding_area_show" value="{{$property_lists->bulding_area_show}}">
<input type="hidden" name="landarea_show" id="landarea_show" value="{{$property_lists->landarea_show}}">
<input type="hidden" name="bedroom_show" id="bedroom_show" value="{{$property_lists->bedroom_show}}">
<input type="hidden" name="bathroom_show" id="bathroom_show" value="{{$property_lists->bathroom_show}}">


				<div class="row">
					
					<div class="form-group col-md-6" id="statusbox">
							<label>Status</label>
								<select class="bootstrap-select" name="status" data-width="100%">
									<option value='Active' {{($property_lists->status=='Active')?'selected':''}}  >Active</option>
									<option value='Inactive' {{($property_lists->status=='Inactive')?'selected':''}}>Inactive</option>
								</select>
								<span  class="help-block"></span> 
						</div>
						
                  <!---Property Type-->
						<div class="form-group col-md-6" id="typebox">
							<label >Property Type</label>

							<?php $selectedtype[] = $property_lists->type_id; 
							 $Propert_type=explode(',', $property_lists->type_id);
						
						//print_r($Propert_type);
							?>


							<select class="bootstrap-select" data-width="100%" name="type_id[]" id="property_type"  multiple="multiple">
								<option value="" >Select</option>
									@if($CategoryType)
                                                   @foreach($CategoryType as $row)
                                                        <option value="{{ $row['id'] }}" @if(in_array($row['id'],$Propert_type) || in_array($row['parent_id'],$Propert_type)) selected @endif >{{ $row['title'] }}</option>
                                                    @endforeach
                                                @endif
							</select>
							<span  class="help-block"></span> 
						</div>

				</div>

				<div class="row">

					<!--- Property Category-->

						
						<div class="form-group col-md-6" id="catbox">
							<label class="labelstyle">Property Category</label>
								<select class="browser-default property_categorychanged" data-width="100%" name="category_id" id="property_category" >
									<option value="" >Select</option>
									<?php $selectedcat = $property_lists->pluck('category_id')->toArray(); ?>
										<?php 

										if($property_lists->countries !== '1')
									        {
									            $category = Modules\Properties\Entities\PropertyCategory::where('id', $property_lists->category_id )->first();
									           	$selectedtype[] = $category->parent_id; 

									            $selectedtype[] = $property_lists->category_id;

									        }
									        else
									        {
									            $selectedtype[] = $property_lists->category_id;
									        }

										 ?>

                                      @foreach ($property_categoriesedit as $key => $category)  
                                       
                                            <option value="{{ $category_op_id = ($category->parent_id == '')?$category->id:$category->parent_id}}" @if(in_array($category_op_id,$selectedtype)) selected @endif data-bathroom_show="{{$category->bathroom_show}}" data-bedroom_show="{{$category->bedroom_show}}" data-bulding_area_show="{{$category->bulding_area_show}}" data-landarea_show="{{$category->landarea_show}}">{{$category->name}}</option>


                                    
                                         @endforeach




								</select>
								<span  class="help-block"></span> 
						</div>
					
						<!----/* Property Type---->
						<!--- Prize-->
						<div class="form-group col-md-6" id="prizebox">
							<label>Prize</label>
								<input id="property_prize" name="prize" type="text" class="form-control" placeholder="Enter Property Prize" value="{{$property_lists->prize}}">
								<span  class="help-block"></span> 
						</div>
				</div>

				<div class="row">
					<!---Country-->
						<div class="form-group col-md-6" id="countrybox">
							<label>Country</label>
							<select class="bootstrap-select " data-width="100%" name="countries" id="country_id" onchange="initMap()" >
								<option value="" >Select</option>
								<?php $selectedcountry = $langugeDetails->pluck('country_id')->toArray(); ?>
									@foreach($countries as $country)
										<option value="{{$country['id']}}" @if(in_array($country->id,$selectedcountry)) selected @endif data-flag="{{$country['created_countries']['flag']}}">{{$country['created_countries']['name']}}</option>
									@endforeach
							</select>
							<span  class="help-block"></span> 
						</div>
						<!----/* Country---->
						<!--location-->
						<div class="form-group col-md-6" id="locationbox">
							<label>Location</label>
							
							    <input id="pac-input" type="text" placeholder="Enter a location" class="form-control" name="location" value="{{$property_lists->location}}" >

							</div>
							<span  class="help-block"></span> 
						
						  <div class="form-group col-md-6" id="locationbox">
                        <div class="form-group col-md-4" >
                            <label>Latitude</label>
                            <input id="lat" type="text" class="form-control" readonly  placeholder="Enter latitude"  name="lat">
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Longitude</label>
                            <input id="lng" type="text" class="form-control" readonly  placeholder="Enter longitude"  name="lng">
                        </div>
                    </div>
						<!--/* Location-->
						<!--- Status-->
						<div class="row">
						

				</div>

					@if($langugeDetails)
									<div class="lang_section" >
										<div class="langtitle" >
										<legend class="text-bold ">Add Property Description</legend>
											@foreach($langugeDetails as $key=> $language)

											<?php $property_details_language = Modules\Countries\Entities\Alllanguages::where('id',$language->pro_languages->language_id)->first(); ?>

											<div class="row">

									<input type="hidden" name="desc_country_{{$language->id}}" value="{{$language->country_id}}">

                                    <input type="hidden" name="desc_language_{{$language->id}}" value="{{$language->language_id}}">

                                    <input type="hidden" name="country_language_{{$language->id}}" value="{{$language->id}}">

                                    <input type="hidden" name="created_language_{{$language['id']}}" value="{{$language->language_created_id}}">
                                    
                                    <input type="hidden" name="created_country_{{$language['id']}}" value="{{$language->country_created_id}}">


                                    <input type="hidden" name="desc_language[]" value="{{$language->id}}">


												<div class="langrow">
													<div class="form-group col-md-6">
														 <label for="property_title">Title in {{$property_details_language->name}}</label>
														<input id="title_{{$language->id}}" name="title_{{$language->id}}" type="text" class="validate form-control"  value="{{$language->title}}" required>
                                       

														<input type="hidden" id="language_id_{{$key+1}}" name="hidlang[]"  value="{{$language->created_languages->id}}" >	
													</div>
												<div class="form-group col-md-6 ">
													<label>Description in {{$property_details_language->name}}</label>
													<textarea rows="5" cols="5" class="form-control" placeholder="Property Description"  name="desc_{{$language->id}}" id= "description_{{$key+1}}" >{{$language->description}}</textarea>
												</div>
												</div>
											</div>
											@endforeach
										</div>
									</div>
									@endif
									

				<div class="row">
				<legend class="text-bold ">Property Details</legend>
						<!---Building Area-->
						<div class="form-group col-md-6 bulding_area_show @if($property_lists->bulding_area_show == 0) {{'hide'}} @endif" id="buildingbox">
							<label>Building Area</label>
							<input id="building_area" name="building_area" type="text" class="form-control" placeholder="Enter Building Area" value="{{$property_lists->building_area}}">
							<span  class="help-block"></span> 
						</div>
						<!----/* Building Area---->
						<!--- Building Unit-->

						<?php $selectedbunit[] = $property_lists->building_unit_id;
						 ?>

						<div class="form-group col-md-6 bulding_area_show @if($property_lists->bulding_area_show == 0) {{ 'hide'}} @endif " id="bunitbox">
							<label>Building Unit</label>
								<select class="bootstrap-select" name="building_unit" data-width="100%" id="building_unit">
									<option value="">Select</option>
									
									@foreach($buildingunits as $buildingunit)

									<?php if(! in_array($buildingunit->id,$selectedbunit) && ! in_array($buildingunit->parent_id,$selectedbunit))
                                      {
                                         $sel = Modules\Properties\Entities\BuildingUnits::where("parent_id",$buildingunit->id)->first();

                                        $sel_id = @$sel->id;

                                         if(in_array($sel_id,$selectedbunit))
                                          {
                                             $selected="selected";
                                          }
                                          else
                                          {
                                            
                                             $selected="";
                                          
                                          }
										
                                         

                                         
                                      }
                                      else
                                        {
                                           $selected="selected";
                                        }
                                        ?>
										<option value="{{$buildingunit->id}}" {{ $selected}}>{{$buildingunit->unit}}</option>
									@endforeach
								</select>
								<span  class="help-block"></span> 
						</div>
						
				</div>

				<div class="row">
						<!---Building Area-->
						<!---Land Area-->
						<div class="form-group col-md-6 landarea_show @if($property_lists->landarea_show == 0){{'hide'}} @endif" id="landbox">
							<label>Land Area</label>
							<input id="land_area" name="land_area" type="text" class="form-control" placeholder="Enter Land Area " value="{{$property_lists->land_area}}">
							<span  class="help-block"></span> 
						</div>
						<!----/* Land Area---->
						<!--- Land Unit-->
						<div class="form-group col-md-6 landarea_show @if($property_lists->landarea_show == 0) {{'hide'}} @endif " id="lunitbox">
							<label>Land Unit</label>
							<?php $selectedlunit[] = $property_lists->land_unit_id;
							?>
								<select class="bootstrap-select" name="land_unit" data-width="100%" id="land_unit">
									<option value="">Select</option>

									@foreach($landunits as $landunit)


									<?php if(! in_array($landunit->id,$selectedlunit) && ! in_array($landunit->parent_id,$selectedlunit))
                                      {
                                         $sel = Modules\Properties\Entities\LandUnits::where("parent_id",$landunit->id)->first();

                                         $sel_id = @$sel->id;
                                         if(in_array($sel_id,$selectedlunit))
                                          {
                                             $selected="selected";
                                          }
                                          else
                                          {
                                            
                                             $selected="";
                                          
                                          }
                                      }
                                      else
                                        {
                                           $selected="selected";
                                        }
                                        ?>

										<option value="{{$landunit->id}}" {{ $selected}}>{{$landunit->land_unit}}</option>
									@endforeach
								</select>
								<span  class="help-block"></span> 
						</div>
						
				</div>

				<div class="row">
						

						<!---Bedroom-->
						<div class="form-group col-md-6 bedroom_show @if($property_lists->bedroom_show == 0) {{'hide'}} @endif " id="bedbox">
							<label>Bedroom</label>
							<input id="bed_room" name="bed_room" type="text" class="form-control" placeholder="Enter number of bedrooms" value="{{$property_lists->bedroom}}">
							<span  class="help-block"></span> 
						</div>
						<!----/* Bedroom---->
						
						<!--- Bathroom-->
						<div class="form-group col-md-6 bathroom_show @if($property_lists->bathroom_show == 0) {{'hide'}} @endif " id="bathbox">
							<label>Bathroom</label>
								<input id="bath_room" name="bath_room" type="text" class="form-control" placeholder="Enter number of bathrooms" value="{{$property_lists->bathroom}}">
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
							<?php $selectedvalue = $property_lists->property_created_amenities->pluck('amenity_id')->toArray();

							 ?>
							@foreach($amineties as $aminety)
							<?php if(! in_array($aminety->id,$selectedvalue) && ! in_array($aminety->parent_id,$selectedvalue))
                                      {
                                         $sel = Modules\Properties\Entities\Amenities::where("parent_id",$aminety->id)->first();

                                         $sel_id = @$sel->id;
                                         if(in_array($sel_id,$selectedvalue))
                                          {
                                             $selected="checked";
                                          }
                                          else
                                          {
                                            
                                             $selected="";
                                          
                                          }
                                      }
                                      else
                                        {
                                           $selected="checked";
                                        }
                                        ?>


							
								<label class="checkboxa" style="padding-right: 15px;">
								    <input type="checkbox" class="checker border-success text-success-600  CheckboxStyle amenities" name="aminety[]" value="{{$aminety->id}}-{{$aminety->parent_id}}" {{$selected}} >
									{{$aminety->name}}
								</label>
							@endforeach
							
						</div>
					</div>
					<!---Neighbourhood-->
					<div class="row">
						<div class="form-group col-md-12"  style="overflow-y: auto;border: 1px solid rgba(128,128,128,.25);margin-left: 28px;min-height: 200px;width: 972px;">
							<legend class="text-semibold">Select Neighbourhood </legend>
							<?php $selectedneigh = $property_lists->property_created_neighbourhoods->toArray();


							 ?>
							@foreach($neighbourhoods as $key=>$neighbourhood)

							


							
								<div class="form-group col-md-2" id="neighbourbox_{{$key+1}}">
									<label class="checkboxa" style="margin-top: 15px!important;">
									    <input type="checkbox" class="checker border-success text-success-600  CheckboxStyle neighbour" name="neighbourhood[]" value="{{$neighbourhood->id}}" id="neighbourhood_{{$key+1}}" data-id="{{$key+1}}" value="{{$neighbourhood->id}}" @foreach($selectedneigh as $selected)  @if($selected['neighbourhood_id']==$neighbourhood['id']  || $selected['neighbourhood_id']==$neighbourhood['parent_id']) checked  @endif @endforeach>
										{{$neighbourhood->name}} (in m)
									</label>
										<input name="in_km[]" id="km_id_{{$key+1}}"  type="text" class="form-control" placeholder="Enter meter" style="width: 123px!important;" @foreach($selectedneigh as $selected)  @if($selected['neighbourhood_id']==$neighbourhood['id']  || $selected['neighbourhood_id']==$neighbourhood['parent_id']) value="{{$selected['kilometer']}}" @endif @endforeach>
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
									<span class="" id="ImageErrorValid"></span>
							</div>
							<div class="form-group col-md-6">
												@foreach($galleryimages as $image)
												@if($image->is_featured==1)
												@if($image->image!='')
												    <div class="form-group col-md-3 thumb">
												     <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-caption="" data-image="{{ URL::asset('public/images/properties/'.$image->image) }}" data-target="#image-gallery">
                									<img class="img-responsive" src="{{ URL::asset('public/images/properties/'.$image->image) }}" alt="gallery">
            										</a>
												    </div>
												    @else
												    <div class="form-group col-md-3">
                                                    <img  src="{{ asset('public/no-image.png') }}" style="width:100%;height:auto;" >
                                                    </div>
                                                    @endif
                                                    @endif
												@endforeach
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
						<div class="form-group col-md-6">
												@foreach($galleryimages as $image)
												@if($image->is_featured==0)
												@if($image->image!='')
												    <div class="form-group col-md-3 thumb" id="DeleteImage_{{$image->id}}">
												    	<span class="fa fa-close" onclick="DeleteImage({{$image->id}})">X</span>

												    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-caption="" data-image="{{ URL::asset('public/images/properties/'.$image->image) }}" data-target="#image-gallery">
                									<img class="img-responsive gall" src="{{ URL::asset('public/images/properties/'.$image->image) }}" alt="gallery" style="height: 68px;">
            										</a>
												    </div>
												    @else
												    <div class="form-group col-md-3">
                                                    <img src="{{ asset('public/no-image.png') }}" style="width:100%;height:auto;" >
                                                    </div>
                                                    @endif
                                                    @endif
												@endforeach
											</div>
					</div>
					<div id="image_preview"></div>
				</div>
				<!----Map--->

				<div style="width:1500px; height:800px;">
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
  
  <script type="text/javascript">
    
    function DeleteImage(id)
    {
           $.ajax({
                type: "GET",
                url: base_url+"/o4k/property_list/DeleteImage/"+id, 
                dataType: "json",  
                cache:false,
                contentType: false,                   
                processData:false,
                success: function(response){
                   if(response.status==true){ $("#DeleteImage_"+id).remove();}
                }
         });
    }
</script>
<style type="text/css">
	
	span.fa.fa-close {
    cursor: pointer;
    color: red;
    /* padding: 10px; */
    float: right;
    /* margin-bottom: -5px; */
    margin-right: 2px;
    font-size: 13px;
    font-weight: 900;
}

</style>
  
@section('js')
   @section('js')

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Properties/Resources/assets/js/propertylistControles.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap1"async defer></script>
@stop
  
