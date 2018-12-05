@extends('admin::admin.master')
@section('title', "Admin CategoryType List")
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
        <li><a href="{{ URL::to('o4k/CategoryType')}}"><i class="icon-list position-left"></i>Category Type management</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/CategoryType')}}"><i class="icon-list position-left"></i> Category Type management</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Category Type List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Category Type <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="#" id="CategoryType_list_update" autocomplete="off" data-id="{{ $CategoryType->id}}"> 
                   
                    <div class="row">
                    <!---Name-->
                        <input type="hidden" name="language_en" value="1">
                          <input type="hidden" name="id" value="{{$CategoryType->id}}">
                        <div class="form-group col-md-6" id="namebox_en">
                            <label>Title in English</label>
                            <input type="hidden" name="language_en" value="1">
                            <input  id= "title_en" name="title_en" type="text" class="form-control perm_text" placeholder="Enter title" data-lang="en" value="{{$CategoryType->title}}">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                         <div class="form-group col-md-6" id="statusbox">
                                <label>Status</label>
                                <select class="bootstrap-select " data-width="100%"  name="status" id="status">
                                       <option disabled="true">Select Status</option>
                                        <option value="1"  @if($CategoryType->status == '1') selected @endif >Active</option>
                                        <option value="0" @if($CategoryType->status == '0') selected @endif >Inactive</option>
                                </select>
                                <span  class="help-block"></span> 
                            </div>
                </div>
                    @php

                    $ids = $CategoryType->types->pluck('id')->toArray();
                    $lang_ids = $CategoryType->types->pluck('language_id')->toArray();
                    $titles = $CategoryType->types->pluck('title')->toArray();
                    $slugs = $CategoryType->types->pluck('slug')->toArray();

                @endphp
                 <div class="row">
                    @foreach($languages as $language)
                   
                            <?php 
                                if($lang_ids){
                                    $key = array_search($language->language_id,$lang_ids);
                                }
                              //  print_r($language);
                            ?>
                            <input type="hidden" name="language[]" value="{{$language->language_id}}">
                            <input type="hidden" name="ids[]" value="@if(!empty($CategoryType->types[0])){{$ids[$key]}}@else{{$CategoryType->id}}@endif" >
                            <div class="form-group col-md-6"  id="namebox_{{$language->languages->lang_code}}">
                                <label>Name in {{$language->languages->name}}</label>
                                
                                <input id="title_{{$language->languages->lang_code}}" name="title[]" type="text" class="form-control perm_text" placeholder="Enter title" value="@if(!empty($CategoryType->types[0])){{$titles[$key]}}@endif">
                                
                                <input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" value="@if(!empty($CategoryType->types[0])){{$titles[$key]}}@endif">

                                 <span  class="help-block "></span> 
                            </div>
                       
                        @endforeach
                            </div>
            
                    
                   

                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="CategoryType_list_save" class="btn btn-primary legitRipple">Save Category Type<i class="icon-paperplane position-right"></i></button>
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
   <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/CategoryTypeControles.js')}}"></script>
    
@stop
  
