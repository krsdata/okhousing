
<label>Building Unit</label>
<select class="bootstrap-select" name="building_unit" data-width="100%" id="building_unit">
	<option value="">Select</option>
	@foreach($BuildingUnits as $buildingunit)
		<option value="{{$buildingunit->id}}" >{{$buildingunit->unit}}</option>
	@endforeach
</select>
<span  class="help-block"></span> 
