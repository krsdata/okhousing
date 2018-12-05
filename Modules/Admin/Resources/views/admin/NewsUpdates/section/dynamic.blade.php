  @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
		
		<div class="row">
			<div class="langrow">
				

				<input type="hidden" name="desc_language[]" value="{{$value['languages']['id']}}">
					
				<input type="hidden" name="created_language_{{$value['languages']['id']}}" value="{{$value['languages']['id']}}">
					
				<input type="hidden" name="created_country_{{$value['languages']['id']}}" value="{{$value['created_country_id']}}">

				<!---Property Name-->
				<div class="form-group col-md-6" id="title_{{$value['languages']['id']}}">
					<label>News title in {{$value['languages']['name']}}</label>
					<input id="title_{{$value['languages']['id']}}" name="title_{{$value['languages']['id']}}" type="text" class="form-control" placeholder="Enter Property Name in {{$value['languages']['name']}} ">
					 <span  class="help-block"></span> 
				</div>
				<!----/* Property Name---->

				<div class="form-group col-md-6 " id="desc_{{$value['languages']['id']}}">
					<label>Description in {{$value['languages']['name']}}</label>
					<textarea rows="5" cols="5" class="form-control" placeholder="Property Description in {{$value['languages']['name']}}" name="desc_{{$value['languages']['id']}}" id= "description_{{$key+1}}"></textarea>
					 <span  class="help-block"></span> 
				</div>
			</div>
		</div>
       
       
       @endif
   @endforeach
 @endif   
