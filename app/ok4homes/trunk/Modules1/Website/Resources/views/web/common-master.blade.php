
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')
    @stack('style')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('public/web/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/web/fonts/gotham/stylesheet.css')}}" rel="stylesheet">
    <script> var base_url = "{{URL::to('/')}}"; </script>
    
    
</head>

<body>
@include('website::web.home.inner_header')
    @yield('content')
    
    @yield('js')
    @stack('scripts')
@include('website::web.home.footer')    
 
    <script src="{{asset('public/site/js/site.js')}}"></script>
</body>
</html>


