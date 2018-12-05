@extends('admin::admin.master')
@section('title', "Admin Countries")
@section('css')
 
 @stop
 
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/countries')}}"><i class="icon-list position-left"></i> Countries</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/countries')}}"><i class="icon-list position-left"></i> Countries</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Countries <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Country<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
            <form action="#" id="country_update" enctype="multipart/form-data" data-id="{{$country['id']}}">

                <!--Name & Country Code-->
                <div class="row">
                    <div class="form-group col-md-6 " id="countryBox">
                            <label>Name<span class="text-danger">*</span></label>
                           <input id="country_name" name="countryname" type="text" readonly class="form-control" placeholder="Enter Country Name" value="{{$country['created_countries']['name']}}">
                           <input   type="hidden"  value="{{$country['created_countries']['id']}}" name="hidcountryId">
                            <span class="help-block"></span> 
                     </div>
                    <div class="form-group col-md-6" id="CountryCodeBox">
                            <label>Country Code<span class="text-danger">*</span></label>
                            <input id="country_code" type="text" name="code" readonly class="form-control" placeholder="Country Code" value="{{$country['created_countries']['code']}}">
                            <span class="help-block"></span>
                    </div>
                </div>
                <!-- /* Name & Country Code-->

                <!--  Flag & Currency-->
                <div class="row">
                    <div class="form-group col-md-6" id="flagBox">
                            <label>Flag<span class="text-danger">*</span></label>
                            <img style="border-radius: 0; display: block;" id="flag_img" src="{{asset('public/admin/images/flags/')}}/{{$country['created_countries']['flag']}}.png" class="img-circle img-md" alt="">
                            <input id="flag_code" name="flag" readonly class="form-control" placeholder="Symbol" type="hidden" value="{{$country['created_countries']['flag']}}">
                            <span class="help-block"></span> 
                    </div>
                    <div class="form-group col-md-6" id="CurrencyBox">
                            <label>Currency<span class="text-danger">*</span></label>
                            <input id="currency" type="text" name="currency" readonly class="form-control" placeholder="Currency" value="{{$country['created_countries']['currency']}}">
                            <span class="help-block"></span> 
                    </div>
                </div>
                <!-- /* Flag & Currency-->

                <!-- Currency Code & Symbol-->
                <div class="row">
                    <div class="form-group col-md-6" id="CurrencyCodeBox">
                            <label>Currency Code<span class="text-danger">*</span></label>
                            <input id="currency_code" type="text" name="currency_code" readonly class="form-control" placeholder="Currency Code" value="{{$country['created_countries']['currency_code']}}">
                            <span class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6" id="SymbolBox">
                            <label>Symbol<span class="text-danger">*</span></label>
                            <input id="symbol" type="text" name="symbol" readonly class="form-control" placeholder="Symbol" value="{{$country['created_countries']['symbol']}}">
                            <span class="help-block"></span>
                    </div>

                </div>
                <!-- /*Currency Code & Symbol-->

                <!-- Status-->
                <div class="row">
                    <div class="form-group col-md-6" id="Status">
                            <label>Status<span class="text-danger">*</span></label>
                            <select class="bootstrap-select" name="status" data-width="100%">
                                    <option value="1" {{($country['created_countries']['status']==1)?'selected':''}} >Active</option>
                                    <option value="0" {{($country['created_countries']['status']==0)?'selected':''}}>Inactive</option>
                            </select>
                            <span class="help-block"></span>
                    </div>
                </div>
                <!-- /*Status-->

                <!--Default language-->
                <div class="row">
                    <div class="form-group col-md-6" id="setlanguage">
                    <label class="display-block text-semibold">Do you want to set english as your default language?<span class="text-danger">*</span></label>
                     <span class="help-block"></span>
                     <span   class="label border-left-danger label-striped"></span><br>
                    <div style="margin-top: -15px;">
                        <label class="checkbox-inline" style="padding-left: 0px !important;">
                            <input id="set_lang1" type="radio" class="checker border-success text-success-600  CheckboxStyle setlang" name="setlangs[]" value="1"  {{($defaultlang->isDefault==1)?'checked':''}}>
                            Yes
                        </label>
                        <label class="checkbox-inline">
                            <input id="set_lang2" type="radio" class="checker border-success text-success-600  CheckboxStyle setlang" name="setlangs[]" value="0" {{($defaultlang->isDefault==0)?'checked':''}}>
                            No
                        </label>
                    </div>
                    </div>

                    <div class="form-group col-md-6">
                        <button type="button" style="top: 15px;" class="btn btn-primary legitRipple pull-right" id="add_language_row" ><i class="icon-plus3"></i>
                                Add Language
                            </button>
                    </div>
                </div>
                <!-- /* Default language-->
                
                <!-- /* Languages & Font -->
                <div class="country_section">
                    <legend class="text-bold">Select Languages & Upload Font</legend>
                    <span class="help-block langErr" style="margin-top: -12px;padding-bottom: 5px"></span>
                    @if(count($countrylang) >0)
                    @foreach($countrylang as $key=>$lang)
                    
                    <div class="row lang_section" data-id="{{$key+1}}" data-default="1">
                       
                    <!-- Languages -->
                    <div class="form-group col-md-5 Language_error" id="Language_error_{{$key+1}}">
                        <label>Language</label>   
                        <select id="lang_{{$key+1}}" class="select-search language_sel" name="languages[]" data-width="100%"  >
                            <option value="">Select</option>
                            @foreach($languages as $language)
                            <option value="{{$language->id}}" @if(in_array($language->id,array($lang->languages->id))) selected @endif>{{$language->name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <!-- /* Languages -->
                    
                    <!-- Languages Font -->
                    <div class="form-group col-md-4 Language_Font_error" id="LanguageFont_error_{{$key+1}}">
                        <label>Language Font</label><br>
                        <div class="uploader">
                        <input name="fonts[]" type="file" id="font_{{$key+1}}"   class="file-styled-primary fonts_sel font-select" >
                        <input name="fonts[]" type="hidden" id="font_{{$key+1}}"   value="{{$lang->font_path}}" >
                        </div>
                        <span class="help-block"></span>
                    </div>
                    <!-- /* Languages Font-->
                    
                    <!-- Is default -->
                    <div class="col-md-1" style="padding-top:5px !important">
                        <label>Is default</label><span class="myradio"></span>
                        <div class="defaults">
                            <input id="default_{{$key+1}}" type="radio" class="checker border-success text-success-600 is_default" name="isDefault[]" value="1" {{($lang->isDefault==1)?'checked':''}}>
                        </div>
                        <span class="help-block"></span>
                    </div>
                    <!-- /* Is default -->
                    
                    <!-- Is Active -->
                    <div class="col-md-1" style="padding-top:5px !important">
                        <label>Is Active</label><span class="mychk"></span>
                        <div class="ActiveIs">
                            <input id="active_{{$key+1}}" type="checkbox" class="checker border-success text-success-600 is_active" name="lang_status[]" value="1" {{($lang->is_active==1)?'checked':''}}>
                         </div>
                        <span class="help-block"></span>
                    </div>
                    <!--/* Is Active -->
                    <!-- Remove -->
                    <div class="col-md-1" style="padding-top:20px !important;padding-left: 11px;">
                        <button  type="button"  class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple remove_lang">
                            <i class="icon-trash"></i>
                        </button>
                    </div>
                    <!--/* Remove -->
                    <hr class="col-md-12">
                    </div>
                @endforeach
                @else
                         <div class="row lang_section" data-id="1">
                       
                    <!-- Languages -->
                    <div class="form-group col-md-5 Language_error" id="Language_error_1">
                        <label>Language</label>   
                        <select id="lang_1" class="select-search" name="languages[]" data-width="100%"  >
                            <option value="">Select</option>
                            @foreach($languages as $language)
                            <option value="{{$language->id}}" >{{$language->name}}</option>
                            @endforeach
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <!-- /* Languages -->
                    
                    <!-- Languages Font -->
                    <div class="form-group col-md-4 Language_Font_error" id="LanguageFont_error_1">
                        <label>Language Font</label><br>
                        <div class="uploader">
                        <input name="fonts[]" type="file" id="font_1"   class="file-styled-primary fonts_sel font-select" >
                        </div>
                        <span class="help-block"></span>
                    </div>
                    <!-- /* Languages Font-->
                    
                    <!-- Is default -->
                    <div class="col-md-1" style="padding-top:5px !important">
                        <label>Is default</label><span class="myradio"></span>
                        <div class="defaults">
                            <input id="default_1" type="radio" class="checker border-success text-success-600 is_default" name="isDefault[]" value="1">
                        </div>
                        <span class="help-block"></span>
                    </div>
                    <!-- /* Is default -->
                    
                    <!-- Is Active -->
                    <div class="col-md-1" style="padding-top:5px !important">
                        <label>Is Active</label><span class="mychk"></span>
                        <div class="ActiveIs">
                            <input id="active_1" type="checkbox" class="checker border-success text-success-600 is_active" name="lang_status[]" value="1" checked>
                         </div>
                        <span class="help-block"></span>
                    </div>
                    <!--/* Is Active -->
                    <!-- Remove -->
                    <div class="col-md-1" style="padding-top:20px !important;padding-left: 11px;">
                        <button  type="button"  class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded legitRipple remove_lang">
                            <i class="icon-trash"></i>
                        </button>
                    </div>
                    <!--/* Remove -->
                    <hr class="col-md-12">
                    </div>
                    @endif

                </div>
                <!-- /* Languages & Font -->
                
                
                
                
<!--                <div class="col-md-12">&nbsp;</div>
                <div class="col-md-12">&nbsp;</div>-->
                <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                        
                        <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                        <button type="submit" id="country_save" class="btn btn-primary legitRipple">Save Country <i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
                <!-- /* Form action -->

            </form>  
        </div>
    </div>
 
 
 
 

@stop
  
  
@section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Countries/Resources/assets/js/AdminCountriesControles.js')}}"></script>
@stop
  
