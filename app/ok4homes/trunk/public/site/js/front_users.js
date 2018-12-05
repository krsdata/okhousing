$(function() {

$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });



  $("#Gcode").intlTelInput({
  initialCountry: "auto",
  allowDropdown: false,
  geoIpLookup: function(callback) {
     var countryCode = document.getElementById("hidcode").value;
      callback(countryCode);
    
  },
  utilsScript: "public/site/js/plugin/utils.js" // just for formatting/placeholders etc
});


  //fetch language and append based on selected country

    $.ajax({
        type: 'GET',
        url: base_url+"/users/getlanguage/", 
        dataType: 'json',
        success: function (data) {
        if(data.status==true) { 
            $(".namesection").html(data.html);
            $(".about_section").html(data.about_html); }
        else {   }
                  
        },              
    });
        
   

/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* login form */ 
    $("#login").submit(function(e)
    { 
       
    	 e.preventDefault();
    	// validate and process form here
        $("#loginerror").addClass("has-error");
        $("#loginerror .help-block").html(" "); 
                
        var email       =   $("[name='email']").val().trim();
        var password    =   $("[name='password']").val().trim();

        var a=0;
        var b=0;

        /* ------------------------------------------------------------------ */
        /* --------------------- email validation --------------------------- */
        /* ------------------------------------------------------------------ */

        if(email.length > 0)
        {  

            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) {
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
        /* --------------------- Password validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(password.length > 0)
        {  
            b=1;
            $("#passBox").removeClass("has-error");
            $("#passBox .help-block").html(' ');
        }
        else 
        { 
            b=0; 
            $("#passBox").addClass("has-error");
            $("#passBox .help-block").html('This field is required '); 
        }
        
        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */

           if(a===1 && b===1)
        {
            $.ajax({

                type: "POST",
                url:base_url+"/post_login",
                dataType: "json",
                async: false, 
                data: new FormData($('#login')[0]),
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                    if(response.status==true)
                    {
                        $("#usernameBox").removeClass("has-error");
                        $("#usernameBox .help-block").html(' ');

                        $("#passBox").removeClass("has-error");
                        $("#passBox .help-block").html(' ');
                        
                        window.location.href = response.url;
                    
                    }else if(response.status== 'not_exist'){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html("The email address that you've entered doesn't match any account.Sign up for an account."); 
                    }

                    else if(response.status==false){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html('These credentials do not match our records.'); 
                    }
                    else
                    {
                      $("#login_error").show().html(response.message);  
                    }
                    
          
  
                },
                error: function (request, textStatus, errorThrown) {
                    
                     var obj = request.responseJSON.errors ;
                     if(obj.hasOwnProperty("email") ) 
                    {
                        $("#usernameBox").addClass("has-error");
                        $("#usernameBox .help-block").html(request.responseJSON.errors.email[0]);
                    }
                    
                    if(obj.hasOwnProperty("password") )  
                    {
                        $("#passBox").addClass("has-error");
                        $("#passBox .help-block").html(request.responseJSON.errors.password[0]);
                    }

                }

            });
                         
        }

        return false;

    });
    /* login form end*/ 
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Registration tabs   */
    $('.signup-box .close-popup').unbind('click').click(function () {
       location.reload();
    });
    $('#categorys').attr('class', 'disabled');
    $('#profile').attr('class', 'disabled');
    $('#verification').attr('class', 'disabled');
    $('#myTab').on('show.bs.tab', 'a', function(event) {event.preventDefault();});
    $('#myTab').on('hide.bs.tab', 'a', function(event) {event.preventDefault();}); 
     
    /* Registration tabs end  */
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Registration 1st tab  */
    $(".Rnext1").unbind('click').click(function ()
    { 
        var name            =   $("[name='Gname']").val().trim();
        var email           =   $("[name='Gemail']").val().trim();
        var password        =   $("[name='Gpassword']").val().trim();
        var Cnfpassword     =   $("[name='Gpasswordconfirm']").val().trim();
        //var Mobile          =   $("[name='Gmobile']").val().trim();
        //var CodeMobile      =   $("[name='Gcode']").val().trim();
        var CodeMobile = $("#Gcode").intlTelInput("getNumber");
 
        var a=b=c=d=e=f=e=0;
        
//        name
        if(name.length > 0){  a=1;$(".GnameBox .val-error").html(' '); }
        else  {   a=0;   $(".GnameBox .val-error").html('This field is required ');  }
        
//        email
        if(email.length > 0)
        {  
            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) { b=1;   $(".emailBox .val-error").html(' ');   } 
            else  {   b=0;   $(".emailBox .val-error").html('Enter a valid email');  }
        }
        else  {   b=0;   $(".emailBox .val-error").html('This field is required ');  }
        
//        password
        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {   c=0;   $(".passwordBox .val-error").html('Minimum six characters,  at least one uppercase letter, one lowercase letter, one number, one special character, space is not allowed.');  }
        }
        else  {   c=0;   $(".passwordBox .val-error").html('This field is required ');  }
        
//        Cnfpassword
        if(Cnfpassword.length > 0)
        { 
            if(password != Cnfpassword ){ d=1;   $(".confirmBox .val-error").html('Password not matching');  }
            else  {  d=1;   $(".confirmBox .val-error").html('  ');  }
        } else  {   d=0;   $(".confirmBox .val-error").html('This field is required ');  }
       
       //        mobile number
        if(CodeMobile.length > 0){ 
            var valid = $("#Gcode").intlTelInput("isValidNumber");
            if(valid == true){
                e=1;
                $(".numberBox .val-error").html(' '); 
            }else{
                e=0;   
                $(".numberBox .val-error").html('Invalid Number.'); 
            }
            
        }
        else{ 
            e=0;   
            $(".numberBox .val-error").html('This field is required '); 
        }
      
       
       
       if(a===1 && b===1 && c===1 && d===1 && e==1)
       {

            $(".Rnext1").html("Processing");
            $(".Rnext1").attr("disabled","true");
           var formdata=  new FormData($('#registration_users')[0]);
           formdata.append('name', name);
           formdata.append('email', email);
           formdata.append('password', password);
           formdata.append('Mobile', CodeMobile);
           
          $.ajax({

                type: "POST",
                url:base_url+"/users/genaral-information",
                dataType: "json",
                async: false, 
                data: formdata,
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                  if(response.status==1)
                    { 
                        $("#gi").attr("style",'display:none');
                        $("#check_1").addClass("fas fa-check");
                        $("#categorys").html(response.html);
                        $('#categorys').removeClass('disabled');
                        $("#myTab .active, .tab-content .active").removeClass("active");
                        $("#categorys").addClass("active");
                        $('#myTab li:eq(1)').addClass("active");  
                    } else
                    {
                         $(".Rnext1").html("Next");
                        $(".Rnext1").removeAttr("disabled","disabled");

                        $("#gi-err").html(response.html);
                    }
                   
                },
                error: function (request, textStatus, errorThrown) 
                {
                    $(".Rnext1").html("Next");
                     $(".Rnext1").removeAttr("disabled","disabled");

                    var obj = request.responseJSON.errors ; 
                    if(obj.hasOwnProperty("name") ){  $(".GnameBox .val-error").html(request.responseJSON.errors.name[0]); }
                    if(obj.hasOwnProperty("email") ){ $(".emailBox .val-error").html(request.responseJSON.errors.email[0]); }
                    if(obj.hasOwnProperty("Mobile") ){ $("#mobileBox .val-error").html(request.responseJSON.errors.Mobile[0]); }
                }

            });   
       }
       
        return false;
    });
    /* Registration 1st tabs end  */ 
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Registration 2nd tab  */
    //Category change validate 
    $(document).on('click', '.chk-other-cat', function(e) {  
        if(this.checked) 
        { 
            $('.chk-other-cat').not(this).prop('checked', false);  
        }
        if($("[name='mainCat[]']:checked").length > 0)
        {
            $('.caterror').html("you can select only one main category or other category");
            $('.chk-main-cat').prop('checked', false);
        }else{$('.caterror').html(" ");} 
    });
 
    $(document).on('click', '.chk-main-cat', function(e) 
    {      
        if($("[name='otherCat[]']:checked").length > 0)
        { 
            $('.caterror').html("you can select only one main category or other category");
            $('.chk-other-cat').prop('checked', false);  
        }else{$('.caterror').html(" ");} 
    });   
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */

    /* Registration 2nd tab  */
    $(document).on('click', '.Rnext2', function(e)  
    { 
           var formdata=  new FormData($('#registration_users')[0]);
           
           if( ( $("[name='mainCat[]']:checked").length > 0 )&& ( $("[name='otherCat[]']:checked").length <= 0)  )
           {
               formdata.append('cat_type', 'main');
               $("[name='mainCat[]']:checked").each(function( index, value){
                    formdata.append('val[]',$(this).val() );
               });
           }
               
           if( ( $("[name='mainCat[]']:checked").length <= 0 )&& ( $("[name='otherCat[]']:checked").length > 0)  )
           {
               formdata.append('cat_type', 'other');
               $("[name='otherCat[]']:checked").each(function( index, value){
                    formdata.append('val[]',$(this).val() );
               });
              
           }
               
               
               $(".Rnext2").html("Processing");
                $(".Rnext2").attr("disabled","disabled");
                $.ajax({

                type: "POST",
                url:base_url+"/users/user-categories",
                dataType: "json",
                async: false, 
                data: formdata,
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                    if(response.status==1)
                    {  
                        $("#categorys").attr("style",'display:none');
                        $("#check_2").addClass("fas fa-check");
                        $("#profile").html(response.html);
                        $('#profile').removeClass('disabled');
                        $("#myTab .active, .tab-content .active").removeClass("active");
                        $("#profile").addClass("active");
                        $('#myTab li:eq(2)').addClass("active");  
                    } else
                    {
                        $(".Rnext2").html("Next");
                        $(".Rnext2").removeAttr("disabled","disabled");
                        $(".caterror").html(response.html);
                    }
                  
  
                },
                error: function (request, textStatus, errorThrown){}

            });  

    $.ajax({
        type: 'GET',
        url: base_url+"/users/getlanguage/", 
        dataType: 'json',
        success: function (data) {
        if(data.status==true) { 
            $(".about_section").html(data.about_html); }
        else {   }
                  
        },              
    });
               
            
    });
     /* Registration 2nd tab end */
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */ 
    $(document).on('change', '#image', function(e){ readURL(this);  });
 
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
/* Registration 3rd tab  */
  $(document).on('click', '.semi-finish', function(e){
      
    /* reg step 1 validation*/
        var name            =   $("[name='Gname']").val().trim();
        var email           =   $("[name='Gemail']").val().trim();
        var password        =   $("[name='Gpassword']").val().trim();
        var Cnfpassword     =   $("[name='Gpasswordconfirm']").val().trim(); 
        var CodeMobile      = $("#Gcode").intlTelInput("getNumber");
 
        var a=b=c=d=e=f=e=0;
        
//        name
        if(name.length > 0){  a=1;$(".GnameBox .val-error").html(' '); }
        else  {   a=0;   $(".GnameBox .val-error").html('This field is required ');  }
        
//        email
        if(email.length > 0)
        {  
            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) { b=1;   $(".emailBox .val-error").html(' ');   } 
            else  {   b=0;   $(".emailBox .val-error").html('Enter a valid email');  }
        }
        else  {   b=0;   $(".emailBox .val-error").html('This field is required ');  }
        
//        password
        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {   c=0;   $(".passwordBox .val-error").html('Minimum six characters,  at least one uppercase letter, one lowercase letter, one number, one special character, space is not allowed.');  }
        }
        else  {   c=0;   $(".passwordBox .val-error").html('This field is required ');  }
        
//        Cnfpassword
        if(Cnfpassword.length > 0) {  if(password != Cnfpassword ){ d=1;   $(".confirmBox .val-error").html('Password not matching');  }else  {  d=1;   $(".confirmBox .val-error").html('  ');  }
        } else  {   d=0;   $(".confirmBox .val-error").html('This field is required ');  }
       
//        mobile number
        if(CodeMobile.length > 0)
        { 
            var valid = $("#Gcode").intlTelInput("isValidNumber");
            if(valid == true){ e=1; $(".numberBox .val-error").html(' ');  }
            else{  e=0; $(".numberBox .val-error").html('Invalid Number.');   } 
        } else{  e=0;    $(".numberBox .val-error").html('This field is required ');    }
      
       
       
        if(a===1 && b===1 && c===1 && d===1 && e==1)
        {
            /* reg step 2 validation*/
            var a1=0;
            var b1=0;
            if( ( $("[name='mainCat[]']:checked").length > 0 )&& ( $("[name='otherCat[]']:checked").length <= 0)  ){a1=1;}
               
           if( ( $("[name='mainCat[]']:checked").length <= 0 )&& ( $("[name='otherCat[]']:checked").length > 0)  ){ b1=1;  }
            
             
            if(a1===1 || b1===1 )
            {
                /* reg step 3 validation */
                
                var slug = $(".slug").attr('data-slug');
                
                var slug_val =0;
                if (typeof slug != "undefined") 
                { 
                   /* put validation for other module */
                   if(slug == 'builders'){
                        var builder_name = $("#bname").val().trim();
                        var est_year = $("#est_year").val().trim();
                        var pinno = $("#pinno").val().trim();
                        var logo = $("#blogo").get(0).files.length;
                        var location = $("#location").val().trim();

						var s1=s2=s3=s4=s5=0;
                        //builder name validation
                        if(builder_name.length > 0){ s1=1;$(".Bnamebox .val-error").html(' ');
                        }else{s1=0;$(".Bnamebox .val-error").html('This field is required ');}

                        //established year validation
                        if(est_year.length > 0){ s2=1;$(".YearBox .val-error").html(' ');
                        }else{s2=0;$(".YearBox .val-error").html('This field is required ');}

                        //pin number validation
                        if(pinno.length > 0){s3=1;$(".PinBox .val-error").html(' ');
                        }else{s3=0;$(".PinBox .val-error").html('This field is required ');}

                        //builder logo validation
                        if(logo > 0){ s4=1;$(".Blogobox .val-error").html(' ');
                        }else{s4=0;$(".Blogobox .val-error").html('This field is required ');}

                        //location validation
                        if(location.length > 0){s5=1;$(".locationBox .val-error").html(' ');
                        }else{s5=0;$(".locationBox .val-error").html('This field is required ');}
						
						if(s1===1 && s2===1 && s3===1 && s4===1 && s5===1){slug_val=1;} 
						else{slug_val=0;}
                   }
                  
                }else { slug_val=1; }
                
                if(slug_val==1)
                {
                    /* go forwared  */
                   var formdata=  new FormData($('#registration_users')[0]);
                   if( ( $("[name='mainCat[]']:checked").length > 0 )&& ( $("[name='otherCat[]']:checked").length <= 0)  )
                   {
                       formdata.append('cat_type', 'main');
                       $("[name='mainCat[]']:checked").each(function( index, value){
                            formdata.append('val[]',$(this).val() );
                       });
                   }
                       
                   if( ( $("[name='mainCat[]']:checked").length <= 0 )&& ( $("[name='otherCat[]']:checked").length > 0)  )
                   {
                       formdata.append('cat_type', 'other');
                       $("[name='otherCat[]']:checked").each(function( index, value){
                            formdata.append('val[]',$(this).val() );
                       });
                      
                   }
                  
                    $(".semi-finish").html("Processing");
                     $(".semi-finish").attr("disabled","disabled");

                     $.ajax({

                        type: "POST",
                        url:base_url+"/users/create-users",
                        dataType: "json",
                        async: false, 
                        data: formdata,
                        processData: false,
                        contentType: false, 
                        success: function(response)
                        {

                            if(response.status==1)
                            {  
                                $("#profile").attr("style",'display:none');
                                $("#check_4").addClass("fas fa-check");
                                $("#verification").html(response.html);
                                $('#verification').removeClass('disabled');
                                $("#myTab .active, .tab-content .active").removeClass("active");
                                $("#verification").addClass("active");
                                $('#myTab li:eq(3)').addClass("active");  
                            } else
                            {
                                $(".semi-finish").html("Next");
                                $(".semi-finish").removeAttr("disabled","disabled");
                                $(".profilerror").html(response.html);
                            }
                            


                        },
                        error: function (request, textStatus, errorThrown){}

                    });  
                }
                /* reg step 3 validation end*/
            }
            else
            {
                   
                $("#categorys").attr("style",'display:block'); 
                $("#check_2,#check_3,#check_4").removeClass("fas fa-check");
                $("#profile,#verification").html(" "); 
                $("#myTab .active, .tab-content .active").removeClass("active");
                $("#categorys").addClass("active");
                $('#myTab li:eq(1)').addClass("active");
            }
                 
            /* reg step 2 validation end*/        
        }
        else
        {
            
            $("#gi").attr("style",'display:block');  
            $("#check_1,#check_2,#check_3,#check_4").removeClass("fas fa-check");
            $("#categorys,#profile,#verification").html(" "); 
            $("#myTab .active, .tab-content .active").removeClass("active");
            $("#gi").addClass("active");
            $('#myTab li:eq(0)').addClass("active");
        }
      /* reg step 1 validation end*/
  });
/* Registration 3rd tab  */
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */



/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* forgotpass form */ 
    $("#forgotpass").submit(function(e)
    { 
       
         e.preventDefault();
                
        var email       =   $("[name='forgotemail']").val().trim();
        var a=0;
        /* ------------------------------------------------------------------ */
        /* --------------------- email validation --------------------------- */
        /* ------------------------------------------------------------------ */

        if(email.length > 0)
        {  

            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) {
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
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */

        if(a===1 )
        {
            $.ajax({

                type: "POST",
                url:base_url+"/forgotpass",
                dataType: "json",
                async: false, 
                data: new FormData($('#forgotpass')[0]),
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                    if(response.status==true)
                    {
                        $("#usernameBox").removeClass("has-error");
                        $("#usernameBox .help-block").html(' ');
                        $("#loginerror").addClass("has-success");
                        $("#loginerror .help-block").html(response.html); 
                        //window.location.href = response.url;
                    
                    }else if(response.status== 'not_exist'){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html("The email address that you've entered doesn't match any account.Sign up for an account."); 
                    }

                    else if(response.status==false){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html('These credentials do not match our records.'); 
                    }
                    else
                    {
                      $("#login_error").show().html(response.message);  
                    }
                    
          
  
                },
                error: function (request, textStatus, errorThrown) {
                    
                     var obj = request.responseJSON.errors ;
                     if(obj.hasOwnProperty("email") ) 
                    {
                        $("#usernameBox").addClass("has-error");
                        $("#usernameBox .help-block").html(request.responseJSON.errors.email[0]);
                    }
               
                }
            });
                         
        }

        return false;

    });


});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#mypro').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


