  @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
		
		<div class="row">
			<div class="langrow">
				<!--div class="form-group col-md-6">
					<label>Language</label> 
					
					

					<input id="language_id_{{$key+1}}"name="languages[]" readonly value="{{$value['languages']['name']}}" type="text" class="form-control" placeholder="Enter Property Prize">
					<input type="hidden" id="language_id_{{$key+1}}"name="hidlang[]"  value="{{$value['id']}}" >
				</div-->

				<input type="hidden" name="desc_language[]" value="{{$value['id']}}">
					
				<input type="hidden" name="created_language_{{$value['id']}}" value="{{$value['language_id']}}">
					
				<input type="hidden" name="created_country_{{$value['id']}}" value="{{$value['created_country_id']}}">

				<!---Property Name-->
				<div class="form-group col-md-6" id="namebox">
					<label>Property Name in {{$value['languages']['name']}}</label>
					<input id="title_{{$value['id']}}" name="title_{{$value['id']}}" type="text" class="form-control" placeholder="Enter Property Name in {{$value['languages']['name']}} ">
					 <span  class="help-block"></span> 
				</div>
				<!----/* Property Name---->

				<div class="form-group col-md-6 ">
					<label>Description in {{$value['languages']['name']}}</label>
					<textarea rows="5" cols="5" class="form-control" placeholder="Property Description in {{$value['languages']['name']}}" name="desc_{{$value['id']}}" id= "description_{{$key+1}}"></textarea>
				</div>
			</div>
		</div>
       
       
       @endif
   @endforeach
 @endif   
