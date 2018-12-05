
    <div class="verification">
    <form action="{{URL('/post_login')}}" autocomplete="off" name="login" id="Directlogin" >
      

    <p>{{trans('countries::home/home.reg_success')}}</p>
            <div class="input-box">
                <input type="number" name="EnterOTP[]"  min="0" max="9" 
   onKeyUp="if(this.value>9){this.value='';}else if(this.value<0){this.value='0';}"class="EnterOTP" data-id="1" id="OTPnext1">
                <input type="number" name="EnterOTP[]"  min="0" max="9" 
   onKeyUp="if(this.value>9){this.value='';}else if(this.value<0){this.value='0';}" class="EnterOTP" data-id="2" id="OTPnext2" >
                <input type="number" name="EnterOTP[]"  min="0" max="9" 
   onKeyUp="if(this.value>9){this.value='';}else if(this.value<0){this.value='0';}" class="EnterOTP" data-id="3" id="OTPnext3">
                <input type="number" name="EnterOTP[]"  min="0" max="9" 
   onKeyUp="if(this.value>9){this.value='';}else if(this.value<0){this.value='0';}" class="EnterOTP"data-id="4" id="OTPnext4" >
    <button id="ResendOTP">{{trans('countries::home/home.resend')}}</button>
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
    <button class="signup-btn" id="verifyOtp">{{trans('countries::home/home.next_button')}}</button>
     </form>




     <div id="Finalsucess" style="display: none;">

            <div class="left-box">
                            <ul id="myTab">
                                <!--fas fa-check-->
                                
                                <li class=""><a href="#gi" data-toggle="tab">{{trans('countries::home/home.general_info')}} <i id="check_1 " class="fas fa-check"></i></a></li>
                                <li><a href="#categorys" data-toggle="tab">{{trans('countries::home/home.category_tab')}} <i id="check_2" class="fas fa-check"></i></a></li>
                                <li><a href="#profile" data-toggle="tab">{{trans('countries::home/home.profile_info')}} <i id="check_3" class="fas fa-check"></i></a></li>
                                <li><a href="#verification" data-toggle="tab">{{trans('countries::home/home.verification')}} <i id="check_4" class="fas fa-check"></i></a></li>
                                
                            </ul>
                        </div>
                        <div class="right-box">
                            <div id="myTabContent" class="tab-content">   
                                <!--General information-->
                                 <div class="tab-pane gi active in gi-success" id="gi">
                                     <div class="col-md-12 col-sm-12">
                                            <img src="{{asset('public/images/register.png')}}" alt="" id="mypro" class="mypro"/>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <h5 class="reg-title">{{trans('countries::home/home.reg_successful')}}</h5>
                                            <p>{{trans('countries::home/home.redirect')}}</p>
                                            <p class="reg-timer"><span class="c">30</span>:00</p>
                                        </div>
                                        <button class="signup-btn lastFinal">{{trans('countries::home/home.finish_button')}}</button>
                                </div>
                                <!--/General information-->
                                
                                <!--User Category-->
                                <div class="tab-pane fade in" id="categorys"></div>
                                <!--/User Category-->
                                
                                <!--User profile-->
                                <div class="tab-pane" id="profile"></div>
                                <!--User profile-->
                                <!--Verification-->
                                <div class="tab-pane" id="verification"></div>
                                <!--Verification-->
                  
                                
                                
                                
                            </div>
                        </div>
       
     </div>
<script type="text/javascript">
           
   $( ".EnterOTP" ).keyup(function() {
          $(this).next('.EnterOTP').focus();
        });


$('.verification').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    $('#verifyOtp').click();
   
  }
}); 

/* ************************************************************************* */
/* ************************************************************************* */
/* ************************************************************************* */
$('body').on('click', '.lastFinal', function() {
        window.location.href = base_url+"/dashboard"; 
    });


    /* Registration 4th tab  */
    $("#verifyOtp").click(function ()
    { 
        var EnterOTP ='';
        var OTPnext1 = $("#OTPnext1").val();
        EnterOTP= EnterOTP.concat(OTPnext1)

        var OTPnext2 = $("#OTPnext2").val();
        EnterOTP= EnterOTP.concat(OTPnext2)

        var OTPnext3 = $("#OTPnext3").val();
        EnterOTP= EnterOTP.concat(OTPnext3)

        var OTPnext4 = $("#OTPnext4").val();
        EnterOTP = EnterOTP.concat(OTPnext4)


        //var EnterOTP = $("input[name='EnterOTP[]']").map(function(){ str= str.concat($(this).val());  alert(str);}).get();

        var Original = $("#emailOTP").val();

        if(EnterOTP.length < 4)
        {
            $( ".EnterOTP" ).addClass( "has-error" ); 
            $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.enterotp")}}</label>');
        }
        else
        {
            if(EnterOTP !== Original)
            {
                $( ".EnterOTP" ).addClass( "has-error" ); 
                $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.invalidotp")}}</label>');
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
                            $('#verification').removeClass('disabled');
                           
                            $("#verification").html(response.html);
                            $(".modal-content").html($("#Finalsucess").html());
                            $(".gi").addClass("active in ");
                            // Start
                         c();

                        
                        } else
                        {
                            $("#verifyOtp").html("Next");
                            $("#verifyOtp").removeAttr("disabled","disabled");

                            $( ".EnterOTP" ).addClass( "has-error" ); 
                            $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.invalidotp")}}</label>');

                            $("input[name='EnterOTP[]']").map(function(){ $(this).val('');}).get();

                        }
                        
              
      
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                        $("#verifyOtp").html("Next");
                            $("#verifyOtp").removeAttr("disabled","disabled");


                        $( ".EnterOTP" ).addClass( "has-error" ); 
                        $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">{{trans("countries::home/home.invalidotp")}}</label>');
                        $("input[name='EnterOTP[]']").map(function(){ $(this).val('');}).get();

                    }

                });
            }
        }
                

      });


   function c(){
                    var n = 30;
                    var c=n;
                    $('.c').text(c);
                    setInterval(function(){
                        c--;
                        if(c>=0){
                            $('.c').text(c);
                        }
                        if(c==0){
                            $('.c').text('0');
                           window.location.href = base_url+"/dashboard"; 
                           n=0;
                        }
                    },1000);
                }

                



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

                        setTimeout(function(){ $(".help-block").html(''); }, 3000);

                        $("#ResendOTP").removeAttr("disabled","disabled");

                        
              
      
                    },
                    error: function (request, textStatus, errorThrown) {
                        
                        $("#ResendOTP").removeAttr("disabled","disabled");

                        $( ".EnterOTP" ).addClass( "has-error" ); 
                        $(".help-block").html('<label id="default_select-error" class="validation-error-label" for="default_select">Please try again</label>');
                        setTimeout(function(){ $(".help-block").html(''); }, 3000);

                    }

                });
});


</script>
