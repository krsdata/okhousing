@extends('admin::admin.master')
@section('title', "Admin User")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/modules')}}"><i class="icon-list position-left"></i> Admin Users</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/modules')}}"><i class="icon-list position-left"></i>Admin  Users</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> -Admin Users <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create User<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="#" id="admin_create" autocomplete="off" enctype="multipart/form-data">
           
           <div class="row">
                    <!-- Name -->
                    <div class="form-group col-md-6" id="nameBox">
                        <label>Name</label>
                        <input id="admin_name" name="admin_name" type="text" class="form-control" placeholder="Enter Name">
                        <span  class="help-block"></span>
                    </div>
                    <!-- /*Name --> 
                    <!-- Email -->
                    <div class="form-group col-md-6" id="emailBox">
                        <label>Email</label>
                        <input id="admin_email" type="text" name="email"  class="form-control" placeholder="Enter Email">
                        <span  class="help-block"></span>
                    </div>
                    <!-- /*Email -->
                </div>
            <div class="row">
                    <!-- Password -->
                    <div class="form-group col-md-6" id="passwordBox">
                        <label>Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password">
                        <span  class="help-block"></span>
                    </div>
                    <!-- /*Password -->
                    
                    <!-- Profile Pic -->
                    <div class="form-group col-md-6">
                        <label >Profile Pic</label> 
                        <div>
                        <input name="image" id="image" type="file" class="file-styled-primary"> 
                        </div>
                    </div>
                    <!-- /*Profile Pic -->
                </div>
             
                <div class="row">
                    <!-- Status -->
                    <div class="form-group col-md-6" id="statusBox">
                        <label>Status</label>
                        <select class="bootstrap-select " name="status" data-width="100%">
                            <option value="1" selected >Active</option>
                            <option value="0">Inactive</option>
                        </select>
                         <span  class="help-block"></span>
                    </div>
                    <!-- /*Status -->
                </div>
            
            <div class="show_access">
                <legend class="text-bold">Select User Access</legend>
                <div class="row" id="countryBox">
                <span  class="help-block"></span>
                <div class="col-md-1"  >
                </div>
                <div class="col-md-2">
                <h6> Select Country </h6>
                </div>
                <div class="col-md-6">
                <h6> Select Role </h6>
                </div>
                </div>
                <hr>
                    @foreach($countries as $key=> $country)
                    <div class="row countryrole" data-id="{{$key+1}}">
                    <div class="col-md-1">
                    </div>
                    <div class="form-group col-md-2 sel-check">
                        <label class="checkbox-inline"> 
                                <input type="checkbox" class="CheckboxStyle" id="country_{{$key+1}}" name="countries[]" value="{{$country['id']}}">
                                {{$country['created_countries']['name']}}
                        </label>
                    </div>
                    <div class="form-group col-md-6 " id="rolebox_{{$key+1}}">
                    <select name="roles[{{$country->id}}]" id="role_{{$key+1}}" class="bootstrap-select" name="status" data-width="100%">
                        <option value="">Select </option>
                        @foreach($country['created_roles'] as $roles)
                            <option value="{{$roles->id}}" >{{$roles->name}}</option>
                        @endforeach

                    </select>
                    <span  class="help-block"></span>
                    </div>
                    </div>
                    <hr>
                    @endforeach

            </div>
            
            
           
            <!--Form action-->
                 <div class="row">
                    <div class="col-md-12 text-right">
                        
                        <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                        <button type="submit" id="country_save" class="btn btn-primary legitRipple">Save User <i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/admin_user.js')}}"></script>
@stop
