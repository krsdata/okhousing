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
        <li><a href="{{ URL::to('o4k/sliderproperties')}}"><i class="icon-list position-left"></i>Slider Property List</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/sliderproperties')}}"><i class="icon-list position-left"></i> Slider Property List</a></li>
            <li class="active">Create</li>
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
            <h5 class="panel-title">Create Slider Property List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <div class="row">
                <div class="col-md-8">
                    <form action="#" id="slider_property_list_create" autocomplete="off" >

                        <input type="hidden" value="Property" name="slider_element_type">
                        <input type="hidden"  name="slider_element_id" id="slider_element_id" >
                        <input type="hidden"  name="short_code" id="short_code" value="{{$short_code}}">
                        
        				<div class="row">
        						<!---Property Name-->
        						        <div class="form-group col-md-6 " id="propertybox">
                                            <label>Property</label>
                                            <div class="input-group">
                                                    <input type="text" class="form-control" id="property_id" placeholder="search by Property ID Ex. {{$short_code}}-10001">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default legitRipple" type="button" id="Search_by_id"><i class="glyphicon glyphicon-search"></i></button>
                                                    </span>

                                                </div>
                                                 <span  class="help-block"></span> 
                                        </div>
        							<!---Property Name-->
                                   

        						
        						<!---Property Name-->
        						<div class="form-group col-md-6" id="pagebox">
        							<label>Page Name</label>
        							<select class="bootstrap-select " data-width="100%"  name="page[]" id="showpage_id" multiple="true" >
        									<option disabled="true">Select Page</option>
        									<option value="Home">Home</option>
        									<option value="Agents">Agents</option>
        									<option value="Utility">Utility</option>
        									<option value="Owners">Owners</option>
        								</select>
        							 <span  class="help-block"></span> 
        						</div>
        						<!----/* Property Name---->

        				</div>
                        <?php foreach($OrderList as $Page=>$Data){ ?>
                        <div class="row Hide page-row" id="div-{{$Page}}">
                                <!---Property Name-->
                                <div class="form-group col-md-6">
                                    <label>{{$Page}} - Row</label>
                                    <select class="bootstrap-select order " data-width="100%"  name="row[{{$Page}}]" id="{{$Page}}row" onchange="ShowColumn('{{$Page}}' , this)">
                                            <option value="">Select Row</option>
                                            <?php foreach($Data as $row=>$value){ ?>
                                                <option value="{{$row}}">{{$row}}</option>
                                            <?php } ?>
                                    </select>
                                    <span  class="help-block"></span> 
                                </div>
                                    <!---Property Name-->
                                
                                <!---Property Name-->
                                <div class="form-group col-md-6" id="{{$Page}}column">
                                    <label>{{$Page}} - Column</label>
                                    <select class="bootstrap-select order" data-width="100%"  name="column[{{$Page}}]" id="{{$Page}}column">
                                            <option value="">Select Column</option>
                                    </select>
                                     <span  class="help-block"></span> 
                                </div>
                                <!----/* Property Name---->

                        </div>
        				<?php }  ?>
                        <div class="row">
                                <!---Property Name-->
                                <div class="form-group col-md-12" id="Datetimebox">

                                    <label>Datetime</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control daterange-time" value="<?php echo date('m/d/Y').' - '.date('m/d/Y'); ?>" id="Datetime" name="Datetime"> 
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
                                        <input name="amount" id="amount" type="text" name="text" class="touchspin-empty form-control" placeholder="amount" value="1">
                                        <span  class="help-block"></span> 

                                    </div>

                                </div>
                                <!---Property Name-->
                                <div class="form-group col-md-6" id="paymentbox">
                                    <label>Payment</label>
                                    <select class="bootstrap-select " data-width="100%"  name="Payment" id="Payment">
                                            <option disabled="true">Select Payment Status</option>
                                            <option value="Free">Free</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Paid">Paid</option>
                                    </select>
                                    <span  class="help-block"></span> 
                                </div>
                                <!----/* Property Name---->

                        </div>

        				<!--Form action-->
                        <div class="row">
                            <div class="col-md-12 text-right">
                               <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                                <button type="submit" id="slider_property_list_save" class="btn btn-primary legitRipple">Save Slider Property<i class="icon-paperplane position-right"></i></button>
                            </div>	
                        </div>
                   <!-- /* Form action -->
        			</form>
                </div>
                <div class="col-md-4">
                    <div class="" id="propertyDetails">
                        <img src="" class="img-responsive"  id="property_img"/>
                        <h3  id="property_title"></h3>
                        <p  id="property_prize"></p>
                        <p  id="property_user" ></p>
                        <strong  id="property_empty_msg" ></strong>
                    </div>
                </div>

    		</div>
    		
	   </div>
<textarea id="HiddenpageArray" class="Hide" value="<?php echo json_encode($OrderList); ?>"><?php echo json_encode($OrderList); ?></textarea>
@stop
  
  
  
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
    <script type="text/javascript" src="{{asset('Modules/Properties/Resources/assets/js/sliderControles.js')}}"></script>
    
@stop
  
