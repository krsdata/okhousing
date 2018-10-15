@extends('admin::admin.master')
@section('title', "Admin Site Users")
@section('css')
<style type="text/css">
	.required-field{color:red;}
</style>
 
@stop
@section('breadcrumb')

<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/users')}}"><i class="icon-list position-left"></i> Site User</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/users')}}"><i class="icon-list position-left"></i> Site User</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Site User <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Site User<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">

            <form action="#" id="site_user_update" autocomplete="off" data-id="{{$user->id}}">
				<div class="row">
					
					<div class="form-group col-md-6" id="namebox">
						<label>Name<span class="required-field">*</span></label>
						<input id="admin_name" name="adname" type="text" class="form-control" placeholder="Enter Name" value="{{$user->name}}">
						<span  class="help-block"></span>
					</div>

					
					<div class="form-group col-md-6" id="emailbox">
						<label>Email<span class="required-field">*</span></label>
						<input id="admin_email" type="email" name="email"  class="form-control" placeholder="Enter Email" value="{{$user->email}}">
						<span  class="help-block"></span>
					</div>
				</div>
				<div class="row">
						<div class="form-group col-md-6" id="mobilebox">
							<label>Mobile no<span class="required-field">*</span></label>
							<input id="mnumber" name="mnumber" type="text" class="form-control" placeholder="Enter Mobile No" value="{{$user->mobile}}">
							<span  class="help-block"></span>	
						</div>
						<!----Unique code---->	
						<div class="form-group col-md-6" id="uniquecodebox">
							<label>unique code</label>
							<input id="unique_code" name="unique_code" type="text" class="form-control" placeholder="Enter unique code" readonly value="{{$user->unique_code}}" >
							<span  class="help-block"></span>
						</div>
										
				</div>
				<div class="row">
					
						<div class="form-group col-md-6" id="passbox">
							<label>Password<span class="required-field"></span></label>
							<input id="password" name="password" type="password" class="form-control" placeholder="Enter Password">
							<span  class="help-block"></span>	
						</div>
						
						
						<div class="form-group col-md-6">
							<label >Profile Pic</label>
							<div class="media no-margin-top">
								@if($user->image!="")
									<div style="float: right;padding-right: 143px;">
										<a href="#"><img src="{{asset('public/images/user_pics')}}/{{$user->image}}" style="width: 58px; height: 58px; border-radius: 2px;" alt=""></a>
									</div>
								@endif
								<div class="media-body">
									<input id="images" name="images" type="file" class="file-styled-primary">
								</div>

							</div>
						</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6" id="locationbox">
							<label>Location</label>
							    <input id="location" type="text" placeholder="Enter a location" class="form-control" name="location" value="{{$user->location}}">
							<span  class="help-block"></span> 
					</div>

					<div class="form-group col-md-6" id="locationbox">
						<div class="form-group col-md-4" >
							<label>Latitude</label>
							<input id="lat" type="text" class="form-control" readonly  placeholder="Enter latitude"  name="lat" value="{{$user->latitude}}">
						</div>
						<div class="form-group col-md-4" >
							<label>Longitude</label>
							<input id="lng" type="text" class="form-control" readonly  placeholder="Enter longitude"  name="lng" value="{{$user->longitude}}">
						</div>
					</div>
						
					<!----Unique code---->	
						<!--<div class="form-group col-md-6" id="uniquecodebox">
							<label>unique code</label>
							<input id="unique_code" name="unique_code" type="text" class="form-control" placeholder="Enter unique code">
							<span  class="help-block"></span>
						</div> -->
				</div>
				<div class="row">
					
						<div class="form-group col-md-6">
							<label>Status</label>
							<select class="bootstrap-select" name="status" data-width="100%">
								<option value="1" {{($user->status==1)?'selected':''}} >Active</option>
								<option value="0" {{($user->status==0)?'selected':''}}>Inactive</option>
							</select>
						</div>
						
				</div>
				<?php

					if($user->created_types){

						$modules= Modules\Module\Entities\Modules::where('id',$user->created_types[0]['module_id'])->first();
						if(($modules->slug=='builders') || ($modules->slug=='home-interiors') || ($modules->slug=='home-stay')){
							$module_type=1;
						}else{
							$module_type=0;
						}
					}
					

				?>
				<div class="row">
								<div class="form-group col-md-6" id="usertypebox">
									
									<label>User Type</label>
									<select id="user_type" class="bootstrap-select" name="user_type" data-width="100%">
										<option value="0" {{($module_type==0)?'selected':''}} >Main</option>
										<option value="1" {{($module_type==1)?'selected':''}}>Other</option>
									</select>
									<span  class="help-block"></span>
								</div>
								@php 
									$types =$user->created_types->pluck('module_id')->toArray();
									
								@endphp
								
								<div id="type-div" class="form-group col-md-6">
									<label>Select Types<span class="required-field">*</span></label>
										<div id="main_types" class="type-list" style="{{($module_type==1)?'display: none':''}}">
										
											@foreach($mains as $main)
												<label class="checkbox-inline">
												<input type="checkbox" class="checker border-success text-success-600 CheckboxStyle" name="types[]" value="{{$main->id}}" @if(in_array($main->id,$types)) checked @endif>
													{{$main->module_name}}
													
												</label>
											@endforeach
											
										</div>
										<div id="other_types" class="type-list" style="{{($module_type==0)?'display: none':''}}">
											@foreach($others as $other)
											<label class="checkbox-inline">
											<input type="radio" class=" checker border-success text-success-600 CheckboxStyle other_module" name="type" value="{{$other->id}}" @if(in_array($other->id,$types)) checked @endif data-slug="{{$other->slug}}"  />
												{{$other->module_name}}
												
											</label>
											@endforeach
										</div>
								</div>
				</div>

				<!---------Builder Form------>
				<div id="" style="{{($module_type==0)?'display: none':''}}">
							
					@includeIf('users::admin.builders_edit_form')
							
				</div>
				<!---------Builder Form------>
				<div id="htmlform"></div>

					
			 <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="user_save" class="btn btn-primary legitRipple">Update User <i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
           <!-- /* Form action -->
			</form>
		</div>
		
	</div>
  
  
@stop 
@section('js')

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('Modules/Users/Resources/assets/js/UsersControles.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap"
        async defer></script>
@stop
