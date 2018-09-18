@extends('admin::admin.master')
@section('title', "Admin Owners List")
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
        <li><a href="{{ URL::to('o4k/sliderowners')}}"><i class="icon-list position-left"></i>Slider Owners List</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/sliderowners')}}"><i class="icon-list position-left"></i> Slider Owners List</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Owners List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create Slider Owners List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="slider_Owners_list_create" autocomplete="off" >

                <input type="hidden" value="Owners" name="slider_element_type">
                
				<div class="row">
						<!---Owners Name-->
						<div class="form-group col-md-8" id="Ownersbox">
							<label>Owner</label>
							<select class="bootstrap-select " data-width="100%"  name="slider_element_id" id="Owners_id">
								<option value="" >Select Owner</option>
									@foreach($OwnerList as $Owners)
										<option value="{{$Owners['id']}}">{{$Owners['name']}}</option>
									@endforeach
							</select>
							<span  class="help-block"></span> 
						</div>
							<!---Owners Name-->
						
						<!---Owners Name-->
						<div class="form-group col-md-4" id="pagebox">
							<label>Page Name</label>
							<select class="bootstrap-select " data-width="100%"  name="page[]" id="showpage_id" multiple="true">
									<option>Select Page</option>
									<option value="Home">Home</option>
									<option value="Utility">Utility</option>
									<option value="Agents">Agents</option>
									<option value="Owners">Owners</option>
								</select>
							 <span  class="help-block"></span> 
						</div>
						<!----/* Owners Name---->

				</div>

				

				<!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="slider_Owners_list_save" class="btn btn-primary legitRipple">Save Slider Owners<i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('Modules/Owners/Resources/assets/js/sliderControles.js')}}"></script>
    
@stop
  
