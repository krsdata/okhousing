@extends('admin::admin.master')
@section('title', "Admin News & Updates List")
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
        <li><a href="{{ URL::to('o4k/NewsUpdates')}}"><i class="icon-list position-left"></i>News & Updates management</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/NewsUpdates')}}"><i class="icon-list position-left"></i> News & Updates management</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - News & Updates List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit News & Updates <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="#" id="NewsUpdates_list_update" autocomplete="off" data-id="{{ $NewsUpdates->id}}"> 
                   

                     <input type="hidden" name="parent_id" id="parent_id" value="{{ $NewsUpdates->id}}">

                    <div class="row">
                      <!---Country-->
                        <div class="form-group col-md-6" id="countrybox">
                            <label>Country</label>
                            <select class="bootstrap-select " data-width="100%"  name="countries" id="country_id_edit">
                                <option value="" >Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}" data-flag="{{$country['created_countries']['flag']}}" @if($NewsUpdates->country_id == $country['id']) {{ 'selected' }} @endif >{{$country['created_countries']['name']}}</option>
                                    @endforeach
                            </select>
                            <span  class="help-block"></span> 
                        </div>
                        
                        <!----/* Country---->

                       
                </div>
                     <div class="lang_section" >

                       

                          @if(isset($languages))
                            @php  $i=0; @endphp
                            @foreach ($languages as $key => $value)
                               @if(\Illuminate\Support\Arr::exists($value, 'languages'))
                                
                                @php

                                    
                                   $NewsDetailsEach = Modules\Admin\Entities\NewsUpdates::where('language_id' ,$value['language_id'])->where('country_id',$value['created_country_id'])->where('id',$Ids[$i])->first();

                                

                                @endphp
                                <div class="row">
                                    <div class="langrow">
                                        

                                        <input type="hidden" name="desc_language[]" value="{{$value['language_id']}}">
                                            
                                        <input type="hidden" name="created_language_{{$value['language_id']}}" value="{{$value['language_id']}}">

                                        <input type="hidden" name="record[]" value="{{$Ids[$i]}}">

                                            
                                        <input type="hidden" name="created_country_{{$value['language_id']}}" value="{{$value['created_country_id']}}">

                                        <!---Property Name-->
                                        <div class="form-group col-md-6" id="title_{{$value['language_id']}}">
                                            <label>News title in {{$value['languages']['name']}}</label>
                                            <input id="title_{{$value['language_id']}}" name="title_{{$value['language_id']}}" type="text" class="form-control" placeholder="Enter Property Name in {{$value['languages']['name']}} " value="{{$NewsDetailsEach->title}}">
                                             <span  class="help-block"></span> 
                                        </div>
                                        <!----/* Property Name---->

                                        <div class="form-group col-md-6 " id="desc_{{$value['language_id']}}">
                                            <label>Description in {{$value['languages']['name']}}</label>
                                            <textarea rows="5" cols="5" class="form-control" placeholder="Property Description in {{$value['languages']['name']}}" name="desc_{{$value['language_id']}}" id= "description_{{$key+1}}" value="{{$NewsDetailsEach->content}}" >{{$NewsDetailsEach->content}}</textarea>
                                             <span  class="help-block"></span> 
                                        </div>
                                    </div>
                                </div>
                               
                               
                               @endif
                               @php $i++; @endphp
                           @endforeach
                         @endif 

                    </div>

            
                    <div class="row">
                        <div class="form-group col-md-6" id="imagebox">
                            <label>Image</label>
                            <input id="image" name="image" type="file" class="file-styled-primary">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <div class="form-group col-md-6" style="width:150px!important;margin-top:0px!important;margin-right:183px!important;
                                                float: right!important;">
                               @if ($NewsUpdates->image!='')
                                    <img src= "{{ URL::asset('public/images/NewsUpdates/'.$NewsUpdates->image) }} " style="width:100%;height:auto;" />
                                @else
                                    <img src="{{ asset('public/no-image.png') }}" style="width:100%;height:auto;" >
                                @endif
                            </div>
                        </div>
                       
                    </div>
                    
                 

                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="NewsUpdates_list_save" class="btn btn-primary legitRipple">Save News & Updates<i class="icon-paperplane position-right"></i></button>
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
   <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/NewsUpdatesControles.js')}}"></script>
    
@stop
  
