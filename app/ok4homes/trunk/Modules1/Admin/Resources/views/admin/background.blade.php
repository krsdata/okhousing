@extends('admin::admin.master')
@section('title', "Admin User")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Admin Home:Backround Image</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Admin Home:Backround Image</li>
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
            <h5 class="panel-title">Home:Backround Image<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="#" id="backround_img_form" autocomplete="off" data-id="{{$image->id}}">
           <input type="hidden" name="id" value="{{$image->id}}">
           <div class="row">
                   <div class="form-group col-md-6" id="imagebox">
                        <label >Backround Image</label> 
                        
                        <div class="media no-margin-top">
                        @if($image->image!="")
                            <div class="media-left">
                            <a href="#"><img src="{{asset('public/images/Background/')}}/{{$image->image}}" style="margin-bottom: 10px;" alt=""></a>
                            </div>
                        @endif
                        <input name="image" id="image" type="file" class="file-styled-primary" required="true"> 
                        </div>
                        <span class=".help-block"></span>
                    </div>
                </div>
            
           
            <!--Form action-->
                 <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" id="admin_edits" class="btn btn-primary legitRipple">Save <i class="icon-paperplane position-right"></i></button>
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
