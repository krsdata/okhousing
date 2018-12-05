@extends('admin::admin.master')
@section('title', "Admin Amenities")
@section('css')
 
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/projects/amenities')}}"><i class="icon-list position-left"></i>Amenities</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/projects/amenities')}}"><i class="icon-list position-left"></i>Amenities</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Amenities <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Amenities<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="amenity_update" autocomplete="off" data-id="{{$amenities->id}}">
				<div class="row">
					<!---Name-->
						<input type="hidden" name="language_en" value="1">
						<input type="hidden" name="id" value="{{$amenities->id}}">
						<div class="form-group col-md-6" id="namebox_en">
							<label>Name in English</label>
							<input  id= "name_en" name="name_en" type="text" class="form-control perm_text" placeholder="Enter Name" data-lang="en" value="{{$amenities->name}}">
							
							 <span  class="help-block"></span> 
						</div>
						<!----/* Name---->
						<!--- Slug-->
						<div class="form-group col-md-6" id="slugbox_en">
							<label>Slug</label>
								<input id="slug_en"  type="text" name="slug_en"  readonly class="form-control perm_slug" placeholder="Amenities Slug" value="{{$amenities->slug}}">
								 <span  class="help-block"></span> 
						</div>
				</div>
					@php
						$ids = $amenities->types->pluck('id')->toArray();
						$lang_ids = $amenities->types->pluck('language_id')->toArray();
						$names = $amenities->types->pluck('name')->toArray();
						$slugs = $amenities->types->pluck('slug')->toArray();
					@endphp

						@foreach($languages as $language)
							<div class="row">
									@php $key=''; $key = array_search($language->language_id,$lang_ids); @endphp
									<input type="hidden" name="language[]" value="{{$language->language_id}}" >
									<input type="hidden" name="ids[]" value="@if($key >=0){{$ids[$key]}}@endif" >
									<div class="form-group col-md-6"  id="namebox_{{$language->languages->lang_code}}">
										<label>Name in {{$language->languages->name}}</label>
										<input id="name_{{$language->languages->lang_code}}" name="name[]" type="text" class="form-control perm_text" placeholder="Enter Name"  value="@if($key >=0){{$names[$key]}}@endif" >
										<input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" >
										 <span  class="help-block "></span> 
									</div>
								<div class="form-group col-md-6" id="slugbox_{{$language->languages->lang_code}}">
									<label>Slug</label>
									<input  type="text" id="slug_{{$language->languages->lang_code}}" name="slug[]" readonly class="form-control perm_slug" placeholder="Amenities Slug"  value="@if($key >=0){{$slugs[$key]}}@endif">
									 <span  class="help-block "></span> 
								</div>
							</div>
						@endforeach
					<div class="row">
						<div class="form-group col-md-6" id="iconbox">
							<label >Amenity Icon</label>
						        <div>
									<input id="amenity_image" name="image" type="file" class="file-styled-primary">
									<div style="width: 41px!important;margin-top:2px!important;margin-right:36px!important;float: right!important;">
										@if ($amenities->icon!='')
											<img src= "{{ URL::asset('public/images/amenities/'.$amenities->icon) }} " style="width:100%;height:auto;" />
										@else
                                            <img src="{{ asset('public/no-image.png') }}" style="width:100%;height:auto;" >
										@endif
									</div>
								</div>
								<span  class="help-block "></span>
						</div>
						<!--------- Status------>
						<div class="form-group col-md-6" id="statusbox">
							<label>Status</label>
							<select class="bootstrap-select" name="status_en" id="amenity_status"data-width="100%">
								<option value="1" {{($amenities->status==1)?'selected':''}} >Active</option>
								<option value="0" {{($amenities->status==0)?'selected':''}}>Inactive</option>
							</select>
							 <span  class="help-block "></span>
						</div>
										
					</div>
					 <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="amenity_save" class="btn btn-primary legitRipple">Save Amenity<i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
           <!-- /* Form action -->
			</form>
		</div>
		
	</div>

@stop
  
  
  
@section('js')
   @section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/tables/datatables/datatables.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/custom/datatable-extend.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Projects/Resources/assets/js/amenitiesControles.js')}}"></script>
@stop
  
