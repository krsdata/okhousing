$(function() 
{
 
/* ************************************************************************** */  
/* ************************************************************************** */ 
/* ************************************************************************** */

    /*
     * login form 
     * params : email,password  
     */
    
    $("#login").submit(function(e)
    {
        // validate and process form here
        e.preventDefault;
         
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
                $("#emailBox").removeClass("has-error");
                $("#emailBox .help-block").html(' ');
            }
            else{
                a=0; 
                $("#emailBox").addClass("has-error");
                $("#emailBox .help-block").html('Please enter a valid enail id ');
            }
        }
        else 
        { 
            a=0 
            $("#emailBox").addClass("has-error");
            $("#emailBox .help-block").html('This field is required ');
        }
        
      
        
        /* ------------------------------------------------------------------ */
        /* --------------------- Password validation ------------------------ */
        /* ------------------------------------------------------------------ */
        
        if(password.length > 0)
        {  
            b=1;
            $("#passwordBox").removeClass("has-error");
            $("#passwordBox .help-block").html(' ');
        }
        else 
        { 
            b=0; 
            $("#passwordBox").addClass("has-error");
            $("#passwordBox .help-block").html('This field is required '); 
        }
        
        /* ------------------------------------------------------------------ */
        /* ----------------- form submitting -------------------------------- */
        /* ------------------------------------------------------------------ */
        
        if(a===1 && b===1)
        {
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url:base_url+"/o4k/post_login",
                dataType: "json",
                async: false, 
                data: new FormData($('#login')[0]),
                processData: false,
                contentType: false, 
                success: function(response)
                {
                    
                    if(response.status==true)
                    {
                        $("#emailBox").removeClass("has-error");
                        $("#emailBox .help-block").html(' ');

                        $("#passwordBox").removeClass("has-error");
                        $("#passwordBox .help-block").html(' ');
                        
                        window.location.href = response.url;
                    
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
                        $("#emailBox").addClass("has-error");
                        $("#emailBox .help-block").html(request.responseJSON.errors.email[0]);
                    }
                    
                    if(obj.hasOwnProperty("password") )  
                    {
                        $("#passwordBox").addClass("has-error");
                        $("#passwordBox .help-block").html(request.responseJSON.errors.password[0]);
                    }
                    
//                console.log(request.responseText);
//                console.log(textStatus);
//                console.log(errorThrown);
                }
                });
                
                
   
                
        }
        
        /* ------------------------------------------------------------------ */
        /* ------------------------------------------------------------------ */
        /* ------------------------------------------------------------------ */
        
        return false;
        
    });
    
/* ************************************************************************** */  
/* ************************************************************************** */ 
/* ************************************************************************** */ 

    
    
  });
