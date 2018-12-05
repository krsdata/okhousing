@extends('admin::admin.master')
@section('title', "Admin Modules")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/modules')}}"><i class="icon-list position-left"></i> Modules</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/modules/user')}}"><i class="icon-list position-left"></i> User Modules</a></li>
            <li class="active">Create</li>
            
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> -User Modules <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create User Module<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="#" id="module_user_create" autocomplete="off" >
           
            <div class="row">
            <!--Name -->
                <div class="form-group col-md-6 " id="modulebox">
                    <label>Name</label>
                    <input type="text" name="module_name" id="module_name" class="form-control" placeholder="Module Name" >
                    <span  class="help-block"></span>
                </div>
            <!-- /* Name -->
            <!-- Slug-->
                <div class="form-group col-md-6" id="slugbox">
                    <label>Slug</label>
                    <input type="text" name="module_slug" id="module_slug" readonly class="form-control" placeholder="Module Slug">
                    <span  class="help-block"></span>
                </div>
            <!-- /* Slug-->
            </div>	
            <div class="row">
            <!-- Status-->
                <div class="form-group col-md-6" id="module_status">
                    <label>Status</label>
                    <select class="bootstrap-select" name="status" data-width="100%">
                        <option value="1" selected >Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span  class="help-block"></span>	
                </div>
            <!-- /*Status-->
            <!-- parent Module -->	
                <div class="form-group col-md-6" id="parent_module">
                    <label>Parent Module</label>
                    <select class="bootstrap-select" name="parent_module" data-width="100%">
                        <option value="select">Select</option>
                        @foreach($module as $modules)
                        <option value="{{$modules->id}}">{{$modules->module_name}}</option>
                        @endforeach
                    </select>
                    <span  class="help-block"></span> 
                </div>
            <!-- /* Parent Module-->	 
            </div>
             
                <div class="row">
                    <!--Module Type -->
                    <div class="form-group col-md-6" id="typeBox">
                        <label>Module Type</label>
                        <select class="bootstrap-select" name="module_type" id="module_type"  data-width="100%">
                            <option value="select" selected >select</option>
                            <option value="0" >Main</option>
                            <option value="1">Other</option>
                        </select>
                        <span  class="help-block"></span>
                   </div>
                    <!--/* Module Type -->
                    <!--Module Icon -->
                    <div class="form-group col-md-6">
                        <label>Module Icon</label>
                        <input id="icon" type="text" name="icon"  class="form-control" >
                    </div>
                    <!--/* Module Icon -->
                </div>
            
            
            <div>
                <!-- Short Code-->
                <div class="form-group col-md-6" id="Codebox">
                    <label>Short Code</label>
                    <input type="text" name="module_Code" id="module_Code"  class="form-control" placeholder="Short Code" maxlength="3">
                    <span  class="help-block"></span>
                </div>
            <!-- /* Short Code-->
            </div>
            
            <!-- Select Countries -->
                <div class="row">
                    <div class="form-group col-md-12" id="countryerror">
                        <label class="display-block text-semibold">Select Countries having Module Access</label>
                        <span  class="help-block"></span>
                        <div>
                            @foreach($countries as $country)
                                <label class="checkbox-inline">
                                  
                                    <input type="checkbox" class="checker border-success text-success-600 modulecountry  CheckboxStyle" name="countries[]" value="{{$country->id}}">
                                    {{$country['created_countries']['name']}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            <!--/* Select Countries -->
            <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="module_save" class="btn btn-primary legitRipple">Save Module <i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('public/admin/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Module/Resources/assets/js/AdminModuleControles.js')}}"></script>
@stop
