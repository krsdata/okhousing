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
        <li><a href="{{ URL::to('o4k/mobileapp')}}"><i class="icon-list position-left"></i>Mobile app management</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/mobileapp')}}"><i class="icon-list position-left"></i> Mobile app management</a></li>
            <li class="active">Edit</li>
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
            <h5 class="panel-title">Edit Mobile app <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="#" id="Mobileapp_list_update" autocomplete="off" data-id="{{ $Mobileapp->id}}"> 
                   
                    <div class="row">
                    <!---Name-->
                        <input type="hidden" name="language_en" value="1">
                          <input type="hidden" name="id" value="{{$Mobileapp->id}}">
                        <div class="form-group col-md-6" id="titlebox_en">
                            <label>Title in English</label>
                            <input type="hidden" name="language_en" value="1">
                            <input  id= "title_en" name="title_en" type="text" class="form-control perm_text" placeholder="Enter title" data-lang="en" value="{{$Mobileapp->title}}">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                        <div class="form-group col-md-6" id="sub_titlebox_en" >
                            <label>Sub title In Englist</label>
                                <input id="sub_title_en"  type="text" name="sub_title_en"  class="form-control perm_slug" placeholder="Sub title "  value="{{$Mobileapp->sub_title}}">
                                 <span  class="help-block"></span> 
                        </div>
                    </div>
                    @php

                    $ids = $Mobileapp->types->pluck('id')->toArray();
                    $lang_ids = $Mobileapp->types->pluck('language_id')->toArray();
                    $titles = $Mobileapp->types->pluck('title')->toArray();
                    $sub_title = $Mobileapp->types->pluck('sub_title')->toArray();

                @endphp
                    @foreach($languages as $language)
                    <div class="row">
                            <?php 
                                if($lang_ids){
                                    $key = array_search($language->language_id,$lang_ids);
                                }
                            ?>
                            <input type="hidden" name="language[]" value="{{$language->language_id}}">
                            <input type="hidden" name="ids[]" value="@if(!empty($Mobileapp->types[0])){{$ids[$key]}}@else{{$Mobileapp->id}}@endif" >
                            <div class="form-group col-md-6"  id="titlebox_{{$language->languages->lang_code}}">
                                <label>Title in {{$language->languages->name}}</label>
                                <input id="title_{{$language->languages->lang_code}}" name="title[]" type="text" class="form-control perm_text" placeholder="Enter title" value="@if(!empty($Mobileapp->types[0])){{$titles[$key]}}@endif">
                                <input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" value="@if(!empty($Mobileapp->types[0])){{$titles[$key]}}@endif">
                                 <span  class="help-block "></span> 
                            </div>
                            <div class="form-group col-md-6" id="sub_titlebox_{{$language->languages->lang_code}}">
                                <label>Sub title In {{$language->languages->name}}</label>
                                <input  type="text" id="sub_title_{{$language->languages->lang_code}}" name="sub_title[]"  class="form-control perm_slug" placeholder="Mobile app "   value="@if(!empty($Mobileapp->types[0])){{$sub_title[$key]}}@endif">
                                 <span  class="help-block "></span> 
                            </div>
                        </div>
                        @endforeach

            
                    <div class="row">
                        <div class="form-group col-md-6" id="imagebox_en">
                            <label>Image</label>
                            <input id="mobileapp_image" name="mobileapp_image" type="file" class="file-styled-primary">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                        <div class="form-group col-md-6" style="width:150px!important;margin-top:0px!important;margin-right:183px!important;
                                                float: right!important;">
                           @if ($Mobileapp->image!='')
                                <img src= "{{ URL::asset('public/images/Mobileapp/'.$Mobileapp->image) }} " style="width:100%;height:auto;" />
                            @else
                                <img src="{{ asset('public/no-image.png') }}" style="width:100%;height:auto;" >
                            @endif
                        </div>
                    </div>
                 

                    <div class="row">
                        <div class="form-group col-md-6" id="appstore_statusbox">
                            <label>Appstore Status</label>
                            <select class="bootstrap-select " data-width="100%"  name="appstore_status" id="appstore_status">
                                <option disabled="true">Select Appstore Status</option>
                                <option value="1"  @if($Mobileapp->appstore_status == '1') selected @endif >Active</option>
                                <option value="0" @if($Mobileapp->appstore_status == '0') selected @endif >Inactive</option>
                                </select>
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                         <div class="form-group col-md-6" id="googleplay_statusbox">
                            <label>Google Play Store Status</label>
                            <select class="bootstrap-select " data-width="100%"  name="googleplay_status" id="googleplay_status">
                                <option disabled="true">Select Google Play Store Status</option>
                                <option value="1"  @if($Mobileapp->googleplay_status == '1') selected @endif >Active</option>
                                <option value="0" @if($Mobileapp->googleplay_status == '0') selected @endif >Inactive</option>
                                </select>
                             <span  class="help-block"></span> 
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6" id="appstore_imagebox">
                            <label>Appstore Image</label>
                            <input id="appstore_image" name="appstore_image" type="file" class="file-styled-primary">
                             <span  class="help-block"></span> 

                            <div  style="width:150px!important;margin-top10px!important;">
                                @if ($Mobileapp->appstore_image!='')
                                    <img src= "{{ URL::asset('public/images/Mobileapp/'.$Mobileapp->appstore_image) }} " style="width:100%;height:auto;" />
                                @endif
                            </div>

                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                         <div class="form-group col-md-6" id="googleplay_imagebox">
                            <label>Google Play Store Image</label>
                            <input id="googleplay_image" name="googleplay_image" type="file" class="file-styled-primary">
                             <span  class="help-block"></span> 

                             <div  style="width:150px!important;margin-top10px!important;">
                                @if ($Mobileapp->googleplay_image!='')
                                    <img src= "{{ URL::asset('public/images/Mobileapp/'.$Mobileapp->googleplay_image) }} " style="width:100%;height:auto;" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" id="appstore_linkbox">
                            <label>Appstore Link</label>
                            <input id="appstore_link" name="appstore_link" type="text" class="form-control" value="{{$Mobileapp->appstore_link}}">
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                         <div class="form-group col-md-6" id="googleplay_linkbox">
                            <label>Google Play Store Link</label>
                            <input id="googleplay_link" name="googleplay_link" type="text" class="form-control" value="{{$Mobileapp->googleplay_link}}">
                             <span  class="help-block"></span> 
                        </div>
                    </div>

                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="Mobile app_list_save" class="btn btn-primary legitRipple">Save Mobile app<i class="icon-paperplane position-right"></i></button>
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
  
