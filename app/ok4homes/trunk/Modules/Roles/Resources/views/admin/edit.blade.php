@extends('admin::admin.master')
@section('title', "Admin Roles")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/roles')}}"><i class="icon-list position-left"></i> Roles</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/roles')}}"><i class="icon-list position-left"></i> Roles</a></li>
            <li class="active">Edit</li>
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
        <div class="panel-heading">
            <h5 class="panel-title">Create Roles<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="#" id="role_update" autocomplete="off" data-id="{{$role->id}}">
           
            <div class="row">
            <!--Name -->
                <div class="form-group col-md-6 " id="rolebox">
                    <label>Name</label>
                    <input type="text" name="role_name" id="role_name" class="form-control" placeholder="Role Name" value="{{$role->name}}">
                    <span  class="help-block"></span>
                </div>
            <!-- /* Name -->
            <!-- Slug-->
                <div class="form-group col-md-6" id="slugbox">
                    <label>Slug</label>
                    <input type="text" name="role_slug" id="role_slug" readonly class="form-control" placeholder="Role Slug" value="{{$role->slug}}">
                    <span  class="help-block"></span>
                </div>
            <!-- /* Slug-->
            </div>  
            <div class="row">
            <!-- Status-->
                <div class="form-group col-md-6" id="role_status">
                    <label>Status</label>
                    <select class="bootstrap-select" name="status" data-width="100%">
                        <option value="1"  @if($role->status== '1') selected @endif >Active</option>
                        <option value="0" @if($role->status== '0') selected @endif>Inactive</option>
                    </select>
                    <span  class="help-block"></span>   
                </div>
            <!-- /*Status-->
           
            <!-- /* Country-->

                    <div class="form-group col-md-6 has-error" id="countryBox">
                        <label>Country<span class="text-danger">*</span></label>
                            <select class="bootstrap-select" data-width="100%" name="country_id" id="country_id">
                           
                                <option value="" >Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" @if($country->id==$role->country_id) selected @endif>{{$country->created_countries->name}}</option>
                                    @endforeach
                            </select>
                            <span class="help-block"></span> 
                     </div>
            <!-- /* Country-->
           
            </div>

             <!-- Description-->
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Description</label>
                    <textarea rows="5" cols="5" class="form-control" placeholder="Role Description" name="description" >{{$role->description}}</textarea>
                </div>
               
            <!-- /* Description-->
            </div>
            <!-- Assign permissions for roles-->
            <div id="permission_section" >
                <div class="row">
                    <div class="form-group col-md-12" id="permBox">
                        <label class="display-block text-semibold">Assign Permissions for Role</label>
                        <div id="errordiv"></div>
                        <div class="permupdatesectn">
                        <?php $perms = $selectedpermsn->pluck('permission_id')->toArray(); ?>
                        @foreach($resultArray as $result)
                        <label style="padding-top: 22px;" class="display-block text-semibold">{{$result['module_name']}}</label>
                        @foreach($result['permissions'] as $permission)
                        <label style="padding-top: 1px;padding-left: 22px;" class="checkbox-inline"><input type="checkbox" class="checker border-success text-success-600  CheckboxStyle modperm" name="permissions[]" value="{{$permission['id']}}" @if(in_array($permission['id'],$perms)) checked @endif>{{$permission['name']}}</label>
                         @endforeach
                        @endforeach
                        </div>
                        <div id="permisonname"></div><h6></h6><h6></h6>
                        <span class="help-block"></span> 
                    </div>
                </div>
            </div>
            <!-- /*Assign permissions for roles-->
            
            <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="role_save" class="btn btn-primary legitRipple">Update Roles <i class="icon-paperplane position-right"></i></button>
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
