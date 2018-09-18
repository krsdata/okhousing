@extends('admin::admin.master')
@section('title', "Agents Creation")
@section('css')
 <link href="{{asset('public/admin/css/bootstrap-datepicker.css')}}" rel="stylesheet">  
 <link rel="stylesheet" href="{{asset('public/site/css/intlTelInput.css')}}">
 <style type="text/css">
	.required-field{color:red;}
</style>
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/agents')}}"><i class="icon-list position-left"></i> Agents</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/agents')}}"><i class="icon-list position-left"></i> Agents</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Agents <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create Agents<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
            <span   id="error-common"></span>
        </div>
        <div class="panel-body"> 
            <form action="#" id="agents_create" autocomplete="off" >

                <div class="row"> 
                    <div class="form-group col-md-6" id="countrybox">
                        <label>Country<span class="required-field">*</span></label>
                        <select class="bootstrap-select " data-width="100%"  name="countries" id="country_id" onchange="initMap()">
                            <option value="select" >Select</option>
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}" data-flag="{{$country['created_countries']['flag']}}">{{$country['created_countries']['name']}}</option>
                                @endforeach
                        </select>
                        <span  class="help-block"></span>
                    </div>


                    <div class="form-group col-md-6" id="emailbox">
                        <label>Email<span class="required-field">*</span></label>
                        <input id="admin_email" type="text" name="email"  class="form-control" placeholder="Enter Email">
                        <span  class="help-block"></span>
                    </div>
                </div>

               
                
                <div class="row">
                    
                    <div class="form-group col-md-6" id="imgbox">
                        <label >Profile Pic</label>
                        <div>
                            <input id="image" name="image" type="file" class="file-styled-primary"> 
                        </div>
                        <span  class="help-block"></span>
                    </div>
                    
                    <div class="form-group col-md-6" id="statusBox">
                        <label>Status</label>
                        <select class="bootstrap-select" name="status" data-width="100%">
                            <option value="1" selected >Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <span  class="help-block"></span>	
                    </div>


                </div> 
                
                <div class="row">
                    

                    
                   <div class="form-group col-md-6" id="mobilebox">
                        <label>Mobile no<span class="required-field">*</span></label><br/>
                        <input id="mnumber" style="box-shadow: none; width: 100%;    padding: 10px;   border: none;border-bottom: 1px solid #ddd;" name="mnumber" class="validate"  type="text" class="form-control" placeholder="Enter Mobile No">
                        <span  class="help-block"></span>	
                    </div>  
                </div>
                 <div class="row">
                    <div class="form-group col-md-6" id="locationbox">
                            <label>Location</label>
                                <input id="location" type="text" placeholder="Enter a location" class="form-control" name="location">
                            <span  class="help-block"></span> 
                    </div>

                    <div class="form-group col-md-6" id="locationbox">
                        <div class="form-group col-md-4" >
                            <label>Latitude</label>
                            <input id="lat" type="text" class="form-control" readonly  placeholder="Enter latitude"  name="lat">
                        </div>
                        <div class="form-group col-md-4" >
                            <label>Longitude</label>
                            <input id="lng" type="text" class="form-control" readonly  placeholder="Enter longitude"  name="lng">
                        </div>
                    </div>
                   
                </div> 

                
                 <div class="langsection"></div>

                <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" id="user_save" class="btn btn-primary legitRipple">Save Agent <i class="icon-paperplane position-right"></i></button>
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
	<script type="text/javascript" src="{{asset('Modules/Agents/Resources/assets/js/AdminAgentControles.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&callback=initMap"
        async defer></script>
    <script src="{{asset('public/site/js/plugin/intlTelInput.min.js')}}"></script>
        
@stop
