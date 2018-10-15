
    <div class="verification">
    <form action="{{URL('/post_login')}}" autocomplete="off" name="login" id="Directlogin" >
      

    <p>You have successfully registered.Please verify your email address, we have sent an email verification link to your email id.</p>
            <div class="input-box">
                <input type="text" name="EnterOTP[]"  class="EnterOTP" >
                <input type="text" name="EnterOTP[]"  class="EnterOTP" >
                <input type="text" name="EnterOTP[]"  class="EnterOTP" >
                <input type="text" name="EnterOTP[]"  class="EnterOTP" >
                <button id="ResendOTP">Resend</button>
            </div> 
    <input type="hidden" value="{{$Gemail}}" name="email">
    <input type="hidden" value="{{$validate}}" name="password">
    <input type="hidden" value="{{$email_token}}" name="email_token">
    <input type="hidden" name="remember_me" value="1" />
    <input type="hidden" name="otp_verified" value="0" />
    <input type="hidden" value="{{$otp}}" name="emailOTP" id="emailOTP"> 
    <span  class="help-block"></span>                        
    </div>
    <div class="val-error profilerror" style="margin-top: -6px !important;margin-left: 18px;"> </div>
    <div class="clearfix"></div>
    <button class="signup-btn" id="verifyOtp">Next</button>
     </form>

<style type="text/css">
    input.EnterOTP.has-error {
    border: 1px solid red;
}
.validation-error-label {
    color: red;
}
label#default_select-success {
    color: green;
}
</style>
<script type="text/javascript">
    


/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Registration 4th tab  */
    $("#verifyOtp").click(function ()
    { 
        var str ='';
        var EnterOTP = $("input[name='EnterOTP[]']").map(function(){ str= str.concat($(this).val());}).get();
        var Original = $("#emailOTP").val();
        if(str.length < 4)
        {
            $( ".EnterOTP" ).addClass( "has-error" ); 
            $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Enter OTP</label>');
        }
        else
        {
            if(str !== Original)
            {
                $( ".EnterOTP" ).addClass( "has-error" ); 
                $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalide OTP entered . </label>');
                 $("input[name='otp_verified']").val("0");
            }
            else
            {

                $("#verifyOtp").html("Processing");
                $("#verifyOtp").attr("disabled","disabled");

                $( ".EnterOTP" ).removeClass( "has-error" ); 
                $(".help-block").html('');
                $("input[name='otp_verified']").val("1");
                $.ajax({
                    type: "POST",
                    url:base_url+"/post_login",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#Directlogin')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {
                      
                        if(response.status==true)
                        {
                            window.location.href = response.url;
                        
                        } else
                        {
                            $("#verifyOtp").html("Next");
                            $("#verifyOtp").removeAttr("disabled","disabled");

                            $( ".EnterOTP" ).addClass( "has-error" ); 
                            $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalide OTP entered . </label>');

                        }
                        
              
      
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                        $("#verifyOtp").html("Next");
                            $("#verifyOtp").removeAttr("disabled","disabled");


                        $( ".EnterOTP" ).addClass( "has-error" ); 
                        $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Invalide OTP entered . </label>');

                    }

                });
            }
        }
                

      });



/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
    /* Registration 4th tab  */
    $("#ResendOTP").click(function (e)
    { 
        e.preventDefault();
        $("input[name='EnterOTP[]']").map(function(){ $(this).val('');}).get();
        
        $("#ResendOTP").attr("disabled","disabled");


        $.ajax({
                    type: "POST",
                    url:base_url+"/ResendOTP",
                    dataType: "json",
                    async: false, 
                    data: new FormData($('#Directlogin')[0]),
                    processData: false,
                    contentType: false, 
                    success: function(response)
                    {
                      
                        if(response.status==true)
                        {
                           $("#emailOTP").val(response.html);
                           $(".help-block").html('<label id="default_select-success" class="validation-success-label" for="default_select">'+response.message+'</label>');
                        
                        } else
                        {
                            $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">'+response.html+'</label>');

                        }
                        $("#ResendOTP").removeAttr("disabled","disabled");

                        
              
      
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                        $("#ResendOTP").removeAttr("disabled","disabled");

                        $( ".EnterOTP" ).addClass( "has-error" ); 
                        $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please try again</label>');

                    }

                });
});
</script>
