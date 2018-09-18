@php
$fcountry_lang=Session::get('fcountry_lang');
$ffcountry_language = Session::get('fcountry_language');
$Selected_lang = $ffcountry_language['id'];
$fcountry=Session::get('fcountry');


@endphp



  <!--header-->
       <header>
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
                             <?php 
                                 $user=Modules\Users\Entities\Users::with('created_properties')->where('id',Auth::guard('front_user')->user()->id)->first();

                                  $AboutUs = $UserName ='User';
                                    $userCountry = Modules\Users\Entities\UserCountry::where('user_id',Auth::guard('front_user')->user()->id)->first();
                                    $user_countries_id = $userCountry->id;

                                    $resultData = Modules\Users\Entities\UserDetails::where('user_countries_id',$user_countries_id)->where('language_id',$Selected_lang)->first();
                                    if($resultData){
                                            $UserName = @$resultData->name;
                                    }
                                ?>

                             <li class="dropdown userBox">
                                <a href="{{ URL('/dashboard')}}" class="dropdown-toggle userBoxA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{asset('public/images/user_pics')}}/{{$user->image}}" class="userImage" onerror="this.src='{{asset('public/no-image.png')}}';" >
                                    <span class="userName">{{$UserName}}</span>
                                    <span class="caret caret_custom"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL('/dashboard')}}">{{trans('countries::home/home.dashboard')}} </a></li>

                                    <li><a href="#" data-toggle="modal" data-target=".changepass-box">{{trans('countries::home/home.changepass')}} </a></li>
                                    <li><a href="{{URL::to('/logout')}}"> {{trans('countries::home/home.logout')}} </a></li>
                                </ul>
                            </li>

                        <?php } else { ?>
                          <li>
                                <a href="#" id="opensignin" data-toggle="modal" data-target=".signin-box"  onclick="AddClassToBody()" >
                                    <span class="icon"><img src="{{asset('public/web/images/icon-signin.png')}}" alt="" class="img-responsive"></span>
                                   {{trans('countries::home/home.sign_in')}} 
                                </a>
                            </li>
                            <li>
                              <a href="#" data-toggle="modal" data-target=".signup-box"  onclick="AddClassToBody()" >
                                <span class="icon"><img src="{{asset('public/web/images/icon-register.png')}}" alt="" class="img-responsive"></span>
                              {{trans('countries::home/home.register')}}</a>
                            </li>

                        <?php } ?>
                    </ul>
                    <a class="navbar-brand" href="{{ URL('/')}}"><img src="{{asset('public/web/images/ok4-homes.png')}}" alt="" class="img-responsive"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <div class="nav-right">
                      <ul class="nav navbar-nav">
                             @php
                                    $fcountry_lang=Session::get('fcountry_lang');
                                    $ffcountry_language = Session::get('fcountry_language');
                                    $Selected_lang = $ffcountry_language['id']; 
                                    $fcountry=Session::get('fcountry');
                             @endphp

                            @php $Menu = Modules\Admin\Entities\Menu::where('language_id',$Selected_lang)->orderBy('id', 'DESC')->where('status',1)->get(); @endphp
                            @foreach($Menu as $menu)
                            <li><a href="{{$menu->link}}">{{$menu->title}}</a></li>
                            @endforeach
                        </ul>
                        <ul class="nav navbar-nav">
                            <!--lang-->
                            <li class="dropdown" id="fcountry_lang"></li>
                            <!--country-->
                            <li class="dropdown" id="fcountry"></li>

                        </ul>

                         <ul class="nav navbar-nav desktop">
                       <?php if(Auth::guard('front_user')->user()) { ?>
                            <li class="dropdown userBox">
                                <a href="{{ URL('/dashboard')}}" class="dropdown-toggle userBoxA" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{asset('public/images/user_pics')}}/{{$user->image}}" class="userImage" onerror="this.src='{{asset('public/no-image.png')}}';">
                                    <span class="userName">{{$UserName}}</span>
                                    <span class="caret caret_custom"></span>
                                </a>
                                <ul class="dropdown-menu">
                                     <li><a href="{{ URL('/dashboard')}}">{{trans('countries::home/home.dashboard')}} </a></li>

                                    <li><a href="#" data-toggle="modal" data-target=".changepass-box">{{trans('countries::home/home.changepass')}} </a></li>
                                    <li><a href="{{URL::to('/logout')}}"> {{trans('countries::home/home.logout')}} </a></li>
                                </ul>
                            </li>

                        <?php } else { ?>
                         
                            <li>
                                <a href="#" data-toggle="modal" data-target=".signin-box"  onclick="AddClassToBody()" >
                                    <span class="icon"><img src="{{asset('public/web/images/icon-signin.png')}}" alt="" class="img-responsive"></span>
                                   {{trans('countries::home/home.sign_in')}} 
                                </a>
                            </li>
                            <li><a href="#" data-toggle="modal" data-target=".signup-box"  onclick="AddClassToBody()" ><span class="icon"><img src="{{asset('public/web/images/icon-register.png')}}" alt="" class="img-responsive"></span>{{trans('countries::home/home.register')}}</a></li>
                       
                        <?php } ?>
                     </ul>
                     
                    </div>

                </div>
            </div>
        </nav>
    </header>        
<!--/header-->

