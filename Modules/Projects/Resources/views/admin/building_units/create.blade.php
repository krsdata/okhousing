@extends('admin::admin.master')
@section('title', "Admin Building Units")
@section('css')
 
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/project_category')}}"><i class="icon-list position-left"></i>Project Building Units</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/project_category')}}"><i class="icon-list position-left"></i>Project Building Units</a></li>
            <li class="active">Create</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Project Building Units <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

    </div>
@stop
@section('content') 
    <div class="panel panel-flat">
        <div class="showalert">
            @if(Session::has('val')) 
                @if(Session::get('val')==0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right:14px;">×</button>
                        <h4><i class="icon fa fa-ban"> Alert!</i></h4> 
                        {{Session::get('msg')}}
                    </div>
                @endif
       
            @endif
        </div>
        <div class="panel-heading">
            <h5 class="panel-title">Create Building Unit<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->


            <form action="#" id="building_unit_create" autocomplete="off" >


                    <div class="row">

                        <!---Country-->
                        <div class="form-group col-md-6" id="countrybox">
                            <label>Country</label>
                            <select class="bootstrap-select " data-width="100%"  name="countries" id="country_id">
                                <option value="" >Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}" data-flag="{{$country['created_countries']['flag']}}">{{$country['created_countries']['name']}}</option>
                                    @endforeach
                            </select>
                            <span  class="help-block"></span> 
                        </div>
                        
                        <!----/* Country---->

                        	<!--------- Status------>
						<div class="form-group col-md-6" id="statusbox">
							<label>Status</label>
							<select class="bootstrap-select" name="status_en" id="building_unit_status"data-width="100%">
								<option value="1" selected >Active</option>
								<option value="0">Inactive</option>
							</select>
							 <span  class="help-block "></span>
						</div>
						
                    </div>
               

                   
                     

                     <div class="lang_section" ><div class="langtitle" style="display:none;"><legend class="text-bold "></legend></div></div>

				
					 <!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="building_unit_save" class="btn btn-primary legitRipple">Save Building Unit<i class="icon-paperplane position-right"></i></button>
                    </div>	
                </div>
           <!-- /* Form action -->
			</form>
		</div>
		
	</div>

@stop
  
  
  
@section('js')
   @section('js')

    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Modules/Projects/Resources/assets/js/buildingunitsControles.js')}}"></script>
@stop
  
