$(document).ready(function () {
    $('select').material_select();
});

     $(function() 
 {
     
      
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


function AddTowishlist(id ,LoggedIn=1)
{
    if(LoggedIn !== '0')
    {
            var status = $("#AddTowishlist_status").val();
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
                  
                    $('#property_enquiry')[0].reset();
                    $("#enquiryerror").addClass("has-success");
                    $("#enquiryerror .help-block").html('Your request send successfully'); 
                    $("#owner").html(response.result ); 
                    $("#trigerowner > a").trigger("click");
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
 
    // map show or hide

   $('#showHideMap').hide();  
  function ShowPropertyPopup(id)
    {
        
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
                    $("#PropertyDetails").html(response.html);
                    $('#PropertyDetailsOnMap').html(response.html)
                    $('.close-popup').hide();
                    $('#showHideMap').attr('href','#ShowMap');
                    $('#showHideMap').html('Show Map');

                    var href= $('#showHideMap').attr('href');

                    setTimeout(function(){
                        initializeMap();
                    },2000);
                     //$("#OpenPropertyDetailModal").trigger("click");
                        
                     $("span#Count_pro_"+id).text(response.pass_pro_count);
                     $('.nav-tabs > li.active > a').trigger('click');

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
