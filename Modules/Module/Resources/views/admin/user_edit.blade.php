@extends('admin::admin.master')
@section('title', "Admin Modules")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/modules')}}"><i class="icon-list position-left"></i> Admin Modules</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/modules/user')}}"><i class="icon-list position-left"></i>User  Modules</a></li>
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
            <h5 class="panel-title">Create Module<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="#" id="module_user_updates" autocomplete="off" data-id="{{$module->id}}">
           
            <div class="row">
            <!--Name -->
                <div class="form-group col-md-6 " id="modulebox">
                    <label>Name</label>
                    <input type="text" name="module_name" id="module_name" class="form-control" placeholder="Module Name" value="{{$module->module_name}}" >
                    <span  class="help-block"></span>
                </div>
            <!-- /* Name -->
            <!-- Slug-->
                <div class="form-group col-md-6" id="slugbox">
                    <label>Slug</label>
                    <input type="text" name="module_slug" id="module_slug" readonly class="form-control" placeholder="Module Slug"  value="{{$module->slug}}" >
                    <span  class="help-block"></span>
                </div>
            <!-- /* Slug-->
            </div>	
            <div class="row">
            <!-- Status-->
                <div class="form-group col-md-6" id="module_status">
                    <label>Status</label>
                    <select class="bootstrap-select" name="status" data-width="100%">
                       <option value="1"   @if($module->status== '1') selected @endif >Active</option>
                        <option value="0" @if($module->status== '0') selected @endif>Inactive</option>
                    </select>
                    <span  class="help-block"></span>	
                </div>
            <!-- /*Status-->
            <!-- parent Module -->	
                <div class="form-group col-md-6" id="parent_module">
                    <label>Parent Module</label>
                     
                    <select class="bootstrap-select" name="parent_module" data-width="100%">
                        <option value="select">Select</option> 
                         @foreach($allmodule as $modules)
                        <option value="{{$modules->id}}"@if($modules->id==$module->parent) selected @endif>{{$modules->module_name}}</option>
                        @endforeach
                    </select>
                    <span  class="help-block"></span> 
                </div>
            <!-- /* Parent Module-->	 
            </div>
             
                <div class="row">
                    <!--Module Type -->
                    <div class="form-group col-md-6">
                        <label>Module Type</label>
                       <select class="bootstrap-select" name="module_type" id="module_type"  data-width="100%">
                            <option value="select" selected >select</option>
                            <option value="0"  @if($module->module_type== '0') selected @endif>Main</option>
                            <option value="1" @if($module->module_type== '1') selected @endif>Other</option>
                        </select>
                    </div>
                    <!--/* Module Type -->
                    <!--Module Icon -->
                    <div class="form-group col-md-6">
                        <label>Module Icon</label>
                        <input id="icon" type="text" name="icon"  class="form-control" value="{{$module->icon}}" >
                    </div>
                    <!--/* Module Icon -->
                </div>
            
            
            <div>
                <!-- Short Code-->
                <div class="form-group col-md-6" id="Codebox">
                    <label>Short Code</label>
                    <input type="text" name="module_Code" id="module_Code"  class="form-control" placeholder="Short Code" maxlength="3" value="{{$module->short_code}}" >
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
                            @if(count($module['module_Countries']) >0)
                                @php $cnt_arrays = $module->module_Countries->pluck('country_id')->toArray(); @endphp
                                @foreach($countries as $country)
                                    <label class="checkbox-inline">
                                    <input type="checkbox"  class="checker border-success text-success-600  CheckboxStyle modulecountry" name="countries[]" value="{{$country->id}}"  @if(in_array($country['created_countries']['id'],$cnt_arrays)) checked @endif>
                                    {{$country['created_countries']['name']}}
                                    </label>
                                @endforeach
                            @else
                                @foreach($countries as $country)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="checker border-success text-success-600  CheckboxStyle modulecountry" name="countries[]" value="{{$country['id']}}" >
                                        {{$country['created_countries']['name']}}

                                    </label>
                                @endforeach            
                            @endif
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
