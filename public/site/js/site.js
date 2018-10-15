$(document).ready(function () {
    $('select').material_select();
});

function closeThis(){
     $('.PropertyDetailsOnMap').hide();
     $('.profile').show();
}
function setUrl(time=500){
        setTimeout(function(){
            var v = $('.list-one > li > h3').length;
            if(v){
               var search = $('.list-one > li > h3').text(); 
                $('title').html(search);  
            }else if($('#searchLocation_').length){
                var search = $('#searchLocation_').val();  
                if(search.length){
                    $('title').html(search);   
                }else{
                    var search = $('.loaction').text();
                    $('title').html(search);   
                }
                
            }

        },time);    
}
setUrl(500);

 $(function() 
 {
    $('.content_wrapper').click(function(){
        setUrl(500);
    });

   
  $('#showHideMap').click(function(){
    //$('#Mymap').toggle();

    var txt = $('#showHideMap').html();

    var href= $('#showHideMap').attr('href');

    if(href=='#ShowMap'){
        $('#showHideMap').attr('href','#HideMap');
        $('#showHideMap').html('Hide Map');
        $('#Mymap').show();
        $('.PropertyDetailsOnMap').hide();    
    }

    if(href=='#HideMap'){
        $('#showHideMap').attr('href','#ShowMap');
        $('#showHideMap').html('Show Map');
        $('#Mymap').hide();
        $('.PropertyDetailsOnMap').show();    
    }
  });

    $.get(base_url+"/country", function(data, status)
    {
         if(data.response==true)
        { 
            $('#mesh_wrapper').html(data.SliderHtml);
            $('#fcountry_lang').html(data.LanguageHtml); 
            $('#fcountry').html(data.CountryHtml);
        }
        else { window.location.href = data.url; } 
    });
    
   
    $("#fcountry").on("click",".dropdown-menu li",function() 
    {
        var is_home;  
        if (typeof ($("[name='is_home']").val()) === "undefined")  { is_home=0; }
        else{is_home=$("[name='is_home']").val().trim();}
        $.get(base_url+"/change_country/"+$(this).attr('data-lang')+"/"+is_home, function(data, status)
       {
        
            if(data.response==true)
            { 
               //window.location.href = base_url+data.urlAppend;
                location.reload();
            }
            else { window.location.href = data.url; 
            } 
       });

          
    });

    $("#fcountry_lang").on("click",".dropdown-menu li",function() 
    {
        var is_home;  
        if (typeof ($("[name='is_home']").val()) === "undefined")  { is_home=0; }
        else{is_home=$("[name='is_home']").val().trim();}
        $.get(base_url+"/change_language/"+$(this).attr('data-lang')+"/"+is_home, function(data, status)
       {
            if(data.response==true)
            { 
                 location.reload();
            }
            else { window.location.href = data.url; } 
       });

          
    });
     
    
 });


     function ShowProperty(id)
    {
        /*$.ajax({
            type: "GET",
            url: base_url+"/search/ShowProperty/"+id, 
            dataType: "json",  
            cache:false,
            contentType: false,                   
            processData:false,
            success: function(response){
               if(response.status==true){ $("#PropertyDetails").html(response.html);
                     $("#OpenPropertyDetailModal").trigger("click");
                    
                   }
              
            },
            error: function (request, textStatus, errorThrown) {
                
            }             
        });*/

         window.location.href = base_url+"/search/property/"+id; 
    }

$('body').on('click', '#OpenPropertyDetailModal', function() {
       initializeMap();
    });

// get cookies
function getCookie(cookieName)
        {
          var name = cookieName + "=";
          var allCookieArray = document.cookie.split(';');
         // console.log(allCookieArray);
          for(var i=0; i<allCookieArray.length; i++)
          {
            var temp = allCookieArray[i].trim();
            if (temp.indexOf(name)==0)
            return temp.substring(name.length,temp.length);
          }
          return "";
    }
    // delete cookies
  function deleteCookies(name){
    document.cookie = name+"= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
  }  
// set cookies for enquiry  
function setCookie() {
    var d = new Date();
    var total_enquiry = "total_enquiry";

    d.setTime(d.getTime() + (86400));
    var expires = "expires="+ d.toUTCString();
    var old_count = getCookie('total_enquiry');
    
    if(old_count=='NaN' || old_count.length==0){
       count=1;
    }else{
       count= parseInt(old_count)+1;
    }
    console.log(old_count);
    document.cookie = total_enquiry + "=" + count + ";" + expires + ";path=/";
}
 
function AddTowishlist(id ,LoggedIn=1)
{
     console.log(LoggedIn);


    if(LoggedIn !== '0' || LoggedIn == '0')
    {
            var status = $("#AddTowishlist_status").val();
            console.log('status:'+status);
            if(status == 'inactive')
              {
                $("#i_AddTowishlist_"+id).removeClass("inactive");
                $("#i_AddTowishlist_"+id).addClass("active");
                $("#AddTowishlist_status").val('active');
              }
              else
              {
               $("#i_AddTowishlist_"+id).removeClass("active");
                $("#i_AddTowishlist_"+id).addClass("inactive");
                $("#AddTowishlist_status").val('inactive');
              }
            $.ajax({

                    type: "POST",
                    url:base_url+"/search/AddTowishlist",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#AddTowishlist_'+id)[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {
                        console.log(response);
                        if(response.status == true)
                        {

                            setTimeout(function(){ $(".modal1 .close-popup").trigger("click"); }, 3000);
                            $("#Propert_fvt_"+id).hide();

                        }
                     
                       
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                        

                    }

            });
    }
    else
    {
       $(".modal1 .close-popup").trigger("click");
        $("#opensignin").trigger("click");
        $("#wishlistid").val(id);
       
    }
    

}


/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* advertise  form */ 

$('body').on('click', '#property_enquiry_btn', function(e) {
       e.preventDefault();
        // validate and process form here
        $("#enquiryerror").addClass("has-error");
        $("#enquiryerror .help-block").html(" "); 
                
        var enquiry_name       =   $("[name='enquiry_name']").val().trim();
        var enquiry_email    =   $("[name='enquiry_email']").val().trim();
        var enquiry_phone       =   $("[name='enquiry_phone']").val().trim();
        var enquiry_message    =   $("[name='enquiry_message']").val().trim();
        var enquiry_subject    =   $("[name='enquiry_subject']").val().trim();



        var a=b=c=d=e=0;

        /* ------------------------------------------------------------------ */
        /* --------------------- email validation --------------------------- */
        /* ------------------------------------------------------------------ */

        if(enquiry_email.length > 0)
        {  

            if( /(.+)@(.+){2,}\.(.+){2,}/.test(enquiry_email) ) {
                a=1;  
                $("#usernameBox").removeClass("has-error");
                $("#usernameBox .help-block").html(' ');
            }
            else{
                a=0; 
                $("#usernameBox").addClass("has-error");
                $("#usernameBox .help-block").html('Please enter a valid email id ');
            }
        }
        else 
        { 
            a=0 
            $("#usernameBox").addClass("has-error");
            $("#usernameBox .help-block").html('This field is required ');
        }
        
      
        
        /* ------------------------------------------------------------------ */
        /* --------------------- name validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(enquiry_message.length > 0)
        {  
            d=1;
            $("#messagebox").removeClass("has-error");
            $("#messagebox .help-block").html(' ');
        }
        else 
        { 
            d=0; 
            $("#messagebox").addClass("has-error");
            $("#messagebox .help-block").html('This field is required '); 
        }
        

        /* ------------------------------------------------------------------ */
        /* --------------------- phone no. validation ------------------------ */
        /* ------------------------------------------------------------------ */
        if(enquiry_phone.length > 0){ 
            /*var valid = $("#enquiry_phone").intlTelInput("isValidNumber");
            console.log(valid);
            if(valid == true){
                c=1;
            $("#phonenobox").removeClass("has-error");
            $("#phonenobox .help-block").html(' ');
            }
            else
            {
                 c=0; 
            $("#phonenobox").addClass("has-error");
            $("#phonenobox .help-block").html('Invalid Number'); 
            }*/
             c=1;
            $("#phonenobox").removeClass("has-error");
            $("#phonenobox .help-block").html(' ');
        }
        else{ 
               c=0; 
            $("#phonenobox").addClass("has-error");
            $("#phonenobox .help-block").html('This field is required');
        }


        /* ------------------------------------------------------------------ */
        /* --------------------- name validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(enquiry_name.length > 0)
        {  
            b=1;
            $("#nameBox").removeClass("has-error");
            $("#nameBox .help-block").html(' ');
        }
        else 
        { 
            b=0; 
            $("#nameBox").addClass("has-error");
            $("#nameBox .help-block").html('This field is required '); 
        }

        if(enquiry_subject.length > 0)
        {  
            e=1;
            $("#subjectbox").removeClass("has-error");
            $("#subjectbox .help-block").html(' ');
        }
        else 
        { 
            e=0; 
            $("#subjectbox").addClass("has-error");
            $("#subjectbox .help-block").html('This field is required '); 
        }

        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */

        if(a===1 && b===1 && c===1 && d===1 && e==1)
        {
            $.ajax({

                type: "POST",
                url:base_url+"/post_enquiry",
                dataType: "json",
                async: false, 
                data: new FormData($('#property_enquiry')[0]),
                processData: false,
                contentType: false, 
                success: function(response)
                {
                 var enq = getCookie('total_enquiry');
                console.log('enquiry:'+enq);
                 if(response.auth==false){
                    $(".modal1 .close-popup").trigger("click");
                    $("#opensignin").trigger("click");

                    return false;
                 }else{ 
                        if( enq.length==0 || enq=='NaN'){
                            setCookie();
                            var enquiry_count = 1;
                        }else{
                           setCookie(); 
                            if(enq>25){
                                  var html = 'You have exceeded maximum number of enquiry for today.';
                                  $('#AlertMsg').html(html);
                                  $("#myModalBox").trigger("click");
                              //  $("#wishlistid").val(id);
                            }else{
                                $('#property_enquiry')[0].reset();
                                $("#enquiryerror").addClass("has-success");
                                $("#enquiryerror .help-block").html('Your request send successfully'); 
                                $("#owner").html(response.result ); 
                                $("#trigerowner > a").trigger("click");
                            }   
                           
                        }
                 }

                    
                    //setTimeout(function(){ $("#enquiryerror .help-block").html(''); $(".modal1 .close-popup").trigger("click"); }, 6000);
                   
                },
                error: function (request, textStatus, errorThrown) {
                    
                    

                }

            });
                         
        }

        return false;

    });
    /* login form end*/ 
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
function initializeMapForProperties() {    
    // prepare Geocoder 

        geocoder = new google.maps.Geocoder();

        if($("#Pro_map_lat").length){
            var lat = $("#Pro_map_lat").val();
        }
        else if($("#lat_searchLocation").length){
            var lat = $("#lat_searchLocation").val();
        }

         if($("#Pro_map_lang").length){
           var lang= $("#Pro_map_lang").val();
        }else if($("#lang_searchLocation").length){
           var lang= $("#lang_searchLocation").val();
        }

        if(lang){
             var myLatlng = new google.maps.LatLng(lat,lang);

            var myOptions = { // default map options
                zoom: 15,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
         
            map = new google.maps.Map(document.getElementById('Mymap'), myOptions);

            map.setOptions({ minZoom: 5, maxZoom: 20 });
        
        
        var marker = new google.maps.Marker({
                  draggable: true,
                  position: myLatlng,
                  map: map,
                  title: 'test',
                  icon: base_url+'/public/Mapicon.png'
              });
              // on drag
        var geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(marker, 'click', function (event) {
            infoWindow.open(map, marker);
            geocoder.geocode({
              'latLng': event.latLng
            }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  if (results[0]) {
                    infoWindow.setContent(results[0].formatted_address);
                    infoWindow.open(map, marker);

                  }
                }
            });

            });

              var infoWindow = new google.maps.InfoWindow({

              });  
        }
  }


  function initializeMap() {  
        geocoder = new google.maps.Geocoder();

        if($("#Pro_map_lat").length){
            var lat = $("#Pro_map_lat").val();
        }
         if($("#Pro_map_lang").length){
           var lang= $("#Pro_map_lang").val();
        }

        if($("#lat_searchLocation").length){
            var lat = $("#lat_searchLocation").val();
        }
        
        if($("#lang_searchLocation").length){
           var lang= $("#lang_searchLocation").val();
        }

        var myLatlng = new google.maps.LatLng(lat,lang);

        var myOptions = { // default map options
            zoom: 15,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
     
        map = new google.maps.Map(document.getElementById('Mymap'), myOptions);

         map.setOptions({ minZoom: 5, maxZoom: 20 });
            marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
             zoom: 15,
            icon: base_url+'/public/Mapicon.png',
          });
  }

 
    // map show or hide

 function showProfile(){
    $('#PropertyDetailsOnMap').hide();
    $('.profile').show();
 }
   $('#showHideMap').hide();  
  function ShowPropertyPopup(id)
    {
        $('#PropertyDetailsOnMap').show(); 
        if($('.profile').length){
            $('.profile').hide();    
        } 
      //  $('#PropertyDetailsOnMap').show();
        $.ajax({
            type: "GET",
            url: base_url+"/search/ShowProperty/"+id, 
            dataType: "json",  
            cache:false,
            contentType: false,                   
            processData:false,
            success: function(response){
               if(response.status==true){ 
                    $('#showHideMap').show(); 
                    $("#Mymap").hide();
                    $('.PropertyDetailsOnMap').show();    
                   // $("#PropertyDetails").html(response.html);
                    $('#PropertyDetailsOnMap').html(response.html)
                     setUrl(500);
                    initializeMapForProperties();

                    
                   
                    $('.list-detail-main > .close-popup').hide();
                    $('#showHideMap').attr('href','#ShowMap');
                    $('#showHideMap').html('Show Map');

                    var href= $('#showHideMap').attr('href');

                    setTimeout(function(){
                          
                     //   initializeMap();
                       
                       // initializeMap2();
                    },2000);
                     //$("#OpenPropertyDetailModal").trigger("click");
                        
                     $("span#Count_pro_"+id).text(response.pass_pro_count);
                     $('.nav-tabs > li.active > a').trigger('click');
                    // initializeMap2();

                   }
                else if(response.status==false){ $("#PropertyDetails").html(response.html);
                    alert("Property has been deleted");
                     $("span#Count_pro_"+id).text(response.pass_pro_count);
                     
                   }
            },
            error: function (request, textStatus, errorThrown) {
                
            }             
        });
    }
  function ShowSimilarPropertyPopup(id)
    {
        $(".close-popup").trigger("click");
        

        $.ajax({
            type: "GET",
            url: base_url+"/search/ShowProperty/"+id, 
            dataType: "json",  
            cache:false,
            contentType: false,                   
            processData:false,
            success: function(response){
               if(response.status==true){ $("#PropertyDetails").html(response.html);
                     $("#OpenPropertyDetailModal").trigger("click");
                        
                      $("span#Count_pro_"+id).text(response.pass_pro_count);
                   }
              
            },
            error: function (request, textStatus, errorThrown) {
                
            }             
        });
    }
