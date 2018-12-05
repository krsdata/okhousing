  @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
		
		<div class="row">
			<div class="langrow">
				

				<input type="hidden" name="desc_language[]" value="{{$value['languages']['id']}}">
					
				<input type="hidden" name="created_language_{{$value['languages']['id']}}" value="{{$value['languages']['id']}}">
					
				<input type="hidden" name="created_country_{{$value['languages']['id']}}" value="{{$value['created_country_id']}}">

				<!---Property Name-->
				<div class="form-group col-md-6" id="areabox_{{$value['languages']['id']}}">
					<label>Name in {{$value['languages']['name']}}</label>
					
					<input id="area_{{$value['languages']['id']}}" name="area_{{$value['languages']['id']}}" type="text" class="form-control perm_text" placeholder="Enter Project Area" >
					
					<input   name="short_name[]" type="hidden" value="{{$value['languages']['lang_code']}}" class="form-control" >
					<span  class="help-block "></span> 
				</div>
				<!----/* Property Name---->

				<div class="form-group col-md-6 " id="slugbox_{{$value['languages']['id']}}">
					<label>slug in {{$value['languages']['name']}}</label>
					
					<input  type="text" id="slug_{{$value['languages']['id']}}" name="slug_{{$value['languages']['id']}}" readonly class="form-control perm_slug" placeholder="Project Area Slug"  >
					<span  class="help-block "></span> 
				</div>
			</div>
		</div>
       
       
       @endif
   @endforeach
 @endif   
