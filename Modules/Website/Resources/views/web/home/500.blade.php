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
    @include('website::web.home.inner_header')
    @include('website::web.home.not_found')
    @include('website::web.model.signin')
    @include('website::web.model.signup')
    @include('website::web.model.forgot_pass')
    @include('website::web.home.footer')
   
@stop

 
 
