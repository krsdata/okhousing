@extends('admin::admin.master')
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li class="active"><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Dashboard</a></li>
           
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4> <span class="text-semibold">Dashboard</span> <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

        
    </div>
@stop
