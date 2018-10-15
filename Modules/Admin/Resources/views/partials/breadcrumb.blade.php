   <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="{{URL('/o4k/FeaturedCategory/sectionlist')}}"><i class="icon-list position-left"></i><b>  {{$page_title ?? ''}} </b></a></li>
           
        </ul>

    </div>

    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - {{$page_title ?? ''}}s <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

       
    </div>