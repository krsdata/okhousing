 <body class="navbar-bottom">

 <!-- Main navbar -->
    <div class="navbar navbar-inverse bg-indigo">
        <div class="navbar-header">
        <a class="navbar-brand" href="http://localhost/project/ok4housing-thai/trunk/o4k "><img style="height: 24px;" src="http://localhost/project/ok4housing-thai/trunk/public/images/logo.png" alt=""></a>
        <ul class="nav navbar-nav visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>


        <ul class="nav navbar-nav navbar-right">
       



        <li class="dropdown dropdown-user">
        <a class="dropdown-toggle" data-toggle="dropdown">
        <img src="http://localhost/project/ok4housing-thai/trunk/public/images/placeholder.jpg" alt="">
        <span>Ok4Homes</span>
        <i class="caret"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="{{url('o4k/dashboard')}}"><i class="icon-home2"></i>Dashboard</a></li>  
        <li><a href="{{url('o4k/logout')}}"><i class="icon-switch2"></i> Logout</a></li>
        </ul>
        </li>
        </ul>
        </div>
    </div>
    <!-- /main navbar -->
