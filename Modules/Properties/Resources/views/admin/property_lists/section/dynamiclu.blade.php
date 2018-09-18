
<label>Land Unit</label>
	<select class="bootstrap-select" name="land_unit" data-width="100%" id="land_unit">
		<option value="">Select</option>
		@foreach($landunits as $landunit)
			<option value="{{$landunit->id}}" >{{$landunit->land_unit}}</option>
		@endforeach
	</select>
	<span  class="help-block"></span> 
