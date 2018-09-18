@extends('admin::admin.master')
@section('title', "Admin Property List")
@section('css')
 
 @stop
 
 @section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="{{URL('metropoloancity/')}}"><i class="icon-list position-left"></i> Metropolian  List</a></li>
           
        </ul>

    </div>

        <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Property List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

        <div class="heading-elements">

            @foreach($countries as $country)
            <?php $count = Modules\Admin\Entities\Metropolian::where('country_id',$country['id'])->count();
            if($count < 1){ ?>
            <a type="button" href="{{ URL::to('metropoloancity/create')}}/{{$country['id']}}" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple"><b><i class="icon-plus3"></i></b> Add Metropolian city for {{$country['created_countries']['name']}}</a>

        <?php } else { ?>

             <a type="button" href="{{ URL::to('metropoloancity/edit')}}/{{$country['id']}}" class="btn bg-primary-400 btn-labeled btn-rounded legitRipple"><b><i class="icon-plus3"></i></b> Edit Metropolian city for {{$country['created_countries']['name']}}</a>

        <?php } ?>
             @endforeach

           
       </div>
    </div>
@stop
 
 
 @section('content') 
    <div class="panel panel-flat">
        @if(Session::has('val')) 
            @if(Session::get('val')==1)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 14px;">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{Session::get('msg')}}
                </div>
            @endif
        @endif
        <div class="panel-heading">
            <h5 class="panel-title">Metropolian  List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        
        <div class="panel-body">
            <table class="table datatable-basic table-bordered table-hover" id="metropolian_city">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>City</th>
                       <!--  <th>Category</th>   -->
                        <th>Created at</th>  
                        
                    </tr>
                </thead>
                    <tbody>  </tbody>
            </table> 
        </div>


    </div>

@stop
  
  
@section('js')
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/tables/datatables/datatables.min.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/custom/datatable-extend.js')}} "></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
	 <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/MetropolianlistController.js')}}"></script>    
@stop
  
