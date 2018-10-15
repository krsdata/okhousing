$(function() {
	

    //initialize selectbox
    if($('.bootstrap-select').length){$('.bootstrap-select').selectpicker();}

    //initialize checkbox   
    if($('.CheckboxStyle').length){ 
        $(".CheckboxStyle").uniform({
            radioClass: 'choice',
            wrapperClass: "border-success text-success-600"
        });
    }

    //initialize filebutton
    if($(".file-styled-primary").length){
        $(".file-styled-primary").uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    }

    //fetch language and append based on selected country
     $("#country_id").change(function() {
        $('.langrow').remove();
        $('.langtitle').show('slow');
        var countryId=$( "#country_id" ).val(); 
         
        $.ajax({
            type: 'GET',
            url: base_url+"/o4k/property_list/getlanguage/"+countryId, 
            dataType: 'json',
            success: function (data) {
				
				if(data.status==true) { $(".lang_section").html(data.html); }
				else { $("#error-common").html(data.message);  }
   
                /*for(var j=0;j<data.length;j++){
                    $(".lang_section").append('<div class="row"><div class="langrow"><div class="form-group col-md-6"><label>Language</label> <input id="language_id_'+ (j + 1) +' "name="languages[]" readonly value="'+data[j].languages.name+'" type="text" class="form-control" placeholder="Enter Property Prize"><input type="hidden" id="language_id_'+ (j + 1) +' "name="hidlang[]"  value="'+data[j].id+'" ></div><div class="form-group col-md-6 "><label>Description</label><textarea rows="5" cols="5" class="form-control" placeholder="Property Description" name="description[]" id= "description_'+ (j + 1) +'"></textarea></div></div></div>'); 
                }*/
                
            },
               
        });
        
    });

    // featured image preview
    $("#property_image").on("change", function(){
      var files = !!this.files ? this.files : [];

      if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        if (/^image/.test( files[0].type)){ // only image file
          var reader = new FileReader(); // instance of the FileReader
          reader.readAsDataURL(files[0]); // read the local file
 
          reader.onloadend = function(){ // set image data as background of div
            $("#featuredimage_preview").css("background-image", "url("+this.result+")");
            }
        }
    });


    // gallery image preview
    $("#gimage").on("change", function(){
      var total_file=document.getElementById("gimage").files.length;
      for(var i=0;i<total_file;i++){
        $('#image_preview').append("<div class='col-md-3' style='width: 18%;'><div class='popupgallery'><a class='fancybox' href='"+URL.createObjectURL(event.target.files[i])+"'><img  class='img-responsive' style='height: 99px!important;' src='"+URL.createObjectURL(event.target.files[i])+"'></a></div></div>");
      }
    });

    
/* ************************************************************************* */  
/* *************************** Initialize form components ********************** */  
/* ************************************************************************* */  

    if($('#metropolian_city').length){
        $('#metropolian_city').DataTable({
        processing: true,
        serverSide: true,  
        ajax: base_url+"/metropoloancity/allcitylist",
            columns: [ 
                { data: 'id', name: 'id' },
                { data: 'cities', name: 'cities' },
               /* { data: 'property_category.name', name: 'property_category.name','orderable': false, },*/
                {
                data: "created_at", sortable: true,
                render: function (data, type, full) {  return full.created_at; } 
                }

                
            ]
       
        });
    }

/* ************************************************************************* */  
/* *************************** data table listing end ********************** */  
/* ************************************************************************* */ 
/*
  * create form 
     * params : Name,Status,Slug  
     */
  /*   $("#metropolian_list_create").submit(function(e)
    {
        e.preventDefault(); 
      // alert(user_name);
        var country=$("#country_id").val().trim();
        var countryid=$("select option[value="+country+"]").attr("countryid");
       $("#Maincountryid").val(countryid);

		var location=$("#pac-input").val().trim();
         var featured_image=$("#property_image").get(0).files.length 

        var a=b=c=d=e=f=g=h=i=j=k=l=m=n=p=q=0;

    
  //featured image
        if(featured_image > 0){
            p=1;
            $( "#fimagebox").removeClass( "has-error" );
            $("#fimagebox .help-block").html(' ');
        }else{
            p=0;
            $( "#fimagebox").addClass( "has-error" ); 
            $("#fimagebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select featured image.</label>');
        }
     

      

      
        //Country
        if(country.length > 0){
           f=1;  
            $( "#countrybox" ).removeClass( "has-error" );
            $("#countrybox .help-block").html(' ');
        }
        else{
            f=0; 
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

//location

if(location.length > 0){ 
}else{
     q=0; 
     $("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select city</label>');
}

$.ajax({
type: "post",
url: base_url+"/metropoloancity/checkcity", 
data:{location:location},
success: function(response){
if(response!='')
{
q=0; 
$( "#locationbox" ).addClass( "has-error" ); 
$("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select"> this city alredy exits.</label>');

}
else
{


q=1;
$( "#locationbox" ).removeClass( "has-error" );
$("#locationbox .help-block").html(' ');

if(p==1  && f==1 && q==1 )
{


$('.content-wrapper').block({
message: '<i class="icon-spinner9 spinner"></i>',
overlayCSS: {
backgroundColor: '#fff',
opacity: 0.8,
cursor: 'wait'
},
css: {
border: 0,
padding: 0,
backgroundColor: 'none'
}
});
$.ajax({
type: "POST",
url: base_url+"/metropoloancity/store", 
data: new FormData($('#metropolian_list_create')[0]),
dataType: "json",  
cache:false,
contentType: false,                   
processData:false,
success: function(response){
console.log(response);
if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);$('.content-wrapper').unblock();}
},
error: function (request, textStatus, errorThrown) {
$('.content-wrapper').unblock();
var obj = request.responseJSON.errors ;

if(obj.hasOwnProperty("property_code") )
{
$( "#codebox" ).addClass( "has-error" );
$("#codebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.property_code[0]+"</div>");   
}    



}

});


}
return false;
}
},
});

});*/

/* ************************************************************************* */  
/* *************************** create end ********************************** */  
/* ************************************************************************* */ 


     $(".perm_text").keyup(function() {
        var Oid=$(this).attr('id');
        var id=Oid.split('_');  
        $("#slug_"+id[1]).val(generate_slug($("#name_"+id[1]).val()));
    });

/* ************************************************************************* */  
/* *************************** generate slug end *************************** */  
/* ************************************************************************* */  


    /*
     * edit form 
     * params : Name,Status,Slug  
     */

/*    $("#metropolian_list_update").submit(function(e)
    {
        e.preventDefault(); 
         
       var country=$("#country_id").val().trim();
        var countryid=$("select option[value="+country+"]").attr("countryid");
       $("#Maincountryid").val(countryid);

        var location=$("#pac-input").val().trim();
         var featured_image=$("#property_image").get(0).files.length 


        var a=b=c=d=e=f=g=h=i=j=k=l=m=n=0;


       
        //Country
        if(country.length > 0){
           f=1;  
            $( "#countrybox" ).removeClass( "has-error" );
            $("#countrybox .help-block").html(' ');
        }
        else{
            f=0; 
            $( "#countrybox" ).addClass( "has-error" ); 
            $("#countrybox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
        }

        //location
       if(location.length > 0){ 
}else{
     q=0; 
     $("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select city</label>');
}


var id=$("input[name='idata']").val();
$.ajax({
type: "post",
url: base_url+"/metropoloancity/checkcity", 
data:{location:location,id:id},
success: function(response){
if(response!='')
{
q=0; 
$( "#locationbox" ).addClass( "has-error" ); 
$("#locationbox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select"> this city alredy exits.</label>');

}
else
{
q=1;
$( "#locationbox" ).removeClass( "has-error" );
$("#locationbox .help-block").html(' ');
if(f==1 && q==1 )
{*/

/* server checking */
/*$('.content-wrapper').block({
message: '<i class="icon-spinner9 spinner"></i>',
overlayCSS: {
backgroundColor: '#fff',
opacity: 0.8,
cursor: 'wait'
},
css: {
border: 0,
padding: 0,
backgroundColor: 'none'
}
});*/
/*$.ajax({
type: "POST",
url: base_url+"/metropoloancity/update", 
data: new FormData($('#metropolian_list_create')[0]),
dataType: "json",  
cache:false,
contentType: false,                   
processData:false,
success: function(response){
console.log(response);
if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);$('.content-wrapper').unblock();}
},
error: function (request, textStatus, errorThrown) {
$('.content-wrapper').unblock();
var obj = request.responseJSON.errors ;

if(obj.hasOwnProperty("property_code") )
{
$( "#codebox" ).addClass( "has-error" );
$("#codebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.property_code[0]+"</div>");   
}    
}
});
}
return false;
}
},
});*/

        

        //featured image
      /*  if(featured_image > 0){
            p=1;
            $( "#fimagebox").removeClass( "has-error" );
            $("#fimagebox .help-block").html(' ');
        }else{
            p=0;
            $( "#fimagebox").addClass( "has-error" ); 
            $("#fimagebox .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select featured image.</label>');
        }*/


//        /* ------------------------------------------------------------------ */
//        /* ----------------- form submitting -------------------------------- */
//        /* ------------------------------------------------------------------ */
        

   

  //  });

});



function initMap() {

 
    var e = document.getElementById("country_id");
    var strCountry = $(e).data('flag');

	if(strCountry){
		$("#mapsection").show('slow');
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 40.725332, lng: -73.997158},
			zoom: 13
		});
		var options = {
			types: ['(cities)'],
			componentRestrictions: {country: strCountry}

		};
		var input1 = document.getElementById('pac-input1');
		var autocomplete1 = new google.maps.places.Autocomplete(input1,options);

    var input2 = document.getElementById('pac-input2');
    var autocomplete2 = new google.maps.places.Autocomplete(input2,options);

    var input3 = document.getElementById('pac-input3');
    var autocomplete3 = new google.maps.places.Autocomplete(input3,options);

    var input4 = document.getElementById('pac-input4');
    var autocomplete4 = new google.maps.places.Autocomplete(input4,options);

    var input5 = document.getElementById('pac-input5');
    var autocomplete5 = new google.maps.places.Autocomplete(input5,options);

    var input10 = document.getElementById('pac-input10');
    var autocomplete10 = new google.maps.places.Autocomplete(input10,options);

    var input6 = document.getElementById('pac-input6');
    var autocomplete6 = new google.maps.places.Autocomplete(input6,options);

    var input7 = document.getElementById('pac-input7');
    var autocomplete7 = new google.maps.places.Autocomplete(input7,options);

    var input9 = document.getElementById('pac-input9');
    var autocomplete9 = new google.maps.places.Autocomplete(input9,options);

    var input8 = document.getElementById('pac-input8');
    var autocomplete8 = new google.maps.places.Autocomplete(input8,options);

    var input11 = document.getElementById('pac-input11');
    var autocomplete11 = new google.maps.places.Autocomplete(input11,options);

    var input12 = document.getElementById('pac-input12');
    var autocomplete12 = new google.maps.places.Autocomplete(input12,options);
    

    autocomplete1.addListener('place_changed', function() {
              input1.value=input1.value.split(',')[0]; 
        });

    autocomplete2.addListener('place_changed', function() {
              input2.value=input2.value.split(',')[0]; 
        });

     autocomplete3.addListener('place_changed', function() {
              input3.value=input3.value.split(',')[0]; 
        });

    autocomplete4.addListener('place_changed', function() {
              input4.value=input4.value.split(',')[0]; 
        });

    autocomplete6.addListener('place_changed', function() {
              input6.value=input6.value.split(',')[0]; 
        });

    autocomplete7.addListener('place_changed', function() {
              input7.value=input7.value.split(',')[0]; 
        });

     autocomplete8.addListener('place_changed', function() {
              input8.value=input8.value.split(',')[0]; 
        });

    autocomplete9.addListener('place_changed', function() {
              input9.value=input9.value.split(',')[0]; 
        });

    autocomplete5.addListener('place_changed', function() {
              input5.value=input5.value.split(',')[0]; 
        });

     autocomplete10.addListener('place_changed', function() {
              input10.value=input10.value.split(',')[0]; 
        });

    autocomplete11.addListener('place_changed', function() {
              input11.value=input11.value.split(',')[0]; 
        });


	}
}


function initMapedit() {
    var e = document.getElementById("country_id");
    var strCountry = $(e).find("option:selected").data('flag');
    if(strCountry){
        $("#mapsection").show('slow');
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 40.725332, lng: -73.997158},
            zoom: 13
        });
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: strCountry}

        };
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');


        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input,options);

       // Bind the map's bounds (viewport) property to the autocomplete object,
       // so that the autocomplete requests use the current map bounds for the
       // bounds option in the request.


       autocomplete.bindTo('bounds', map);

       var infowindow = new google.maps.InfoWindow();
       
       var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
       });

        autocomplete.addListener('place_changed', function() {
              input.value=input.value.split(',')[0]; 
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();




           // input.value=input.value.split(',')[0]; 

            if (!place.geometry) {
              // User entered the name of a Place that was not suggested and
              // pressed the Enter key, or the Place Details request failed.
              window.alert("No details available for input: '" + place.name + "'");
              return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
                $('#metro_city_lat').val(place.geometry.location.lat());
                $('#metro_city_lang').val(place.geometry.location.lng());
            
            infowindow.open(map, marker);
        });
    }
}



