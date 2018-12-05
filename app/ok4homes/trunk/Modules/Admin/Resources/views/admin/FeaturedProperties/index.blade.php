@extends('admin::admin.master')
@section('title', "Admin Featured Property List")
@section('css')
 
 @stop
 
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="{{URL('/o4k/FeaturedProperties/')}}"><i class="icon-list position-left"></i>Featured Property List</a></li>
           
        </ul>

    </div>

        <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Property List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

        <div class="heading-elements">
           <a type="button" href="{{ URL::to('o4k/FeaturedProperties/create')}}" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple"><b><i class="icon-plus3"></i></b> Add Featured Property List</a>
       </div>
    </div>
@stop
 
 
 @section('content') 
    <div class="panel panel-flat">
        @if(Session::has('val')) 
            @if(Session::get('val')==1)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 14px;">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{Session::get('msg')}}
                </div>
            @endif
        @endif
        <div class="panel-heading">
            <div class="col-md-4">
                <h5 class="panel-title">Featured Property List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
            </div>
            <div class="col-md-8 ">
                    <div class="input-group pull-right">
                        <button type="button" class="btn bg-teal-400 btn-rounded legitRipple daterange-ranges">
                            <i class="icon-calendar22 position-left"></i> <span id="FilterSubscriptionDate"></span> <b class="caret"></b>
                        </button>
                    </div>

                    <form action="#" id="FilterSubscriptionForm" autocomplete="off" >
                        <input type="hidden" name="FilterSubscriptionDateStart" id="FilterSubscriptionDateStart">
                        <input type="hidden" name="FilterSubscriptionDateEnd" id="FilterSubscriptionDateEnd">
                    </form>
            </div>
            <br>
            <br>
        </div>
        
        <div class="panel-body">
            <table class="table datatable-basic table-bordered table-hover" id="property_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                         <th>Date</th>
                        <th>Amount</th>  
                        <th>Payment</th>    
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                    <tbody>  </tbody>
            </table> 
        </div>


    </div>

@stop
  
  
@section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/tables/datatables/datatables.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/custom/datatable-extend.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/FeaturedPropertyControles.js')}}"></script>


    <script type="text/javascript" src="{{asset('public/admin/js/plugins/notifications/jgrowl.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/anytime.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/picker.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/pickers/pickadate/legacy.js')}}"></script>

    <script type="text/javascript">
          // Initialize with options
    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(1, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            dateLimit: { days: 60 },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600 FilterSubscription',
            cancelClass: 'btn-small btn-default'
        },
        function(start, end) {
            $('.daterange-ranges span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $("#FilterSubscriptionDateStart").val(start.format('YYYY-MM-DD'));
            $("#FilterSubscriptionDateEnd").val(end.format('YYYY-MM-DD'));
           
        }
    );

    // Display date format
    $('.daterange-ranges span').html(moment().subtract(1, 'days').format('YYYY-MM-DD') + ' - ' + moment().format('YYYY-MM-DD'));

    $("#FilterSubscriptionDateStart").val(moment().subtract(1, 'days').format('YYYY-MM-DD'));
    $("#FilterSubscriptionDateEnd").val(moment().format('YYYY-MM-DD'));
           

    $(".FilterSubscription").click(function(){
                    /* server checking */
                $('.content-wrapper').block({
                    message: '<i class="icon-spinner9 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });

                    $.ajax({
                    type: "POST",
                    url: base_url+"/o4k/FeaturedProperties/Subscription", 
                    data: new FormData($('#FilterSubscriptionForm')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){
                        $(".panel-body").html(response.html);
                        $('#property_list').DataTable();
                        $('.content-wrapper').unblock();     
                    }else{
                        $('.content-wrapper').unblock();
                    }
                    },
                    error: function (request, textStatus, errorThrown) {

                        $('.content-wrapper').unblock();     

                    }
                   
                });
             
    });
    </script>

@stop
  
