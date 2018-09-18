<script type="text/javascript">
    
     $(function() {
      var geocoder;
      var map;
      var markers = Array();
      var infos = Array();
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
        //$("#title_"+data_id).addClass("dispayNone");
          
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

        
        var isValid = ['true'];
        $('input,text,select').filter('[required]:visible').each(function() {
          var inputtype=$(this).attr('type');
      
          if(inputtype =='checkbox'){
              var inputId = $(this).attr("id");
              var numberofchecked=$('input.'+inputId+':checkbox:checked').length;

              if(numberofchecked > 0){
                isValid.push('true');    
                $( "#"+inputId ).removeClass( "has-error" );
                $("#"+inputId+" .help-block").html(' ');
            }else{
               isValid.push('false'); 
                $( "#"+inputId ).addClass( "has-error" ); 
                $("#"+inputId+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.selectone")}}</label>');
            }
          }
           if(inputtype =='text'  || inputtype =='textarea'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 ){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.fieldRequired")}}</label>');
              }
          }

          if(inputtype =='number'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 && $.isNumeric($(this).val() )){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.validdigit")}}</label>');
              }
          }

           if(inputtype =='select'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 ){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.plsselect")}}</label>');
              }
          }
          
             
        });

       /* if(data_id == 5)
        {
        $('input.neighbourhood').each(function() {
          var inputtype=$(this).attr('id');
           if ( $(this).val().length > 0 ){
            if($.isNumeric($(this).val() )){   
              isValid.push('true');  
              $( "#"+inputname +"_box").removeClass( "has-error" );
              $("#"+inputname+"_box .help-block").html(' ');
              
            }else{
              isValid.push('false'); 
              $( "#"+inputname +"_box").addClass( "has-error" ); 
              $("#"+inputname+"_box .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please enter valid digit.</label>');
            }
          }
        });
      }*/


        var type = [];
          $.each($("#property_categorychanged option:selected"), function(){            
              if($(this).val() !=='')
                {  type.push($(this).val()); }
          });

          
          if ( type.length > 0  ){   
            isValid.push('true');  
            $( "#property_type" ).removeClass( "has-error" );
            $("#property_type .help-block").html(' ');
            
          }else{
            isValid.push('false'); 
            $( "#property_type" ).addClass( "has-error" ); 
            $("#property_type .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.fieldRequired")}}</label>');
          }

          var category = [];
          $.each($("#property_typechanged option:selected"), function(){            
              if($(this).val() !=='')
                { category.push($(this).val()); }
          });

         
          if ( category.length > 0  ){   
            isValid.push('true');  
            $( "#property_category" ).removeClass( "has-error" );
            $("#property_category .help-block").html(' ');
            
          }else{
            isValid.push('false'); 
            $( "#property_category" ).addClass( "has-error" ); 
            $("#property_category .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.fieldRequired")}}</label>');
          }

        
        if($.inArray('false', isValid) < 0){

        
          if(data_id == 2)
          {

                    var bulding_area_show = $("#property_typechanged").find(':selected').data('bulding_area_show');
                    $("#bulding_area_show").val(bulding_area_show);
                    if(bulding_area_show == 0)
                    {
                        $(".bulding_area_show").hide();
                    }
                    else
                    {
                        $(".bulding_area_show").show();
                    }


                    var landarea_show = $("#property_typechanged").find(':selected').data('landarea_show');
                    $("#landarea_show").val(landarea_show);
                    
                    if(landarea_show == 0)
                    {
                        $(".landarea_show").hide();
                    }
                    else
                    {
                        $(".landarea_show").show();
                    }

                    var bedroom_show = $("#property_typechanged").find(':selected').data('bedroom_show');
                    $("#bedroom_show").val(bedroom_show);
                    
                    if(bedroom_show == 0)
                    {
                        $(".bedroom_show").hide();
                    }
                    else
                    {
                        $(".bedroom_show").show();
                    }

                    var bathroom_show = $("#property_typechanged").find(':selected').data('bathroom_show');
                    $("#bathroom_show").val(bathroom_show);
                    
                    if(bathroom_show == 0)
                    {
                        $(".bathroom_show").hide();
                    }
                    else
                    {
                        $(".bathroom_show").show();
                    }
          }

          $("#"+active).removeClass("dispayBox");
          if(next != 'last_step')
          {
            $("#"+active).addClass("dispayNone");

          }
          $("#"+next).removeClass("dispayNone");
          $("#"+next).addClass("dispayBox"); 
          $("#tab_"+data_id).addClass("active"); 
          $("#title_"+data_id).removeClass("dispayNone");
          //$("#tab_"+((data_id)-1)).removeClass("active");
          //$("#title_"+((data_id)-1)).addClass("dispayNone");
          if(next == 'last_step'){


              $(".btn-next").val("{{trans('countries::home/home.Processing')}}");
            $(".btn-next , .btn-back").attr("disabled","true");

             $(".preLoad").removeClass( "Noloader" );
            $(".preLoad").addClass( "addloader" );

              $.ajax({
                    type: "POST",
                    url: base_url+"/property/post/add", 
                    data: new FormData($('#property_list_add')[0]),
                    dataType: "json",  
                    cache:false,
                    contentType: false,                   
                    processData:false,
                    success: function(response){
                        //console.log(response);
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
     




    $(".edit-btn-back").click(function(e) 
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
        //$("#title_"+data_id).addClass("dispayNone");
          
    });
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
/*

     * create form 
     * params : Name,Prize,Category  
     */
   
     $(".edit-btn-next").click(function(e) 
    {
      e.preventDefault(); 
        var next      = $(this).attr("data-next") ; 
        var data_id      = $(this).attr("data-id") ;  
        var active      = $(".dispayBox").attr("id");

        var isValid = ['true'];
        $('input,text,select').filter('[required]:visible').each(function() {
          var inputtype=$(this).attr('type');
      
          if(inputtype =='checkbox'){
              var inputId = $(this).attr("id");
              var numberofchecked=$('input.'+inputId+':checkbox:checked').length;

              if(numberofchecked > 0){
                isValid.push('true');    
                $( "#"+inputId ).removeClass( "has-error" );
                $("#"+inputId+" .help-block").html(' ');
            }else{
               isValid.push('false'); 
                $( "#"+inputId ).addClass( "has-error" ); 
                $("#"+inputId+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.selectone")}}</label>');
            }
          }

           if(inputtype =='text'  ||  inputtype =='textarea' ){
              var inputname = $(this).attr("name");

              if ( $(this).val().length >0 ){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.fieldRequired")}}</label>');
              }
          }





            if(inputtype =='number'){
              var inputname = $(this).attr("name");

              if ( $(this).val().length >0  && $.isNumeric($(this).val() )){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.validdigit")}}</label>');
              }
          }

            if(inputtype =='select'){
              var inputname = $(this).attr("name");

              if ( $(this).val() .length >0 ){   
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .help-block").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.plsselect")}}</label>');
              }
          }
          
          
             
        });



        var type = [];
          $.each($("#property_categorychanged option:selected"), function(){            
              if($(this).val() !=='')
                {  type.push($(this).val());}
          });

          
          if ( type.length > 0  ){   
            isValid.push('true');  
            $( "#property_type" ).removeClass( "has-error" );
            $("#property_type .help-block").html(' ');
            
          }else{
            isValid.push('false'); 
            $( "#property_type" ).addClass( "has-error" ); 
            $("#property_type .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.fieldRequired")}}</label>');
          }

          var category = [];
          $.each($("#property_typechanged option:selected"), function(){            
              if($(this).val() !=='')
                { category.push($(this).val()); }
          });

         
          if ( category.length > 0  ){   
            isValid.push('true');  
            $( "#property_category" ).removeClass( "has-error" );
            $("#property_category .help-block").html(' ');
            
          }else{
            isValid.push('false'); 
            $( "#property_category" ).addClass( "has-error" ); 
            $("#property_category .help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.fieldRequired")}}</label>');
          }

        
        if($.inArray('false', isValid) < 0){

        
          if(data_id == 2)
          {

                    var bulding_area_show = $("#property_typechanged").find(':selected').data('bulding_area_show');
                    $("#bulding_area_show").val(bulding_area_show);
                    if(bulding_area_show == 0)
                    {
                        $(".bulding_area_show").hide();
                    }
                    else
                    {
                        $(".bulding_area_show").show();
                    }


                    var landarea_show = $("#property_typechanged").find(':selected').data('landarea_show');
                    $("#landarea_show").val(landarea_show);
                    
                    if(landarea_show == 0)
                    {
                        $(".landarea_show").hide();
                    }
                    else
                    {
                        $(".landarea_show").show();
                    }

                    var bedroom_show = $("#property_typechanged").find(':selected').data('bedroom_show');
                    $("#bedroom_show").val(bedroom_show);
                    
                    if(bedroom_show == 0)
                    {
                        $(".bedroom_show").hide();
                    }
                    else
                    {
                        $(".bedroom_show").show();
                    }

                    var bathroom_show = $("#property_typechanged").find(':selected').data('bathroom_show');
                    $("#bathroom_show").val(bathroom_show);
                    
                    if(bathroom_show == 0)
                    {
                        $(".bathroom_show").hide();
                    }
                    else
                    {
                        $(".bathroom_show").show();
                    }
          }
          

          $("#"+active).removeClass("dispayBox");
          if(next != 'last_step')
          {
            $("#"+active).addClass("dispayNone");

          }
          $("#"+next).removeClass("dispayNone");
          $("#"+next).addClass("dispayBox"); 
          $("#tab_"+data_id).addClass("active"); 
          $("#title_"+data_id).removeClass("dispayNone");
          //$("#tab_"+((data_id)-1)).removeClass("active");
          //$("#title_"+((data_id)-1)).addClass("dispayNone");
          if(next == 'last_step'){

              $(".edit-btn-next").val("{{trans('countries::home/home.Processing')}}");
            $(".edit-btn-next , .edit-btn-back").attr("disabled","true");

            $(".preLoad").removeClass( "Noloader" );
            $(".preLoad").addClass( "addloader" );

              $.ajax({
                    type: "POST",
                    url: base_url+"/property/post/update/"+$("#property_list_edit").attr('data-id'), 
                    data: new FormData($('#property_list_edit')[0]),
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



 
    var strCountry = $("#country_code").val();

    if(strCountry){
    var country_name = pac_input = $("#pac-input").val();
    if(pac_input == '')
    {
       var country_name = $("#country_name").val();
    }
   
   //alert(country_name);

   

    var latitude = parseFloat(document.getElementById('pro_lat').value);
    var longitude = parseFloat(document.getElementById('pro_lang').value);

    if(latitude !=='' && longitude !=='')
    {
       var pro_cityName = document.getElementById('pro_cityName').value;
        document.getElementById('lat').value=latitude;
        document.getElementById('lng').value=longitude;
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: latitude, lng:longitude },
            zoom: 9
          });

        var opt = { minZoom: 5, maxZoom: 15 };
        map.setOptions(opt);

        var latLng = new google.maps.LatLng(latitude, longitude);
        var marker = new google.maps.Marker({
            position: latLng,
            title:pro_cityName
        });
        marker.setMap(map);

        var geocoder =  new google.maps.Geocoder();
        geocoder.geocode( { 'address': pro_cityName}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
             map.setCenter(results[0].geometry.location);
             var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            document.getElementById('pro_lat').value=latitude;
            document.getElementById('pro_lang').value=longitude;

             var latLng = new google.maps.LatLng(latitude, longitude);

            marker.setPosition(results[0].geometry.location);
           marker.setVisible(true);
        }
      });

    }
    else
    {

        var lat = 40.725332;
        var lng = -73.997158; 
        document.getElementById('lat').value=lat;
        document.getElementById('lng').value=lng;
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: lat, lng:lng },
            zoom: 9
          });

        var opt = { minZoom: 5, maxZoom: 15 };
        map.setOptions(opt);

        var geocoder =  new google.maps.Geocoder();
        geocoder.geocode( { 'address': country_name = $("#country_name").val()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
             map.setCenter(results[0].geometry.location);
             var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            document.getElementById('pro_lat').value=latitude;
            document.getElementById('pro_lang').value=longitude;

             var latLng = new google.maps.LatLng(latitude, longitude);

            marker.setPosition(results[0].geometry.location);
           marker.setVisible(true);
        }
      });

    }
    

    
    var options = {
    //strictBounds: true,
   // types: ['(cities)'],
    componentRestrictions: {country: strCountry}
    };
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    //var types = document.getElementById('type-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input,options);

       // Bind the map's bounds (viewport) property to the autocomplete object,
       // so that the autocomplete requests use the current map bounds for the
       // bounds option in the request.
       autocomplete.bindTo('bounds', map);

       var infowindow = new google.maps.InfoWindow();
       
       

         google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });


          function placeMarker(location) {
              if(marker){ //on vérifie si le marqueur existe
                  marker.setPosition(location); //on change sa position
              }else{
                  marker = new google.maps.Marker({ //on créé le marqueur
                      position: location, 
                      map: map
                  });
              }
              $("#pro_lat").val(location.lat());
               $("#pro_lang").val(location.lng());
              getAddress(location);
          }

      function getAddress(latLng) {
        geocoder.geocode( {'latLng': latLng},
          function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
              if(results[0]) {
               $("input[name='location']").val(results[0].formatted_address);
              }
              else {
                $("input[name='location']").val("");
              }
            }
            else {
             $("input[name='location']").val("");
            }
          });
        }

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
              // User entered the name of a Place that was not suggested and
              // pressed the Enter key, or the Place Details request failed.
             // window.alert("No details available for input: '" + place.name + "'");
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
                $('#pro_lat').val(place.geometry.location.lat());
                $('#pro_lang').val(place.geometry.location.lng());
            
            
        });
    }
}


function EditinitMap() {


   
    var strCountry = $("#country_code").val();

    if(strCountry){
    var country_name = pac_input = $("#pac-input").val();
    if(pac_input == '')
    {
       var country_name = $("#country_name").val();
    }
   
   //alert(country_name);

    var lat = document.getElementById('pro_lat').value;
    var lng =document.getElementById('pro_lang').value;
     var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng:lng },
        zoom: 9
      });

    var opt = { minZoom: 5, maxZoom: 15 };
    map.setOptions(opt);

    var geocoder =  new google.maps.Geocoder();
      geocoder.geocode( { 'address': country_name =  $("input[name='location']").val()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
             map.setCenter(results[0].geometry.location);
             var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            document.getElementById('pro_lat').value=latitude;
            document.getElementById('pro_lang').value=longitude;

             var latLng = new google.maps.LatLng(latitude, longitude);

            marker.setPosition(results[0].geometry.location);
           marker.setVisible(true);
        }
      });
    var options = {
    //strictBounds: true,
   // types: ['(cities)'],
    componentRestrictions: {country: strCountry}
    };
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    //var types = document.getElementById('type-selector');

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



         google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });


          var marker;
          function placeMarker(location) {
              if(marker){ //on vérifie si le marqueur existe
                  marker.setPosition(location); //on change sa position
              }else{
                  marker = new google.maps.Marker({ //on créé le marqueur
                      position: location, 
                      map: map
                  });
              }
              $("#pro_lat").val(location.lat());
               $("#pro_lang").val(location.lng());
              getAddress(location);
          }

      function getAddress(latLng) {
        geocoder.geocode( {'latLng': latLng},
          function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
              if(results[0]) {
               $("input[name='location']").val(results[0].formatted_address);
              }
              else {
                $("input[name='location']").val("");
              }
            }
            else {
             $("input[name='location']").val("");
            }
          });
        }

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
              // User entered the name of a Place that was not suggested and
              // pressed the Enter key, or the Place Details request failed.
              //window.alert("No details available for input: '" + place.name + "'");
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
                  $('#pro_lat').val(place.geometry.location.lat());
                $('#pro_lang').val(place.geometry.location.lng());
            
        });
    }
}



// find custom places function
$(".neighbourhood").click(function(){

    // prepare variables (filter)
    //  var radius = document.getElementById('gmap_radius').value;
    // var keyword = document.getElementById('gmap_keyword').value;

   /* var lat = document.getElementById('pro_lat').value;
    var lng = document.getElementById('pro_lang').value;
    var cur_location = new google.maps.LatLng(lat, lng);

    // prepare request to Places
    var request = {
        location: cur_location,
        radius: 500,
        types: ['hospital']
    };
    

   console.log(request);

    service = new google.maps.places.PlacesService(map);
    service.search(request, createMarkers);*/
});


// clear overlays function
function clearOverlays() {
    if (markers) {
        for (i in markers) {
            markers[i].setMap(null);
        }
        markers = [];
        infos = [];
    }
}

// clear infos function
function clearInfos() {
    if (infos) {
        for (i in infos) {
            if (infos[i].getMap()) {
                infos[i].close();
            }
        }
    }
}

// Category Changed by type

  $( "#property_categorychanged" ).on( "change", function() {
   //alert(base_url+"/property/post/add");
  var curentSelect=$(this).val();
 if(curentSelect !== null)
  {


     $.ajax({
                    type: "POST",
                    url: base_url+"/property/selectcategory", 
                    data: {id:curentSelect},
                    success: function(response){
                   //console.log(property_typechanged);
                    $("#property_typechanged").html(response);
                      // if(response.status==true){window.location.href = response.url;  }else{location.reload();$(".showalert").show(response.alert);}
                    },
                   
                   
                });



  }
  else
  {
    $("#property_typechanged").html(' <option value="">Category</option>');
  }
  
});



  /*
     * edit form 
     * params : Name,Status,Slug  
     */
    $("#property_typechanged").change(function(e)
    {
        var bulding_area_show = $("#property_typechanged").find(':selected').data('bulding_area_show');
        $("#bulding_area_show").val(bulding_area_show);
        if(bulding_area_show == 0)
        {
            $(".bulding_area_show").hide();
        }
        else
        {
            $(".bulding_area_show").show();
            $(".bulding_area_show").removeClass("hide");
        }


        var landarea_show = $("#property_typechanged").find(':selected').data('landarea_show');
        $("#landarea_show").val(landarea_show);
        
        if(landarea_show == 0)
        {
            $(".landarea_show").hide();
        }
        else
        {
            $(".landarea_show").show();
            $(".landarea_show").removeClass("hide");
        }

        var bedroom_show = $("#property_typechanged").find(':selected').data('bedroom_show');
        $("#bedroom_show").val(bedroom_show);
        
        if(bedroom_show == 0)
        {
            $(".bedroom_show").hide();
        }
        else
        {
            $(".bedroom_show").show();
            $(".bedroom_show").removeClass("hide");
        }

        var bathroom_show = $("#property_typechanged").find(':selected').data('bathroom_show');
        $("#bathroom_show").val(bathroom_show);
        
        if(bathroom_show == 0)
        {
            $(".bathroom_show").hide();
        }
        else
        {
            $(".bathroom_show").show();
            $(".bathroom_show").removeClass("hide");
        }

    });



</script>
