@extends('admin::admin.master')
@section('title', "Admin Permissions")
@section('css')
 
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/permissions')}}"><i class="icon-list position-left"></i> Permissions</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/permissions')}}"><i class="icon-list position-left"></i> Permissions</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Permissions <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create Permissions<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
            <form action="#" id="permission_create" autocomplete="off" >
           
            <div class="row">
            <!--Name -->
                <div class="form-group col-md-6 " id="permissionbox">
                    <label>Name</label>
                    <input type="text" name="permission_name" id="permission_name" class="form-control" placeholder="Permission Name" >
                    <span  class="help-block"></span>
                </div>
            <!-- /* Name -->
			
            <!-- Slug-->
                <div class="form-group col-md-6" id="slugbox">
                    <label>Slug</label>
                    <input type="text" name="permission_slug" id="permission_slug" readonly class="form-control" placeholder="Permission Slug">
                    <span  class="help-block"></span>
                </div>
            <!-- /* Slug-->
            </div>	
			<div class="row">
            <!-- Status-->
                <div class="form-group col-md-6" id="permission_status">
                    <label>Status</label>
                    <select class="bootstrap-select" name="status" data-width="100%">
                        <option value="1" selected >Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span  class="help-block"></span>	
                </div>
            <!-- /*Status-->
			<!--Module -->
                <div class="form-group col-md-6 " id="permissionmodulebox">
					<label>Module</label>
					<select class="bootstrap-select" data-width="100%" name="module_id" >
					<option value="select" >Select</option>
					@foreach($modules as $module)
						<option value="{{$module->id}}" >{{$module->module_name}}</option>
					@endforeach
					</select>
                    <span  class="help-block"></span>   
				</div>
            <!-- /* Module -->
			</div>
			<!-- Description-->
			<div class="row">
				<div class="form-group col-md-6">
					<label>Description</label>
					<textarea rows="5" cols="5" class="form-control" placeholder="Permission Description" name="descriptions" ></textarea>
				</div>
			</div>
			<!-- /* Description-->
			 <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="permission_save" class="btn btn-primary legitRipple">Save Permission <i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
           <!-- /* Form action -->
				</form>
			</div>
		
		</div>

@stop
  
  
@section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/tables/datatables/datatables.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/custom/datatable-extend.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Permissions/Resources/assets/js/AdminPermissionsControles.js')}}"></script>
@stop
