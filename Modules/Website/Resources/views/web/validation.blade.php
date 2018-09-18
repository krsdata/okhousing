<style type="text/css">
    
    .signup a.signup-btn {
    width: 120px;
    display: block;
    cursor: pointer;
    background: #feb63d;
    padding: 13px 0px;
    text-align: center;
    border: 0;
    color: #fff;
    margin-top: 15px;
    border-radius: 10px;
    margin-bottom: 18px;
    margin-left: 13px;
    -webkit-box-shadow: -1px 3px 39px -12px rgba(0, 0, 0, 0.81);
    -moz-box-shadow: -1px 3px 39px -12px rgba(0, 0, 0, 0.81);
    box-shadow: -1px 3px 39px -12px rgba(0, 0, 0, 0.81);
}

</style>
<script type="text/javascript">

$(function() {

$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });



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
                $("#usernameBox .help-block").html("{{trans('countries::home/home.valid_mail_msg')}}");
            }
        }
        else 
        { 
            a=0 
            $("#usernameBox").addClass("has-error");
            $("#usernameBox .help-block").html("{{trans('countries::home/home.fieldRequired')}}");
        }
        
     
        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */

        if(a===1 )
        {
            $(".loginModalBtn").text("{{trans('countries::home/home.Processing')}}");
            $(".loginModalBtn").attr("disabled","disabled");
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
                  
                    $(".loginModalBtn").text("{{trans('countries::home/home.forgot_pass')}}");
                    $(".loginModalBtn").removeAttr("disabled");


                    if(response.status==1)
                    {
                        
                        $("#usernameBox").removeClass("has-error");
                        $("#usernameBox .help-block").html(' ');
                        $("#loginerror-fp_pass").addClass("has-success");
                        $("#loginerror-fp_pass .help-block").html(response.html); 
                        $('#forgotpass')[0].reset();

                        setTimeout(function(){ $(".forgotpass-box .close-popup").trigger("click");   $("#loginerror-fp_pass .help-block").html('');  }, 3000);
                    
                    }else if(response.status== 'not_exist'){
                        $("#loginerror-fp").addClass("has-error");
                        $("#loginerror-fp .help-block").html("{{trans('countries::home/home.DetailsNotExit')}}"); 
                    }

                    else if(response.status==false){
                        $("#loginerror-fp").addClass("has-error");
                        $("#loginerror-fp .help-block").html("{{trans('countries::home/home.invalid_login')}}"); 
                    }
                    else
                    {
                      $("#login_error-fp_pass").show().html(response.message);  
                    }
                    
                     setTimeout(function(){  $("#loginerror-fp .help-block").html('');  }, 3000);
  
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


 /* reset password  */
    $(".btnChangePassword").click(function (e)
    { 
        e.preventDefault();
        var password        =   $("#Rpassword").val().trim();
        var Cnfpassword     =   $("[name='Rconfirmpassword']").val().trim();
       var token     =   $("[name='token']").val().trim();
        var d=c=0;

        
//        password
        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {   c=0;   $(".passwordBox .val-error").html("{{trans('countries::home/home.passwordvalid')}}");  }
        }
        else  {   c=0;   $(".passwordBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
        
//        Cnfpassword
        if(Cnfpassword.length > 0)
        { 
            if(password != Cnfpassword ){ d=0;   $(".confirmBox .val-error").html("{{trans('countries::home/home.Passwordnotmatching')}}");  }
            else  {  d=1;   $(".confirmBox .val-error").html('  ');  }
        } else  {   d=0;   $(".confirmBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
       
      
       
       
       if( c===1 && d===1)
       {

            $(".btnChangePassword").html("{{trans('countries::home/home.Processing')}}");
            $(".btnChangePassword").attr("disabled","true");
           var formdata=  new FormData($('#ResetPassword')[0]);
           formdata.append('password', password);
           formdata.append('token', token);
           
          $.ajax({

                type: "POST",
                url:base_url+"/users/update_password",
                dataType: "json",
                async: false, 
                data: formdata,
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                   $(".btnChangePassword").html("{{trans('countries::home/home.change_pass')}}");
                     $(".btnChangePassword").removeAttr("disabled","disabled");


                  if(response.status==1)
                    { 
                       $("#loginerror-fp").addClass("has-success");
                        $("#success-up .success-msg").html(response.html); 
                        $('#ResetPassword')[0].reset();
                          setTimeout(function(){  $("#success-up .success-msg").html('');  window.location.href = base_url; }, 3000);
                         
                    
                    } else
                    {
                        $("#loginerror-fp").addClass("has-error");
                        $("#loginerror-fp .help-block").html(response.html); 
                        $('#ResetPassword')[0].reset();

                    }
                   
                },
                error: function (request, textStatus, errorThrown) 
                {
                   
                    $("#loginerror-fp").addClass("has-error");
                     $("#loginerror-fp .help-block").html("{{trans('countries::home/home.tryagain')}}"); 
                        $('#forgotpass')[0].reset();
                }

            });   
       }
       
        return false;
    });
    /* reset password end  */ 


/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* advertise  form */ 
    $("#adverise_form").submit(function(e)
    { 
       
         e.preventDefault();
        // validate and process form here
        $("#advertiseerror").addClass("has-error");
        $("#advertiseerror .help-block").html(" "); 
                
        var adv_name       =   $("[name='adv_name']").val().trim();
        var adv_email    =   $("[name='adv_email']").val().trim();
        var adv_phoneno       =   $("[name='adv_phoneno']").val().trim();
        var adv_message    =   $("[name='adv_message']").val().trim();


        var a=b=c=d=0;

        /* ------------------------------------------------------------------ */
        /* --------------------- email validation --------------------------- */
        /* ------------------------------------------------------------------ */

        if(adv_email.length > 0)
        {  

            if( /(.+)@(.+){2,}\.(.+){2,}/.test(adv_email) ) {
                a=1;  
                $("#usernameBox").removeClass("has-error");
                $("#usernameBox .help-block").html(' ');
            }
            else{
                a=0; 
                $("#usernameBox").addClass("has-error");
                $("#usernameBox .help-block").html("{{trans('countries::home/home.valid_mail_msg')}}");
            }
        }
        else 
        { 
            a=0 
            $("#usernameBox").addClass("has-error");
            $("#usernameBox .help-block").html("{{trans('countries::home/home.fieldRequired')}}");
        }
        
      
        
        /* ------------------------------------------------------------------ */
        /* --------------------- name validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(adv_message.length > 0)
        {  
            d=1;
            $("#messagebox").removeClass("has-error");
            $("#messagebox .help-block").html(' ');
        }
        else 
        { 
            d=0; 
            $("#messagebox").addClass("has-error");
            $("#messagebox .help-block").html("{{trans('countries::home/home.fieldRequired')}}"); 
        }
        

        /* ------------------------------------------------------------------ */
        /* --------------------- phone no. validation ------------------------ */
        /* ------------------------------------------------------------------ */
        if(adv_phoneno.length > 0){ 

            var telInput = $("#adv_phoneno");
              if ($.trim(telInput.val())) 
              {


                if (telInput.intlTelInput("isValidNumber")) 
                {
                    c=1;
                    $("#phonenobox").removeClass("has-error");
                    $("#phonenobox .help-block").html(' ');
                }
                else 
                {
                    c=0; 
                    $("#phonenobox").addClass("has-error");
                    $("#phonenobox .help-block").html("{{trans('countries::home/home.invalidnumber')}}");
                }
              }

           
        }
        else{ 
               c=0; 
            $("#phonenobox").addClass("has-error");
            $("#phonenobox .help-block").html("{{trans('countries::home/home.fieldRequired')}}");
        }


        /* ------------------------------------------------------------------ */
        /* --------------------- name validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(adv_name.length > 0)
        {  
            b=1;
            $("#nameBox").removeClass("has-error");
            $("#nameBox .help-block").html(' ');
        }
        else 
        { 
            b=0; 
            $("#nameBox").addClass("has-error");
            $("#nameBox .help-block").html("{{trans('countries::home/home.fieldRequired')}}"); 
        }

        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */

        if(a===1 && b===1 && c===1 && d===1)
        {
            $.ajax({

                type: "POST",
                url:base_url+"/post_advertise",
                dataType: "json",
                async: false, 
                data: new FormData($('#adverise_form')[0]),
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                    $('#adverise_form')[0].reset();
                    $("#advertiseerror").addClass("has-success");
                    $("#advertiseerror .help-block").html(response.message); 
                    setTimeout(function(){ $("#advertiseerror .help-block").html(''); $(".advertise-box .close-popup").trigger("click"); }, 3000);
                   
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



/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Update Password  */
    $(".btnUpdatePassword").click(function ()
    { 
        //var oldpassword        =   $("[name='oldpassword']").val().trim();
        var password        =   $("[name='Rpassword']").val().trim();
        var Cnfpassword     =   $("[name='confirmPassword']").val().trim();
       
        var a=b=c=0;

       /* //        password
        if(oldpassword.length > 0)
        {  
           a=1;   $(".oldpassword .val-error").html(' ');  
        }
        else  {   a=0;   $(".oldpassword .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
*/
        //        password
        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {b=1;   $(".Rpassword .val-error").html(' ');   } 
            else  {   b=0;   $(".Rpassword .val-error").html("{{trans('countries::home/home.passwordvalid')}}");  }
        }
        else  {   b=0;   $(".Rpassword .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
        
        //        Cnfpassword
        if(Cnfpassword.length > 0)
        { 
            if(password != Cnfpassword ){ c=1;   $(".confirmPassword .val-error").html("{{trans('countries::home/home.Passwordnotmatching')}}");  }
            else  {  c=1;   $(".confirmPassword .val-error").html('  ');  }
        } else  {   c=0;   $(".confirmPassword .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
       
 
       
       if( b===1 && c===1 )
       {

            $(".btnUpdatePassword").html("{{trans('countries::home/home.Processing')}}");
            $(".btnUpdatePassword").attr("disabled","true");
            var formdata=  new FormData($('#updatepassword')[0]);
          
          $.ajax({

                type: "POST",
                url:base_url+"/updatepassword",
                dataType: "json",
                async: false, 
                data: formdata,
                processData: false,
                contentType: false, 
                success: function(response)
                {
                  
                  if(response.status==1)
                    { 
                        $("#loginerror").removeClass("has-error");
                        $("#success-up .success-msg").html(response.message); 
                        $('#updatepassword')[0].reset();

                        setTimeout(function(){ $(".close-popup").trigger("click"); $("#success-up .success-msg").html('');}, 3000);


                    } else
                    {
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html(response.message); 
                        $("#oldpassword").val('');
                    }
                   $(".btnUpdatePassword").html("{{trans('countries::home/home.changepass')}}");
                    $(".btnUpdatePassword").removeAttr("disabled","disabled");
                },
                error: function (request, textStatus, errorThrown) 
                {
                    $(".btnUpdatePassword").html("{{trans('countries::home/home.changepass')}}");
                    $(".btnUpdatePassword").removeAttr("disabled","disabled");

                    $("#loginerror").addClass("has-error");
                    $("#loginerror .help-block").html("{{trans('countries::home/home.wrongoldpass')}}"); 
                    $("#oldpassword").val('');
                }

            });   
       }
       
        return false;
    });
    /* Registration 1st tabs end  */ 
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */


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
                $("#LusernameBox").removeClass("has-error");
                $("#LusernameBox .help-block").html(' ');
            }
            else{
                a=0; 
                $("#LusernameBox").addClass("has-error");
                $("#LusernameBox .help-block").html("{{trans('countries::home/home.loginemailvalid')}}");
            }
        }
        else 
        { 
            a=0 
            $("#LusernameBox").addClass("has-error");
            $("#LusernameBox .help-block").html("{{trans('countries::home/home.fieldRequired')}}");
        }
        
      
        
        /* ------------------------------------------------------------------ */
        /* --------------------- Password validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(password.length > 0)
        {  
            b=1;
            $("#LpassBox").removeClass("has-error");
            $("#LpassBox .help-block").html(' ');
        }
        else 
        { 
            b=0; 
            $("#LpassBox").addClass("has-error");
            $("#LpassBox .help-block").html("{{trans('countries::home/home.fieldRequired')}}"); 
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
                        $("#LusernameBox").removeClass("has-error");
                        $("#LusernameBox .help-block").html(' ');

                        $("#LpassBox").removeClass("has-error");
                        $("#LpassBox .help-block").html(' ');
                        if(response.wishlist == 0)
                        {
                            
                             window.location.href = response.url;
                        }
                        else
                        {
                            location.reload();
                           
                        }
                        
                        
                       
                    
                    }else if(response.status== 'not_exist'){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html("{{trans('countries::home/home.DetailsNotExit')}}"); 
                    }
                    else if(response.status== 'not_verified'){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html("{{trans('countries::home/home.unverifiedDetails')}}"); 
                    }
                     else if(response.status==false){
                        $("#loginerror").addClass("has-error");
                        $("#loginerror .help-block").html("{{trans('countries::home/home.incorrectDetails')}}"); 
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
                        $("#LusernameBox").addClass("has-error");
                        $("#LusernameBox .help-block").html(request.responseJSON.errors.email[0]);
                    }
                    
                    if(obj.hasOwnProperty("password") )  
                    {
                        $("#LpassBox").addClass("has-error");
                        $("#LpassBox .help-block").html(request.responseJSON.errors.password[0]);
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



 

   $("[name='Gpassword']").blur(function ()
    {
        var password        =   $("[name='Gpassword']").val().trim();

        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {    $(".passwordBox .val-error").html("{{trans('countries::home/home.passwordvalid')}}");  }
        }
        else  {    $(".passwordBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
       

    });

   $("[name='Gpassword']").focusout(function ()
    {
         var password        =   $("[name='Gpassword']").val().trim();

        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {    $(".passwordBox .val-error").html("{{trans('countries::home/home.passwordvalid')}}");  }
        }
        else  {    $(".passwordBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
       

    });


    /* Registration tabs end  */
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Registration 1st tab  */
    $(".Rnext1").unbind('click').click(function ()
    { 


        var isValid = ['true'];
        $('.namesection input').each(function() {
          var inputtype=$(this).attr('type');
      
          if(inputtype =='text' ){
              var inputname = $(this).attr("name");
             
              if($(this).val() !== '' ){  
              
                isValid.push('true');  
                $( "#"+inputname ).removeClass( "has-error" );
                $("#"+inputname+" .val-error").html(' ');
                
              }else{
                isValid.push('false'); 
                $( "#"+inputname ).addClass( "has-error" ); 
                $("#"+inputname+" .val-error").html("{{trans('countries::home/home.fieldRequired')}}");
              }
          }
        });

        var email           =   $("[name='Gemail']").val().trim();
        var password        =   $("[name='Gpassword']").val().trim();

        var Cnfpassword     =   $("[name='Gpasswordconfirm']").val().trim();

        
        //var Mobile          =   $("[name='Gmobile']").val().trim();
        //var CodeMobile      =   $("[name='Gcode']").val().trim();
        var CodeMobile = $("#Gcode").intlTelInput("getNumber");
 
        var a=b=c=d=e=f=e=0;
        
//        name
      //        email
        if(email.length > 0)
        {  
            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) {  isValid.push('true');    $(".emailBox .val-error").html(' ');   } 
            else  {   isValid.push('false');    $(".emailBox .val-error").html("{{trans('countries::home/home.emailvalid')}}");  }
        }
        else  {  isValid.push('false');    $(".emailBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
        
//        password
        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {  isValid.push('false');    $(".passwordBox .val-error").html("{{trans('countries::home/home.passwordvalid')}}");  }
        }
        else  {  isValid.push('false');    $(".passwordBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
        
//        Cnfpassword
        if(Cnfpassword.length > 0)
        { 
            if(password !== Cnfpassword ){ isValid.push('false');    $(".confirmBox .val-error").html('Password not matching');  }
            else  {  isValid.push('true');    $(".confirmBox .val-error").html('  ');  }
        } else  {   isValid.push('false'); ;   $(".confirmBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
       
       //        mobile number
        if(CodeMobile.length > 0){ 
            var valid = $("#Gcode").intlTelInput("isValidNumber");
            if(valid == true){
                 isValid.push('true');  
                $(".numberBox .val-error").html(' '); 
            }else{
               isValid.push('false'); 
                $(".numberBox .val-error").html("{{trans('countries::home/home.invalidnumber')}}"); 
            }
            
        }
        else{ 
           isValid.push('false'); 
            $(".numberBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}"); 
        }
      
       
       
      if($.inArray('false', isValid) < 0)
       {

            $(".Rnext1").html("{{trans('countries::home/home.Processing')}}");
            $(".Rnext1").attr("disabled","true");
            $(".preLoadSignup").removeClass( "Noloader" );
            $(".preLoadSignup").addClass( "addloader" );
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
                        $("#myTab .active, #myTabContent .active").removeClass("active");
                        $("#categorys").addClass("active");
                        $('#myTab li:eq(1)').addClass("active");  
                    } else
                    {
                         $(".Rnext1").html("Next");
                        $(".Rnext1").removeAttr("disabled","disabled");

                        $("#gi-err").html(response.html);
                    }
                   $(".preLoadSignup").addClass( "Noloader" );
                    $(".preLoadSignup").removeClass( "addloader" );
                },
                error: function (request, textStatus, errorThrown) 
                {
                    $(".Rnext1").html("Next");
                     $(".Rnext1").removeAttr("disabled","disabled");
                     $(".preLoadSignup").addClass( "Noloader" );
                      $(".preLoadSignup").removeClass( "addloader" );
                    var obj = request.responseJSON.errors ; 
                    if(obj.hasOwnProperty("name") ){  $(".GnameBox .val-error").html(request.responseJSON.errors.name[0]); }
                    if(obj.hasOwnProperty("email") ){ $(".emailBox .val-error").html(request.responseJSON.errors.email[0]); }
                    if(obj.hasOwnProperty("Gcode") ){ $("#mobileBox .val-error").html(request.responseJSON.errors.Gcode[0]); }
                }

            });   
       }
       
        return false;
    });
    /* Registration 1st tabs end  */ 
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */




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
               
               
                $(".Rnext2").html("{{trans('countries::home/home.Processing')}}");
                $(".Rnext2").attr("disabled","disabled");

                $(".preLoadSignup").removeClass( "Noloader" );
                $(".preLoadSignup").addClass( "addloader" );

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
                        $("#myTab .active, #myTabContent .active").removeClass("active");
                        $("#profile").addClass("active");
                        $('#myTab li:eq(2)').addClass("active");  
                    } else
                    {
                        $(".Rnext2").html("Next");
                        $(".Rnext2").removeAttr("disabled","disabled");
                        $(".caterror").html(response.html);
                    }
                  
                $(".preLoadSignup").addClass( "Noloader" );
                 $(".preLoadSignup").removeClass( "addloader" );
                },
                error: function (request, textStatus, errorThrown){

                     $(".preLoadSignup").addClass( "Noloader" );
                      $(".preLoadSignup").removeClass( "addloader" );
                }

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



/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
/* Registration 3rd tab  */

  $(document).on('click', '#UploadProData', function(e){
      
     
         var fileName = $("#image").val();
        if(fileName !=='')
           {
                var bytes = $("#image")[0].files[0].size;
                var img_size =  (bytes / 1048576).toFixed(3);
                if(img_size > 2)
                {
                    $("#ImageErrorValid").html("{{ trans('countries::home/home.Twomblimit') }}");
                    setTimeout(function(){ $("#ImageErrorValid").html(""); }, 5000);
                   ///
                    //alert("{{ trans('countries::home/home.Twomblimit') }}");
                    img=0;
                }
                else
                {
                    $("#ImageErrorValid").html("");

                    $("#UploadProData").text("{{trans('countries::home/home.Processing')}}");
                    $("#UploadProData").html("{{trans('countries::home/home.Processing')}}");

                    $(".preLoadSignup").addClass( "addloader" );
                    $(".preLoadSignup").removeClass("Noloader");
                    $(".preLoadSignup").addClass( "addloader" );
                    setTimeout(function(){ $(".semi-finish").trigger("click"); }, 3000);

                }
            }

        else
        {
                    $("#ImageErrorValid").html("");
                    $("#UploadProData").text("{{trans('countries::home/home.Processing')}}");
                    $("#UploadProData").html("{{trans('countries::home/home.Processing')}}");

                    $(".preLoadSignup").addClass( "addloader" );
                    $(".preLoadSignup").removeClass("Noloader");
                    $(".preLoadSignup").addClass( "addloader" );
                    setTimeout(function(){ $(".semi-finish").trigger("click"); }, 3000);
        }

      

});

  $(document).on('click', '.semi-finish', function(e){
      
       $(".preLoadSignup").addClass( "addloader" );
        $(".preLoadSignup").removeClass("Noloader");
        $(".preLoadSignup").addClass( "addloader" );

    /* reg step 1 validation*/
         var email           =   $("[name='Gemail']").val().trim();
        var password        =   $("[name='Gpassword']").val().trim();
        var Cnfpassword     =   $("[name='Gpasswordconfirm']").val().trim(); 
        var CodeMobile      = $("#Gcode").intlTelInput("getNumber");
 
        var a=b=c=d=e=f=e=0;
        


       

//        email
        if(email.length > 0)
        {  
            if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) { b=1;   $(".emailBox .val-error").html(' ');   } 
            else  {   b=0;   $(".emailBox .val-error").html("{{trans('countries::home/home.emailvalid')}}");  }
        }
        else  {   b=0;   $(".emailBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
        
//        password
        if(password.length > 0)
        {  
            if( /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,15}$/.test(password) ) {c=1;   $(".passwordBox .val-error").html(' ');   } 
            else  {   c=0;   $(".passwordBox .val-error").html("{{trans('countries::home/home.passwordvalid')}}");  }
        }
        else  {   c=0;   $(".passwordBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
        
//        Cnfpassword
        if(Cnfpassword.length > 0) {  if(password != Cnfpassword ){ d=1;   $(".confirmBox .val-error").html('Password not matching');  }else  {  d=1;   $(".confirmBox .val-error").html('  ');  }
        } else  {   d=0;   $(".confirmBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");  }
       
//        mobile number
        if(CodeMobile.length > 0)
        { 
            var valid = $("#Gcode").intlTelInput("isValidNumber");
            if(valid == true){ e=1; $(".numberBox .val-error").html(' ');  }
            else{  e=0; $(".numberBox .val-error").html("{{trans('countries::home/home.invalidnumber')}}");   } 
        } else{  e=0;    $(".numberBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");    }
      
       
        var img= 1;
        var fileName = $("#image").val();
        if(fileName !=='')
           {
                var bytes = $("#image")[0].files[0].size;
                var img_size =  (bytes / 1048576).toFixed(3);
                if(img_size > 2)
                {
                   $("#ImageErrorValid").html("{{ trans('countries::home/home.Twomblimit') }}");
                   setTimeout(function(){ $("#ImageErrorValid").html(""); }, 5000);
                   //alert("{{ trans('countries::home/home.Twomblimit') }}");
                    img=0;
                }
                else
                {
                     $("#ImageErrorValid").html("");
                }
            }

       
        if( b===1 && c===1 && d===1 && e==1 )
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
                        }else{s1=0;$(".Bnamebox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");}

                        //established year validation
                        if(est_year.length > 0){ s2=1;$(".YearBox .val-error").html(' ');
                        }else{s2=0;$(".YearBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");}

                        //pin number validation
                        if(pinno.length > 0){s3=1;$(".PinBox .val-error").html(' ');
                        }else{s3=0;$(".PinBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");}

                        //builder logo validation
                        if(logo > 0){ s4=1;$(".Blogobox .val-error").html(' ');
                        }else{s4=0;$(".Blogobox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");}

                        //location validation
                        if(location.length > 0){s5=1;$(".locationBox .val-error").html(' ');
                        }else{s5=0;$(".locationBox .val-error").html("{{trans('countries::home/home.fieldRequired')}}");}
            
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


                   if(img== '1')
                   {
                     $(".preLoadSignup").addClass( "addloader" );

                          $("#UploadProData").text("{{trans('countries::home/home.Processing')}}");
                            $("#UploadProData").html("{{trans('countries::home/home.Processing')}}");

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

                                         $(".preLoadSignup").addClass( "Noloader" ); 
                                         $(".preLoadSignup").removeClass( "addloader" );

                                        $("#profile").attr("style",'display:none');
                                        $("#check_3").addClass("fas fa-check");
                                        
                                        $("#verification").html(response.html);
                                        $('#verification').removeClass('disabled');
                                        $("#myTab .active, #myTabContent .active").removeClass("active");
                                        $("#verification").addClass("active");
                                        $('#myTab li:eq(3)').addClass("active");  
                                       

                                    } else
                                    {
                                        $(".preLoadSignup").addClass( "Noloader" ); 
                                         $(".preLoadSignup").removeClass( "addloader" );
                                        $(".profilerror").html(response.html);
                                        
                                    }
                                    
                                     


                                },
                                error: function (request, textStatus, errorThrown){

                                        $(".preLoadSignup").addClass( "Noloader" ); 
                                         $(".preLoadSignup").removeClass( "addloader" );

                                }

                            });  
                   }
                   else
                   {
                     $(".preLoadSignup").addClass( "Noloader" ); 
                                         $(".preLoadSignup").removeClass( "addloader" );
                   }
              

                    
                }
                /* reg step 3 validation end*/
            }
            else
            {
                $(".preLoadSignup").addClass( "Noloader" ); 
                $(".preLoadSignup").removeClass( "addloader" );
                $("#categorys").attr("style",'display:block'); 
                $("#check_2,#check_3,#check_4").removeClass("fas fa-check");
                $("#profile,#verification").html(" "); 
                $("#myTab .active, #myTabContent .active").removeClass("active");
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
            $("#myTab .active, #myTabContent .active").removeClass("active");
            $("#gi").addClass("active");
            $('#myTab li:eq(0)').addClass("active");
             $(".preLoadSignup").addClass( "Noloader" );
        }
      /* reg step 1 validation end*/
  });
/* Registration 3rd tab  */
/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */

});

</script>
