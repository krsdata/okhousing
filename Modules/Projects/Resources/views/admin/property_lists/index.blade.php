@extends('admin::admin.master')
@section('title', "Admin Property List")
@section('css')
 
 @stop
 
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="{{URL('/o4k/property_types/')}}"><i class="icon-list position-left"></i> Property List</a></li>
           
        </ul>

    </div>

        <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Property List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

        <div class="heading-elements">
           <a type="button" href="{{ URL::to('o4k/property_list/create')}}" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple"><b><i class="icon-plus3"></i></b> Add Property List</a>

          

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
            <h5 class="panel-title">@if($id == 1) India @else Thailand @endif Property List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a> &nbsp; &nbsp;
                <!--select class="pull-right" id="FilterCountry" onchange="FilterCountry()">
               <option value="0">All</option>
               <option value="1">India</option>
               <option value="2">Thialand</option>
           </select>
           <label  class="pull-right" ><b>Select country : </b>&nbsp; &nbsp;</label-->
          </h5>
          <input type="hidden" id="FilterCountry" value="{{$id}}">
        </div>
        
        <div class="panel-body">
            <table class="table datatable-basic table-bordered table-hover" id="property_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Category</th>  
                        <th>Created at</th>  
                        <th>Status</th>
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
	<script type="text/javascript" src="{{asset('Modules/Properties/Resources/assets/js/propertylistControles.js')}}"></script>
@stop
  
