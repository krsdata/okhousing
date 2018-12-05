@extends('admin::admin.master')
@section('title', "Admin whyWe List")
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
        <li><a href="{{ URL::to('o4k/whyWe')}}"><i class="icon-list position-left"></i>Why We</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/whyWe')}}"><i class="icon-list position-left"></i> Why We</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Why We <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="#" id="whyWe_list_update" autocomplete="off" data-id="{{ $whyWe->id}}"> 
                   
                    <div class="row">
                    <!---Name-->
                        <input type="hidden" name="language_en" value="1">
                          <input type="hidden" name="id" value="{{$whyWe->id}}">
                        <div class="form-group col-md-6" id="titlebox_en">
                            <label>Title in English</label>
                            <input type="hidden" name="language_en" value="1">
                            <input  id= "title_en" name="title_en" type="text" class="form-control perm_text" placeholder="Enter title" data-lang="en" value="{{$whyWe->title}}">
                            
                             <span  class="help-block"></span> 
                        </div>
                       <div class="form-group col-md-6" id="subtitlebox_en">
                            <label>Sub Title in English</label>
                            <input type="hidden" name="language_en" value="1">
                            <input  id= "subtitle_en" name="subtitle_en" type="text" class="form-control perm_slug" placeholder="Enter sub title" data-lang="en" value="{{$whyWe->sub_title}}">
                            
                             <span  class="help-block"></span> 
                        </div>
                </div>
                    @php

                    $ids = $whyWe->types->pluck('id')->toArray();
                    $lang_ids = $whyWe->types->pluck('language_id')->toArray();
                    $titles = $whyWe->types->pluck('title')->toArray();
                    $subtitles = $whyWe->types->pluck('sub_title')->toArray();

                @endphp
                
                    @foreach($languages as $language)
                    <div class="row">
                            <?php 
                                if($lang_ids){
                                    $key = array_search($language->language_id,$lang_ids);
                                }
                              //  print_r($language);
                            ?>
                            <input type="hidden" name="language[]" value="{{$language->language_id}}">
                            <input type="hidden" name="ids[]" value="@if(!empty($whyWe->types[0])){{$ids[$key]}}@else{{$whyWe->id}}@endif" >
                            <div class="form-group col-md-6"  id="titlebox_{{$language->languages->lang_code}}">
                                <label>Title in {{$language->languages->name}}</label>
                                
                                <input id="title_{{$language->languages->lang_code}}" name="title[]" type="text" class="form-control perm_text" placeholder="Enter title" value="@if(!empty($whyWe->types[0])){{$titles[$key]}}@endif">
                                
                                <input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" value="@if(!empty($whyWe->types[0])){{$titles[$key]}}@endif">

                                 <span  class="help-block "></span> 
                            </div>

                            <div class="form-group col-md-6" id="subtitlebox_{{$language->languages->lang_code}}">
                                <label>Sub Title in {{$language->languages->name}}</label>
                                <input  type="text" id="subtitle_{{$language->languages->lang_code}}" name="subtitle[]"  class="form-control perm_slug" placeholder="Sub title"   value="@if(!empty($whyWe->types[0])){{$subtitles[$key]}}@endif">
                                 <span  class="help-block "></span> 
                            </div>

                        </div>
                        @endforeach
                           
            
                    <div class="row">
                        <div class="form-group col-md-6" id="imagebox_en">
                            <label>Image</label>
                            <input id="whyWe_image" name="whyWe_image" type="file" class="file-styled-primary">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                        <div class="form-group col-md-6" style="width:150px!important;margin-top:0px!important;margin-right:183px!important;float: right!important;">
                           @if ($whyWe->image!='')
                                <img src= "{{ URL::asset('public/images/whyWe/'.$whyWe->image) }} " style="width:100%;height:auto;" />
                            @else
                                <img src="{{ asset('public/no-image.png') }}" style="width:100%;height:auto;" >
                            @endif
                        </div>
                    </div>
                   

                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="whyWe_list_save" class="btn btn-primary legitRipple">Save<i class="icon-paperplane position-right"></i></button>
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
   <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/whyWeControles.js')}}"></script>
    
@stop
  
