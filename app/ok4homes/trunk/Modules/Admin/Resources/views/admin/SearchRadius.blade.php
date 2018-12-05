@extends('admin::admin.master')
@section('title', "Admin Mobile app ")
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
        <li class="active">Search Radius</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Search Radius</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Mobile app List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Search Radius <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{ URL('o4k/UpdateSearchRadius') }}" id="SearchRadiuslist_update" autocomplete="off" data-id="{{ $SearchRadius->id}}" method="POST"> 
                   
                   <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    
                   <div class="row">
                       <input type="hidden" name="id" value="{{$SearchRadius->id}}">
                        <div class="form-group col-md-6" id="titlebox_en">
                            <label>Search Radius</label>
                            <input  id= "radius" name="radius" type="number" class="form-control perm_text" placeholder="Enter radius" data-lang="en" value="{{$SearchRadius->radius}}" required="true">
                            
                             <span  class="help-block"></span> 
                        </div>
                     
                    </div>
                    
                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <button type="submit" class="btn btn-primary legitRipple">Save Search Radius<i class="icon-paperplane position-right"></i></button>
                        </div>  
                    </div>
               <!-- /* Form action -->
                </form>
            </div>
            
        </div>
        
    </div>

@stop
  
  
  
@section('js')
   @section('js')

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/MobileappControles.js')}}"></script>
    
@stop
  
