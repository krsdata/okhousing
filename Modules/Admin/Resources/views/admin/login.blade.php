<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ok4homes Login</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Global stylesheets --> 
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('public/admin/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/admin/css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/admin/css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/admin/css/colors.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	 <!--   JS files -->
	 <script type="text/javascript" src="{{asset('public/js/jquery.min.js')}}"></script>
	  <!-- /  JS files -->
     
        <style>
              .Page_Center{margin:auto;position: absolute;top: 0;left: 0;bottom: 0;right: 0;max-width: 300px;max-height: 400px}
        </style>
    <script>
    var base_url = "{{URL::to('/')}}";
    </script>
    
</head>

<body>
    
    <div class="Page_Center">
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!--   login form -->
                    <form action="{{URL('/o4k/post_login')}}" autocomplete="off" name="login" id="login" >
                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                    <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                                </div>
 
                                <div class="form-group  has-feedback has-feedback-left" id="emailBox">
                                    <input type="text" class="form-control" placeholder="Email" name="email" >
                                    <div class="form-control-feedback"> <i class="icon-user text-muted"></i> </div>
                                    <span class="help-block"></span> 
                                </div>

                                <div class="form-group has-feedback has-feedback-left" id="passwordBox">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    <div class="form-control-feedback" > <i class="icon-lock2 text-muted"></i></div>
                                    <span class="help-block"></span>
                                </div>
                                <div id="login_error" style="color: red;margin-bottom: 10px"></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
                                </div>
                                
                            </div>
                    </form>
                    <!-- /  login form --> 
                </div>
                <!-- /main content --> 
            </div>
            <!-- /page content --> 
        </div>
        <!-- /page container -->
    </div>  
<!-- Common  -->
<script src="{{asset('Modules/Admin/Resources/assets/js/login.js')}}"></script>
<script src="{{asset('Modules/Admin/Resources/assets/js/CheckLogin.js')}}"></script>
</body>
</html>
