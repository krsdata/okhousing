 $(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
  


    $(".btn-back").click(function(e) 
    {
        
        var back        = $(this).attr("data-back") ; 
        var data_id      = $(this).attr("data-id") ;  
        var active      = $(".dispayBox").attr("id"); 

        $("#"+active).removeClass("dispayBox");
        $("#"+active).addClass("dispayNone"); 
        $("#"+back).removeClass("dispayNone");
        $("#"+back).addClass("dispayBox");
        $("#tab_"+((data_id)-1)).addClass("active");
        $("#tab_"+data_id).removeClass("active"); 
        $("#title_"+((data_id)-1)).removeClass("dispayNone");
        $("#title_"+data_id).addClass("dispayNone");
          
    });
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
/*

     * create form 
     * params : Name,Prize,Category  
     */
   
     $(".btn-next").click(function(e) 
    {
      e.preventDefault(); 
       
        var next      = $(this).attr("data-next") ; 
        var data_id      = $(this).attr("data-id") ;  
        var active      = $(".dispayBox").attr("id");

        var isValid = true;
        $('input,text,select').filter('[required]:visible').each(function() {
          var inputtype=$(this).attr('type');
      
          if(inputtype =='text'  || inputtype =='select'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 ){   
                isValid = true;    
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid = false;
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">This field is required.</label>');
              }
          }else if(inputtype =='checkbox'){
              var inputId = $(this).attr("id");
              var numberofchecked=$('input.'+inputId+':checkbox:checked').length;

              if(numberofchecked > 0){
                isValid = true;    
                $( "#"+inputId ).removeClass( "has-error" );
                $("#"+inputId+" .help-block").html(' ');
            }else{
                isValid = false;
                $( "#"+inputId ).addClass( "has-error" ); 
                $("#"+inputId+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please select atleast one.</label>');
            }
          }


          
             
        });


        if(isValid=== true){
          $("#"+active).removeClass("dispayBox");
          $("#"+active).addClass("dispayNone");
          $("#"+next).removeClass("dispayNone");
          $("#"+next).addClass("dispayBox"); 
          $("#tab_"+data_id).addClass("active"); 
          $("#title_"+data_id).removeClass("dispayNone");
          $("#tab_"+((data_id)-1)).removeClass("active");
          $("#title_"+((data_id)-1)).addClass("dispayNone");
          if(next == 'last_step'){

              $.ajax({
                    type: "POST",
                    url: base_url+"/property/post/add", 
                    data: new FormData($('#property_list_add')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                       if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                            // var obj = request.responseJSON.errors ;

                            // if(obj.hasOwnProperty("property_code") )
                            // {
                            //    $( "#codebox" ).addClass( "has-error" );
                            //    $("#codebox .help-block").html("<div class='mad'>"+request.responseJSON.errors.property_code[0]+"</div>");   
                            // }         

                    }
                   
                });
          }


        }else{
          return false;
        }

    });
     



    

 });


 function initMap() {


  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 40.725332, lng: -73.997158},
    zoom: 13
  });
  var options = {
  types: ['(cities)'],
  componentRestrictions: {country: 'th'}
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
  var infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
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

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindowContent.children['place-name'].textContent = place.name;
    infowindowContent.children['place-address'].textContent = address;
    infowindow.open(map, marker);
  });

}
