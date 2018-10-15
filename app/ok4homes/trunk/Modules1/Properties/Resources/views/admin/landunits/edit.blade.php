@extends('admin::admin.master')
@section('title', "Admin Land Units")
@section('css')
 
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/land_unit')}}"><i class="icon-list position-left"></i>Land Units</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/land_unit')}}"><i class="icon-list position-left"></i>Land Units</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Land Units <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Land Unit<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="land_unit_update" autocomplete="off" data-id="{{$land_unit->id}}">
				<div class="row">
					<!---Name-->
						<input type="hidden" name="language_en" value="1">
						<div class="form-group col-md-6" id="unitbox_en">
							<label>Name in English</label>
							<input  id= "unit_en" name="unit_en" type="text" class="form-control perm_text" placeholder="Enter Unit" data-lang="en" value="{{$land_unit->land_unit}}">
							
							 <span  class="help-block"></span> 
						</div>
						<!----/* Name---->
						<!--- Slug-->
						<div class="form-group col-md-6" id="slugbox_en">
							<label>Slug</label>
								<input id="slug_en"  type="text" name="slug_en"  readonly class="form-control perm_slug" placeholder="Land Unit Slug"  value="{{$land_unit->slug}}">
								 <span  class="help-block"></span> 
						</div>
				</div>
				@php
					$ids = $land_unit->types->pluck('id')->toArray();
					$lang_ids = $land_unit->types->pluck('language_id')->toArray();
					$units = $land_unit->types->pluck('land_unit')->toArray();
					$slugs = $land_unit->types->pluck('slug')->toArray();
				@endphp
						@foreach($languages as $language)
							<div class="row">
									@php  $key = array_search($language->language_id,$lang_ids); @endphp
									<input type="hidden" name="language[]" value="{{$language->language_id}}" >
									<input type="hidden" name="ids[]" value="@if(!empty($land_unit->types[0])){{$ids[$key]}}@endif" >
									<div class="form-group col-md-6"  id="unitbox_{{$language->languages->lang_code}}">
										<label>Name in {{$language->languages->name}}</label>
										<input id="unit_{{$language->languages->lang_code}}" name="unit[]" type="text" class="form-control perm_text" placeholder="Enter Unit" value="@if(!empty($land_unit->types[0])){{$units[$key]}}@endif">
										<input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" >
										 <span  class="help-block "></span> 
									</div>
								<div class="form-group col-md-6" id="slugbox_{{$language->languages->lang_code}}">
									<label>Slug</label>
									<input  type="text" id="slug_{{$language->languages->lang_code}}" name="slug[]" readonly class="form-control perm_slug" placeholder="Land Unit Slug"  value="@if(!empty($land_unit->types[0])){{$slugs[$key]}}@endif">
									 <span  class="help-block "></span> 
								</div>
							</div>
						@endforeach
					<div class="row">
						<!--------- Status------>
						<div class="form-group col-md-6" id="statusbox">
							<label>Status</label>
							<select class="bootstrap-select" name="status_en" id="land_unit_status"data-width="100%">
								<option value="1" {{($land_unit->status==1)?'selected':''}} >Active</option>
								<option value="0" {{($land_unit->status==0)?'selected':''}}>Inactive</option>
							</select>
							 <span  class="help-block "></span>
						</div>
										
					</div>
					 <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="land_unit_update" class="btn btn-primary legitRipple">Update Land Unit<i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('Modules/Properties/Resources/assets/js/landunitControles.js')}}"></script>
@stop
  
