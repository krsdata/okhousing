@extends('admin::admin.master')
@section('title', "Admin Roles")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/roles')}}"><i class="icon-list position-left"></i> Roles</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/roles')}}"><i class="icon-list position-left"></i> Roles</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Roles <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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

   
<style type="text/css">
    span.help-block{
        color: red;
    }
</style>
        <div class="panel-heading">
            <h5 class="panel-title">Create Roles<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="{{url('o4k/roles/store')}}" id="role_create2" autocomplete="off"  method="post">
           
           <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
            <!--Name -->
                <div class="form-group col-md-6 " id="rolebox">
                    <label>Name</label>
                    <input type="text" name="role_name" id="role_name" class="form-control" placeholder="Role Name" >
                   
                     <span class="help-block">
                        {{ $errors->first('role_name', ':message') }}
                        
                    </span> 
                </div>
            <!-- /* Name -->
            <!-- Slug-->
                <div class="form-group col-md-6" id="slugbox">
                    <label>Slug</label>
                    <input type="text" name="role_slug" id="role_slug" readonly class="form-control" placeholder="Role Slug">
                    <span  class="help-block"></span>
                </div>
            <!-- /* Slug-->
            </div>	
            <div class="row">
            <!-- Status-->
                <div class="form-group col-md-6" id="role_status">
                    <label>Status</label>
                    <select class="bootstrap-select" name="status" data-width="100%">
                        <option value="1" selected >Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span class="help-block">
                         
                            {{ $errors->first('role_status', ':message') }}
                       
                    </span> 
                </div>
            <!-- /*Status-->
           
            <!-- /* Country-->

                    <div class="form-group col-md-6 has-error" id="countryBox">
                        <label>Country<span class="text-danger">*</span></label>
                            <select class="bootstrap-select" data-width="100%" name="country" id="country_id">
                                <option value="" >Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" >{{$country->created_countries->name}}</option>
                                    @endforeach
                            </select>
                    <span class="help-block">
                        {{ $errors->first('country', ':message') }}
                        
                    </span> 
                     </div>
            <!-- /* Country-->
           
            </div>

             <!-- Description-->
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Description</label>
                    <textarea rows="5" cols="5" class="form-control" placeholder="Role Description" name="description" ></textarea>
                </div>
               
            <!-- /* Description-->
            </div>
			<!-- Assign permissions for roles-->
            <div id="permission_section" style="display:none;">
                <div class="row">
                    <div class="form-group col-md-12" id="permBox">
                        <label class="display-block text-semibold">Assign Permissions for Role</label>
                        <fieldset style="border: 1px solid #ccc; padding: 20px">
                        <span class="help-block"></span> 
                        <div id="errordiv"></div>
                        <div id="permisonname"></div><h6></h6>
                        </fieldset>
                    </div>
                </div>
			</div>
			<!-- /*Assign permissions for roles-->
            
            <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="role_save" class="btn btn-primary legitRipple">Save Roles <i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('Modules/Roles/Resources/assets/js/AdminRolesControles.js')}}"></script>
@stop
