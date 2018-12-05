@extends('admin::admin.master')
@section('title', "Admin Property List")
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
        <li><a href="{{ URL::to('o4k/FeaturedProperties')}}"><i class="icon-list position-left"></i>Featured Properties List</a></li>
        <li class="active">Update</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/FeaturedProperties')}}"><i class="icon-list position-left"></i> Featured Properties List</a></li>
            <li class="active">Update</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Property List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Update Featured Properties List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-8">
                <form action="#" id="property_list_update" autocomplete="off" data-id="{{$property->id}}">

                    <input type="hidden"  name="property_id" id="property_id" value="{{$property->property_id}}">

                     <input type="hidden"  name="id" id="id" value="{{$property->id}}">
                     
                    <input type="hidden"  name="category_id" id="category_id"  value="{{$property->category_id}}" >
                    
                    <input type="hidden"  name="short_code" id="short_code" value="{{$short_code}}">
                    <input type="hidden" value="{{$property->id}}" name="id">

                    <div class="row">
                            <!---Property Name-->
                             <div class="form-group col-md-6 " id="propertybox">
                                        <label>Property</label>
                                        <div class="input-group">
                                                <input type="text" class="form-control" id="unique_property_id" placeholder="search by Property ID Ex. {{$short_code}}-10001" value="{{$PropertyDetails->uid}}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default legitRipple" type="button" id="Search_by_id"><i class="glyphicon glyphicon-search"></i></button>
                                                </span>

                                            </div>
                                             <span  class="help-block"></span> 
                                    </div>
                                <!---Property Name-->
                            <div class="form-group col-md-6" id="Datetimebox">

                                <label>Datetime</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control daterange-time" value="<?php echo date('m/d/Y h:i a' ,strtotime($property->start)).' - '.date('m/d/Y h:i a',strtotime($property->end)); ?>" id="Datetime" name="Datetime"> 
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <span  class="help-block"></span> 
                                        </div>
                                </div>

                    </div>
                    
                 
                    
                    <div class="row">
                            <!---Property Name-->
                            <div class="form-group col-md-6" id="amountbox">
                                <label>Amount</label>
                                <div class="input-group bootstrap-touchspin">
                                    <input name="amount" id="amount" type="text" name="text" class="touchspin-empty form-control" placeholder="amount" value="{{$property->amount}}">
                                    <span  class="help-block"></span> 

                                </div>

                            </div>
                            <!---Property Name-->
                            <div class="form-group col-md-6" id="paymentbox">
                                <label>Payment</label>
                                <select class="bootstrap-select " data-width="100%"  name="Payment" id="Payment">
                                        <option disabled="true">Select Payment Status</option>
                                        <option value="Free" @if($property->payment == 'Free') selected @endif >Free</option>
                                        <option value="Paid" @if($property->payment == 'Paid') selected @endif >Paid</option>
                                </select>
                                <span  class="help-block"></span> 
                            </div>
                            <!----/* Property Name---->

                    </div>

                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="slider_property_list_save" class="btn btn-primary legitRipple">Save Featured Properties<i class="icon-paperplane position-right"></i></button>
                        </div>  
                    </div>
               <!-- /* Form action -->
                </form>
            </div>
            <div class="col-md-4">
                <div class="propertyDetails" id="propertyDetails">
                    <img src="{{ URL::asset('public/images/properties/'.@$image->image) }}" class="img-responsive"  id="property_img"/>
                    <h3  id="property_title">{{$PropertyDetails->name}}</h3>
                    <p  id="property_prize"><strong>Prize : </strong>{{$PropertyDetails->prize}}</p>
                    <p  id="property_user" ><strong>User : </strong>{{$PropertyDetails->users->email}}</p>
                    <strong  id="property_empty_msg" ></strong>
                </div>
            </div>

        </div>
        
    </div>

@stop
  
  
  
@section('js')
   @section('js')

   <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/notifications/jgrowl.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/anytime.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/picker.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/legacy.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/picker_date.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/FeaturedPropertyControles.js')}}"></script>
    
@stop
  
