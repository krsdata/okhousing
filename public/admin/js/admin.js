	//isDisabled

	$(function() {

	  $("input:disabled").closest("div").click(function() {
	    $(this).find("input:disabled").attr("disabled", false).focus();
	    alert(1);
	  });

	});

	//editEnable


	function editEnable(val) { 
 	  	$('.type_'+val).removeAttr('disabled');
	}


	function isDisabledBtn(this){
		
	 	 // $(thiscode).parent().attr('class','checked');
	}
	//getCode

	function getCode(code){
		var typeCode = code;
		var code = $('.code_'+code).val();

		var f = code.charAt(0); // alerts 's'

		$('.code_error_'+typeCode).html("");
		if(code==""){
			$('.code_error_'+typeCode).html('Enter code<br>').css('color','red');
		}

		var code_f = $('.generate_code_'+f).val();

		if(code!=code_f){
			$('.code_error_'+typeCode).html('Invalid code<br>').css('color','red');
		}

		$('.check_code').is

	   $('.check_code').each(function() {
	        if ($(this).is(":checked")) {
	            $(this).val(code);
	            $(this).attr("disabled","disabled");
	            $(this).addClass("disabled");
	             $(this).attr("onclick","isDisabledBtn(this)");
	        }
	    });


 
	}

//generateCode

function generateCode(code,id){

	let random = Math.random().toString(36).substr(2, 4);
 
	$('.generate_code_'+id).val(code+random.toUpperCase(random));

}

// checkAll

	function checkAll(ele) {
	     
	     var val = $(ele).val();
	      
	     var checkboxes = document.getElementsByClassName('type_'+val);

	     if (ele.checked) {
         	  $('.type_'+val).parent().attr('class','checked');
         	}
 			 else {
          $('.type_'+val).parent().attr('class','');
        }
	}


	// prepare chart
	function prepareChart(){ 

		$('.no_of_flats,.no_of_floors, .bhk_error').html(""); 

		var c = 0;
		var no_of_floors = $('input[name="no_of_floors"]').val();
		var no_of_flats = $('input[name="no_of_flats"]').val();

		var bhk_1 = $('input[name="1bhk"]').val();
		var bhk_2 = $('input[name="2bhk"]').val();
		var bhk_3 = $('input[name="3bhk"]').val();
		var bhk_4 = $('input[name="4bhk"]').val();
		var bhk_5 = $('input[name="5bhk"]').val();
		var bhk_6 = $('input[name="6bhk"]').val();

		
	
		if(no_of_floors.length==0 || no_of_floors=="" ){
			  c= 1
			$('.no_of_floors').html('No of floor fields is required');
		}else if($.isNumeric(no_of_floors)==false){
			$('.no_of_floors').html('No of floor is Invalid');
			  c= 1
		}

		if(no_of_flats.length==0 || no_of_flats=="" ){
			$('.no_of_flats').html('No of flat fields is required');
			  c= 1
		}else if($.isNumeric(no_of_flats)==false){
			$('.no_of_flats').html('No of flat is Invalid');
			  c= 1
		} 

		var bhk = [];
		$('.bhk').each(function(){
			if ($(this).is(":checked")) { 
			   bhk.push($(this).val()); 
			}
		});  

	 	if(bhk.length==0){
		 	$('.bhk_error').html('Please select no of BHK').css('color','red');
		 	return false;
	 	}
		
		if(c==1){
			return false;
		}

		$.ajax({
			type: "GET",
			url:base_url+"/o4k/project/prepareChart?flats="+no_of_flats+'&floors='+no_of_floors+'&bhk='+[bhk],
			success: function(response)
			{   
				$('#prepareChart').html(response);
			} 
		}); 
	}

	// init map
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
	
	function removevideoUrl(id){
		$('#vdo_'+id).remove();
	}
	var vdo_id=1;
	function videoUrl(){
		
		var html = '<div class="row" id="vdo_'+vdo_id+'">'+
					'<div class="col-md-11">'+
						'<div class="form-group">'+
							'<label class="control-label ">Youtube URL </label>'+
							'<input class="form-control" data-required="1" name="video_url[]" type="text">'+ 
						'</div>'+
					'</div>'+ 
					'<div class="col-md-1">'+
						'<button type="button" class=" btn bg-danger legitRipple pull-right" style="margin-top: 20px" onclick="removevideoUrl('+vdo_id+')">Remove</button>'+
				   '</div>'+
				'</div>'
					;
				vdo_id++;
		$('#video_url').after(html);


	}


	function removeImage(id){
		$('#img_'+id).remove();
	}
	var img_id=1;
	function addImage(){
		
		var html = '<div class="row" id="vdo_'+img_id+'">'+
						'<button type="button" class=" btn bg-danger legitRipple pull-right" onclick="removevideoUrl('+img_id+')">Remove</button>'+
						'<div class="col-md-6">'+
							'<div class="form-group">'+
								'<label class="control-label  ">Status Date </label>'+
								'<input class="form-control startdate date_'+img_id+'" data-required="1" data-date-format="dd/mm/yyyy"  aria-invalid="false" name="status_date[]" type="text">'+
								'<span class="help-block" style="color:red"> </span>'+
							'</div> '+
						'</div>'+
						'<div class="col-md-6">'+
							'<div class="form-group">'+
								'<label class="control-label  ">Status image </label>'+
								'<input name="status_image[]" type="file">'+
								'<span class="help-block" style="color:red"> </span>'+
							'</div> '+
						'</div> '+
					'</div>';
					;
					
		$('#statusImage').after(html); 

		$('.date_'+img_id).datepicker({
			todayBtn:  1,
			autoclose: true,
		}).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			$('#enddate').datepicker('setStartDate', minDate);
		});
 
		img_id++;
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

		$("#startdate").datepicker({
			todayBtn:  1,
			autoclose: true,
		}).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			$('#enddate').datepicker('setStartDate', minDate);
		});

		$(".startdate").datepicker({
			todayBtn:  1,
			autoclose: true,
		}).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			$('#enddate').datepicker('setStartDate', minDate);
		});
	
		$("#enddate").datepicker()
			.on('changeDate', function (selected) {
				var maxDate = new Date(selected.date.valueOf());
				$('#startdate').datepicker('setEndDate', maxDate);
			});



		$('.pull-left a[data-toggle="tab"]').on('click',function() {
			var href= $(this).attr('href');
			 
			$('a[href="'+href+'"]').parent().addClass('active');
			$('a[href="'+href+'"]').parent().siblings().removeClass('active'); 
			
		});
	});