@extends('admin::admin.master')
@section('title', "Admin Building Units")
@section('css')
 
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/property_category')}}"><i class="icon-list position-left"></i>Building Units</a></li>
        <li class="active">Edit</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/property_category')}}"><i class="icon-list position-left"></i>Building Units</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Building Units <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
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
            <h5 class="panel-title">Edit Building Unit<a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
		<div class="panel-body">
		<!--- Form -->
            <form action="#" id="building_unit_update" autocomplete="off" data-id="{{$building_unit->id}}">
				<div class="row">
					<!---Name-->
						<input type="hidden" name="language_en" value="1">
						<input type="hidden" name="id" value="{{$building_unit->id}}">
						 <input type="hidden" name="parent_id" id="parent_id" value="{{ $building_unit->id}}">

                        <!---Country-->
                        <div class="form-group col-md-6" id="countrybox">
                            <label>Country</label>
                            <select class="bootstrap-select " data-width="100%"  name="countries" id="country_id_edit">
                                <option value="" >Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}" data-flag="{{$country['created_countries']['flag']}}" @if($building_unit->country_id == $country['id']) {{ 'selected' }} @endif  >{{$country['created_countries']['name']}}</option>
                                    @endforeach
                            </select>
                            <span  class="help-block"></span> 
                        </div>
                        
                        <!----/* Country---->

                        	<!--------- Status------>
						<div class="form-group col-md-6" id="statusbox">
							<label>Status</label>
							<select class="bootstrap-select" name="status_en" id="building_unit_status"data-width="100%">
								<option value="1" @if($building_unit->status == '1') {{ 'selected' }} @endif  >Active</option>
								<option value="0" @if($building_unit->status == '0') {{ 'selected' }} @endif  >Inactive</option>
							</select>
							 <span  class="help-block "></span>
						</div>
				</div>

				  <div class="lang_section" >


				 @if(isset($languages))
                            @foreach ($languages as $key => $value)
                               @if(\Illuminate\Support\Arr::exists($value, 'languages'))
                                
                                @php 

                                

                                  $BuildingUnitsEach = Modules\Properties\Entities\BuildingUnits::where('language_id' ,$value['languages']['id'])->where('country_id',$value['created_country_id'])->whereNull('deleted_at')->where(function ($query) use ($building_unit) {
                                $query->where('parent_id',$building_unit->id)->orWhere('id',$building_unit->id);
                                })->first();

                                

                                @endphp
                                 <div class="langrow">
                                    <div class="row">
                                   
                                        

                                        <input type="hidden" name="desc_language[]" value="{{$value['language_id']}}">
                                            
                                        <input type="hidden" name="created_language_{{$value['language_id']}}" value="{{$value['language_id']}}">

                                        <input type="hidden" name="record[]" value="{{$BuildingUnitsEach->id}}">

                                            
                                        <input type="hidden" name="created_country_{{$value['language_id']}}" value="{{$value['created_country_id']}}">

                                        <!---Property Name-->
                                        <div class="form-group col-md-6" id="unitbox_{{$value['languages']['id']}}">
                                            <label>Name in {{$value['languages']['name']}}</label>
                                            
                                            <input id="unit_{{$value['languages']['id']}}" name="unit_{{$value['languages']['id']}}" type="text" class="form-control perm_text" placeholder="Enter Unit" value="{{$BuildingUnitsEach->unit}}" >
                                            
                                            <input   name="short_name[]" type="hidden" value="{{$value['languages']['lang_code']}}" class="form-control" >
                                            <span  class="help-block "></span> 

                                        </div>
                                        <!----/* Property Name---->

                                        <div class="form-group col-md-6 " id="slugbox_{{$value['languages']['id']}}">
                                            <label>slug in {{$value['languages']['name']}}</label>
                                            
                                            <input  type="text" id="slug_{{$value['languages']['id']}}" name="slug_{{$value['languages']['id']}}" readonly class="form-control perm_slug" placeholder="Building Unit Slug" value="{{$BuildingUnitsEach->slug}}" >
                                            <span  class="help-block "></span> 

                                        </div>

                                       
                                    </div>
                                </div>
                               
                               
                               @endif
                           @endforeach
                         @endif 
                 
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-right">
                       <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                        <button type="submit" id="building_unit_update" class="btn btn-primary legitRipple">Update Building Unit<i class="icon-paperplane position-right"></i></button>
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
    <script type="text/javascript" src="{{asset('Modules/Properties/Resources/assets/js/buildingunitsControles.js')}}"></script>
@stop
  
