@extends('admin::admin.master')
@section('title', "Admin Category List")
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
        <li><a href="{{ URL::to('o4k/Category')}}"><i class="icon-list position-left"></i>Category management</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/Category')}}"><i class="icon-list position-left"></i> Category management</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Category List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Create Category <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="#" id="Category_list_create" autocomplete="off" > 
                   
                    <div class="row">
                    <!---Name-->
                        <input type="hidden" name="language_en" value="1">
                        <div class="form-group col-md-6" id="titlebox_en">
                            <label>Title in English</label>
                            <input type="hidden" name="language_en" value="1">
                            <input  id= "title_en" name="title_en" type="text" class="form-control perm_text" placeholder="Enter title" data-lang="en">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <div class="form-group col-md-6" id="statusbox">
                                <label>Status</label>
                                <select class="bootstrap-select " data-width="100%"  name="status" id="status">
                                        <option disabled="true">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                </select>
                                <span  class="help-block"></span> 
                            </div>
                </div>
                <div class="row">

                     <div class="form-group col-md-6" id="CategoryTypebox">
                                <label>Category Type</label>
                                <select class="bootstrap-select " data-width="100%"  name="CategoryType" id="CategoryType">
                                        <option disabled="true">Select Category Type</option>
                                        @foreach($CategoryType as $Type)
                                        <option value="{{$Type->id}}">{{$Type->title}}</option>
                                        @endforeach
                                </select>
                                <span  class="help-block"></span> 
                            </div>

                    @foreach($languages as $language)
                    
                            <input type="hidden" name="language[]" value="{{$language->language_id}}">
                            <div class="form-group col-md-6"  id="titlebox_{{$language->languages->lang_code}}">
                                <label>Title in {{$language->languages->name}}</label>
                                <input id="title_{{$language->languages->lang_code}}" name="title[]" type="text" class="form-control perm_text" placeholder="Enter Title" >
                                <input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" >
                                 <span  class="help-block "></span> 
                            </div>
                     @endforeach
                       </div>
                     
    		

    				<!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="Category_list_save" class="btn btn-primary legitRipple">Save Category<i class="icon-paperplane position-right"></i></button>
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
   <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/CategoryControles.js')}}"></script>
    
@stop
  
