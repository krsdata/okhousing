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


	function getBuilder(){
	 var code = $('#builder_code').val();
	 alert(code);
	 if(!code){
		$('.help-block').html('Please enter builder code');
		return false;
	 }

		$.ajax({
			type: "GET",
			url:base_url+"/o4k/builder?code="+code,
			dataType: "json",
			async: false, 
			data: {code:code},
			processData: false,
			contentType: false, 
			success: function(response)
			{   
				var url  = response.profile;
				var name =  response.data.builder_name;    
			    $('img.burl').attr('src',url);
				$('.bname').html(name);
				 
			},
			error: function (request, textStatus, errorThrown) {

					        

			}
		});

	}