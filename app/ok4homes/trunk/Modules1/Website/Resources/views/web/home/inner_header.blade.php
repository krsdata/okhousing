@php
$fcountry_lang=Session::get('fcountry_lang');
@endphp

<!--header-->
<header class="inner-page">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                    <ul class="nav navbar-nav mobile">
                          <?php if(Auth::guard('front_user')->user()) { ?>
                            <li>
                                <a href="{{URL::to('/logout')}}" >
                                    <span class="icon"><img src="{{asset('public/web/images/icon-signin.png')}}" alt="" class="img-responsive"></span>
                                   Logout
                                </a>
                            </li>

                        <?php } else { ?>
                         <li><a href="#"><span class="icon"><img src="{{asset('public/web/images/icon-signin.png')}}" alt="" class="img-responsive"></span> {{trans('countries::home/home.sign_in')}}</a></li>
                        <li><a href="#"><span class="icon"><img src="{{asset('public/web/images/icon-register.png')}}" alt="" class="img-responsive"></span>{{trans('countries::home/home.register')}}</a></li>
                        <?php } ?>
                    </ul>
                    <a class="navbar-brand" href="#"><img src="{{asset('public/web/images/ok4-homes.png')}}" alt="" class="img-responsive"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <div class="nav-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#">{{trans('countries::home/home.menu_home')}}</a></li>
                            <li><a href="#">{{trans('countries::home/home.menu_rent')}}</a></li>
                            <li><a href="#">{{trans('countries::home/home.menu_agent')}}</a></li>
                            <li><a href="#">{{trans('countries::home/home.menu_Advice')}}</a></li>
                            <li><a href="#">{{trans('countries::home/home.menu_news')}}</a></li>
                            <li><a href="#">{{trans('countries::home/home.menu_contact')}}</a></li>
                        </ul>

                        <ul class="nav navbar-nav">

                             <!--lang-->
                            <li class="dropdown" id="fcountry_lang"></li>
                            <!--country-->
                            <li class="dropdown" id="fcountry"></li>

                        </ul>
                        <ul class="nav navbar-nav desktop">
                       <?php if(Auth::guard('front_user')->user()) { ?>
                        <li>
                                <a href="{{URL::to('/logout')}}" >
                                    <span class="icon"><img src="{{asset('public/web/images/icon-signin.png')}}" alt="" class="img-responsive"></span>
                                   Logout
                                </a>
                            </li>

                        <?php } else { ?>
                         
                            <li>
                                <a href="#" data-toggle="modal" data-target=".signin-box">
                                    <span class="icon"><img src="{{asset('public/web/images/icon-signin.png')}}" alt="" class="img-responsive"></span>
                                   {{trans('countries::home/home.sign_in')}} 
                                </a>
                            </li>
                            <li><a href="#" data-toggle="modal" data-target=".signup-box"><span class="icon"><img src="{{asset('public/web/images/icon-register.png')}}" alt="" class="img-responsive"></span>{{trans('countries::home/home.register')}}</a></li>
                       
                        <?php } ?>
                     </ul>
                    </div>

                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
