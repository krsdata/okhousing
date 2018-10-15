@extends('admin::admin.master')
@section('title', "Admin Agents List")
@section('css')
 <style>
#featuredimage_preview {
width: 80px;
height: 80px;
background-position: center center;
background-size: cover;
-webkit-box-shadow: 0 0 0px 0px rgba(0, 0, 0, .3);
display: inline-block;
}

</style>
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/slideragents')}}"><i class="icon-list position-left"></i>Slider Agents List</a></li>
        <li class="active">Update</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/slideragents')}}"><i class="icon-list position-left"></i> Slider Agents List</a></li>
            <li class="active">Update</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Agents List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Update Slider Agents List<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="slider_Agents_list_update" autocomplete="off" data-id="{{$Agents->id}}">
				<div class="row">
						<!---Agents Name-->
                        <input type="hidden" value="Agents" name="slider_element_type">
                        <input type="hidden" value="{{$Agents->id}}" name="id">
						<div class="form-group col-md-8" id="Agentsbox">
							<label>Agent</label>
							<select class="bootstrap-select " data-width="100%"  name="slider_element_id" id="Agents_id">
                                <option value="" >Select Agent</option>
									@foreach($AgentList as $Agent)
										<option value="{{$Agent['id']}}" @if($Agent['id'] == $Agents->slider_element_id )) selected @endif >{{$Agent['name']}}</option>
									@endforeach
							</select>
							<span  class="help-block"></span> 
						</div>
							<!---Agents Name-->
						
						<!---Agents Name-->
						<div class="form-group col-md-4" id="pagebox">
							<label>Page Name</label>
							<select class="bootstrap-select " data-width="100%"  name="page[]" id="showpage_id" multiple="true">
                                <?php $Pages = explode(",", $Agents->page_type); ?>
									<option>Select Page</option>
									<option value="Home" @if(in_array('Home',$Pages)) selected @endif >Home</option>
									<option value="Agents"  @if(in_array('Agents',$Pages)) selected @endif >Agents</option>
									<option value="Utility"  @if(in_array('Utility',$Pages)) selected @endif>Agents</option>
									<option value="Owners"  @if(in_array('Owners',$Pages)) selected @endif>Owners</option>
								</select>
							 <span  class="help-block"></span> 
						</div>
						<!----/* Agents Name---->

				</div>

				

				<!--Form action-->
                <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="slider_Agents_list_save" class="btn btn-primary legitRipple">Save Slider Agents<i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('Modules/Agents/Resources/assets/js/sliderControles.js')}}"></script>
    
@stop
  
