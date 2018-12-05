@extends('website::web.master')
@section('title', "Ok4Homes")

@section('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('public/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/fonts/gotham/stylesheet.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/css/register.css')}}" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('public/site/css/intlTelInput.css')}}">
     <link href="{{asset('public/web/css/customeStyle.css')}}" rel="stylesheet">
    
@stop




@section('content')
    @include('website::web.home.header')
    @include('website::web.home.banner')
    @include('website::web.home.featured')
    @include('website::web.home.explore_more')
    {{--@include('website::web.home.mobile_app')--}}
    @include('website::web.home.mobile_app')
    @include('website::web.home.builders')
    @include('website::web.home.preferred')
    @include('website::web.home.recent_properties')
    @include('website::web.home.news_updates')
    @include('website::web.home.top10')
    @include('website::web.home.advertise')
    @include('website::web.model.signin')
    @include('website::web.model.signup')
    @include('website::web.model.forgot_pass')
    @include('website::web.home.footer')
   
    @php

    $userCountry  =   Modules\Countries\Entities\Countries::with(['created_countries'=>function($query) {$query->where('status', 1);}])->get();
    $countryArray=array();
    foreach($userCountry as $row)
    {
        $countryArray[] = $row->created_countries->name;
    }
   
    @endphp
   <div class="modal fade notavailbecountry" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static">
        <div class="modal-dialog modal-lg list-detail" role="document">
            <div class="modal-content" id="PropertyDetails">
                
                 <div class="signin-box">
                        <div class="close-popup closenotavailbecountry " data-dismiss="modal" id=""><img src="{{asset('public/web/images/close.svg')}}" alt="" class="closenotavailbecountry"></div>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                     <p style="    margin-left: 7px; padding: 30px;font-size: 14px;font-weight: 600;">We are only available in <?php echo implode(" , ", $countryArray);?> . If you getting this message. Please turn off your data server or check browser settings or we are not providing services in your country.</p>
                                </div>
                                <s
                            </div>
                          
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <div id="OpennotavailbecountryModal" data-toggle="modal" data-target=".notavailbecountry" style="display:none;"></div>

@stop
@section('js')
 <script type="text/javascript">
      $( document ).ready(function() {
            $("#OpennotavailbecountryModal").trigger("click");
        });
      $(".closenotavailbecountry").click(function(){
        window.location.href = base_url;
      });
 </script>
 @stop
