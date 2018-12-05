  @if(isset($languages))
    @foreach ($languages as $key => $value)
       @if(\Illuminate\Support\Arr::exists($value, 'languages'))
        
		
		<div class="row">
			<div class="langrow">
				<div class="form-group col-md-6">
					<label>Language</label> 
					<input id="language_id_{{$key+1}}"name="languages[]" readonly value="{{$value['languages']['name']}}" type="text" class="form-control" placeholder="Enter Property Prize">
					<input type="hidden" id="language_id_{{$key+1}}"name="hidlang[]"  value="{{$value['id']}}" >
				</div>
				<div class="form-group col-md-6 ">
					<label>Description</label>
					<textarea rows="5" cols="5" class="form-control" placeholder="Property Description" name="description[]" id= "description_{{$key+1}}"></textarea>
				</div>
			</div>
		</div>
       
       
       @endif
   @endforeach
 @endif   
