	function initMap(){
		 
		    var input = document.getElementById('location');
		    var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});
		    google.maps.event.addListener(autocomplete, 'place_changed', function(){
		    var place = autocomplete.getPlace();

		    var latitude = place.geometry.location.lat();
		    var longitude = place.geometry.location.lng(); 

		    $("#latitude").val(latitude);
		    $("#longitude").val(longitude);  

		});
    }


	function changeCountry(id){
		 if(id==43){  
		 	$('#lang_thailand').hide();
		 }else{
		 	$('#lang_thailand').show();
		 }
	} 