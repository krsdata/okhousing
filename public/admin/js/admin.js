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
	 $('#Search_by_id').removeAttr('disabled');	
	 $('.help-block').html('');
	 if(!code){
		$('.help-block').html('Please enter builder code');
		return false;
	 }

		$.ajax({
			type: "GET",
			url:base_url+"/o4k/builder?code="+code,
			dataType: "json",
			async: false, 
			processData: false,
			contentType: false, 
			success: function(response)
			{   
				if(response.status==true){
					var url  = response.profile;
					var name =  response.data.builder_name;    
				    $('img.burl').attr('src',url);
					$('.bname').html(name);	
					$('button').removeAttr('disabled');
					$('input[type="submit"]').removeAttr('disabled');
					$('.builder_name').html(name).css('color','#000');
				}else{
					var url  = response.profile;
					$('.builder_name').html("Builder not found!").css('color','red');
					$('button').attr('disabled','disabled');
					$('input[type="submit"]').attr('disabled','disabled');
					$('#Search_by_id').removeAttr('disabled');	
				}
				
				 
			},
			error: function (request, textStatus, errorThrown) {

				$('.bname').html("Invalid builder code");	        

			}
		});

	}


	$(function(e){
		$('.pull-left a[data-toggle="tab"]').on('click',function() {
			var href= $(this).attr('href');
			 
			$('a[href="'+href+'"]').parent().addClass('active');
			$('a[href="'+href+'"]').parent().siblings().removeClass('active'); 
			
		});
	});