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
    <script> var base_url = "{{URL::to('/')}}"; </script>
</head>

<body>
    @yield('content')
    @yield('js')
    
    @stack('scripts')
    <script src="{{asset('public/site/js/site.js')}}"></script> 
    <script src="{{asset('public/site/js/plugin/intlTelInput.min.js')}}"></script>
</body>
</html>
