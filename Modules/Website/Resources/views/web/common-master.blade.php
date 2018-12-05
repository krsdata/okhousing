
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <meta property="og:url"                content="{{URL('/')}}" />
    <meta property="og:type"               content="ok4homes" />
    <meta property="og:title"              content="Apartment 1" />
    <meta property="og:description"        content="Apartment 1" />
    <meta property="og:image"              content="https://ok4homes.com/public/images/properties/1529566763.jpg" />

    @yield('css')
    @stack('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('public/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public/web/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/fonts/gotham/stylesheet.css')}}" rel="stylesheet">
    <script> var base_url = "{{URL::to('/')}}"; </script>
    <link rel="stylesheet" href="{{asset('public/site/css/intlTelInput.css')}}">
    <link href="{{asset('public/site/css/customeStyle.css')}}" rel="stylesheet">
    
     

    <script src="{{asset('public/js/jquery.min.js')}}"></script> 
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script> 
   
    <script src="{{asset('public/web/js/materialize.min.js')}}"></script>
    <script src="{{asset('public/web/js/slick.min.js')}}"></script>
    <script src="{{asset('public/site/js/plugin/intlTelInput.min.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXJxQZefgiAbDF2U7Qqv8PNoqBgRiYUc&libraries=places&sensor=false"></script>

 
    <link rel="stylesheet" href="{{asset('public/web/fonts/ruppee/font.css')}}">
      <link rel="stylesheet" href="{{asset('public/web/fonts/ruppee/font.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/web/fonts/ruppee/WebRupee.V2.0.eot')}}">
      <link rel="stylesheet" href="{{asset('public/web/fonts/ruppee/WebRupee.V2.0.svg')}}">
      <link rel="stylesheet" href="{{asset('public/web/fonts/ruppee/WebRupee.V2.0.ttf')}}">
      <link rel="stylesheet" href="{{asset('public/web/fonts/ruppee/WebRupee.V2.0.woff')}}">
     
  <style type="text/css">
         .slick-track {
        float: left !important;
    }
        body {
             background-color: #fff !important
        }
.property_deatil > h4 {
    width: 170px;
    font-size: 1.15em;
    font-weight: 600;
    color: #fff;
    max-width: 170px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.preLoad.addloader {
      position: absolute;
    left: 0% !important;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url({{asset('public/loader.gif')}}) center no-repeat #fff;
}

.preLoad.Noloader{
  display: none;
}
.preLoadSignup.addloader {
    background-image: url("{{asset('public/loader.gif')}}");
}
   
    .WebRupee {
        font-family: WebRupee !important;
    }

 </style>
 
</head>

<body>
    
    @php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$fcountry=Session::get('fcountry');
$currency_symbol = $fcountry['symbol'];

@endphp
<input  type="hidden"  name="country_code" id="country_code" value="{{$fcountry['flag']}}">
<input  type="hidden"  name="country_name" id="country_name" value="{{$fcountry['name']}}">
<input  type="hidden"  name="lat" id="lat" value="">
<input  type="hidden"  name="lng" id="lng" value="">

    <div class="modal fade modal1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg list-detail" role="document">
            <div class="modal-content" id="PropertyDetails">
                
            </div>
        </div>
    </div>


<div id="OpenPropertyDetailModal" data-toggle="modal" data-target=".modal1" style="display:none;"></div>

<style type="text/css">
     .fav-icon.inactive , i.inactive {
            background: #eceae5 !important;
            color: #292b2466;
        }

    /*---------------reset password-----------*/
        .changepass-box .btn .btnUpdatePassword
        {
                margin-top: 20px;
        }
        .changepass-box .Rpassword .val-error
        {
            padding-bottom: 25px;
        } 
        .changepass-box .Rpassword #Cpassword,
        .changepass-box .confirmPassword #confirmPassword
        {
            margin-bottom: 20px;
        }
span.success-msg {
    color: green;
    /* margin-top: 40px; */
}
</style>

@include('website::web.home.inner_header')
    @yield('content')
    
    @yield('js')
    @stack('scripts')
     @include('website::web.model.signin')
    @include('website::web.model.signup')
    @include('website::web.model.forgot_pass')
@include('website::web.home.footer')    
 

 <div class="modal fade changepass-box" tabindex="-1" role="dialog" aria-labelledby="changepass-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                    <form action="{{URL('/updatepassword')}}" autocomplete="off" name="updatepassword" id="updatepassword" >
      
                    <div class="signin-box">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <h3>{{trans('countries::home/home.change_pass')}}</h3>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div id="success-up"><span class="success-msg"></span></div>

                        <form action="{{URL('/forgotpass')}}" autocomplete="off" name="ResetPassword" id="ResetPassword" >
                            <div id="loginerror-fp"><span class="help-block"></span></div>
                             <!--div class="input-field oldpassword">
                                <input id="oldpassword" type="password" class="validate" name="oldpassword">
                                <label for="oldpassword" class="">Old Password</label>
                                <div class="val-error"></div>
                            </div-->
                            <div class="input-field Rpassword">
                                <input id="Cpassword" type="password" class="validate" name="Rpassword">
                                <label for="Rpassword" class="">{{trans('countries::home/home.change_new_pass')}}</label>
                                <div class="val-error"></div>
                            </div>
                            <div class="input-field confirmPassword">
                                <input id="confirmPassword" type="password" class="validate" name="confirmPassword" >
                                <label for="confirmPassword" class="">{{trans('countries::home/home.confirm_pass')}}</label>
                                <div class="val-error"></div>
                            </div>
                            <button class="btn btnUpdatePassword">{{trans('countries::home/home.change_pass')}}</button> 
                            </form>
                            </div>
                        </form>
                </div>
            </div>
        </div>

        
    <script src="{{asset('public/site/js/site.js')}}"></script>
     <script src="{{asset('public/site/js/front_users.js')}}"></script>
     <script type="text/javascript">
         
      

         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {

               
                $("#Gcode").intlTelInput({
                  initialCountry: "auto",
                  allowDropdown: false,
                  geoIpLookup: function(callback) {
                     var countryCode = document.getElementById("hidcode").value;
                    callback(countryCode);
                },
                  utilsScript: base_url+"/public/site/js/plugin/utils.js" // just for formatting/placeholders etc
                });
            });
     </script>
</body>
</html>

<script type="text/javascript">
    function AddClassToBody()
    {
        
        if (! $("body").hasClass("modal-open")) {
            $("body").css("overflow-y","hidden");
        }
        else
        {
             
        }
        
    }

    $( ".close-popup" ).click(function() {
      $("body").css("overflow-y","auto");
    });


</script>
@include('website::web.validation')
@include('website::web.property')
