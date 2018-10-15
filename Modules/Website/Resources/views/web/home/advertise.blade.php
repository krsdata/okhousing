
  <!--Advertise with us-->
    <section class="advertise">
        <div class="container">
            <div class="left-box">
                <h5>{{trans('countries::home/home.advertise_with_us')}}</h5>
            </div>
            <div class="right-box"><a href="" class="btn-link"  data-toggle="modal" data-target=".advertise-box" >{{trans('countries::home/home.click_here')}}</a></div>
        </div>
    </section>          
<!--/Advertise with us-->
 @php
$fcountry=Session::get('fcountry');
@endphp
 <div class="modal fade advertise-box" tabindex="-1" role="dialog" aria-labelledby="advertise-box" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm advertisedModal" role="document">
            <div class="modal-content">
                <div class="advertise-box">
                    <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                    <h3>{{trans('countries::home/home.ad_now')}}</h3>
                    <div id="advertiseerror"><span class="help-block"></span></div>

                    <form method="POST" action="" id="adverise_form" name="adverise_form" >
                    <div class="form-box">
                        <div class="input-field col-sm-6" id="nameBox" >
                            <input id="adv_name"  name="adv_name" type="text" placeholder ="{{trans('countries::home/home.name')}}" class="validate adv_input">
                            <!--label for="username">{{trans('countries::home/home.name')}}</label-->
                            <span class="help-block"></span> 
                        </div>
                        <div class="input-field col-sm-6 number" id="phonenobox">
                                <div class="intl-tel-input">
                                    <div class="flag-container"><div class="selected-flag" title="India (भारत): +91">
                                        <div class="iti-flag in"></div>
                                    </div>
                                </div>

                                <input type="tel" name="adv_phoneno" id="adv_phoneno" class="validate adv_input" placeholder="{{trans('countries::home/home.mobile_no')}}" value="" autocomplete="off">
                                 <label for="phoneNo"></label>
                                </div>
                                
                                <span class="help-block"></span>       

                          
                          
                            <!--input id="adv_phoneno" name="adv_phoneno" type="text" class="validate">
                            <label for="phoneNo">{{trans('countries::home/home.phone_no')}}</label>
                            <span class="help-block"></span--> 
                        </div>

                        <div class="input-field col-sm-12" id="usernameBox" >
                            <input id="adv_email" name="adv_email" type="text" class="validate adv_input" placeholder="{{trans('countries::home/home.ad_email')}}">
                            <!--label for="email">{{trans('countries::home/home.ad_email')}}</label-->
                            <span class="help-block"></span> 
                        </div>
                        
                        <div class="input-field col-sm-12 " id="messagebox" >
                            <textarea id="adv_message" name="adv_message" type="text" rows="3" class="validate adv_input" placeholder="{{trans('countries::home/home.ad_msg')}}"></textarea>
                            <!--label for="message">{{trans('countries::home/home.ad_msg')}}</label-->
                            <span class="help-block"></span> 
                        </div>

                        <button class="advertiseBtn">{{trans('countries::home/home.submit_button')}}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@php $fcountry=Session::get('fcountry');
$flag = $fcountry['flag'];
@endphp
       <script type="text/javascript">
             $('.advertise-box .close-popup ').unbind('click').click(function () {
                $("#adverise_form")[0].reset();
                 $(".val-error").html('');
            });
        $(function() {
                $("#adv_phoneno").intlTelInput({
                  initialCountry: "{{$flag}}",
                  allowDropdown: false,
                  geoIpLookup: function(callback) {
                     var countryCode = document.getElementById("hidcode1").value;
                     callback(countryCode);
                    
                  },
                  //utilsScript: base_url+"/public/site/js/plugin/utils.js" // just for formatting/placeholders etc
                });
        });

             $("#adv_phoneno").change(function()
                {
                  var telInput = $("#adv_phoneno");
                  if ($.trim(telInput.val())) 
                  {


                    if (telInput.intlTelInput("isValidNumber")) 
                    {
                       $(".phonenobox .val-error").html(' '); 
                    }
                    else 
                    {
                      $(".phonenobox .val-error").html('Invalid Number.'); 
                    }
                  }
                });

        </script>       
<style type="text/css">
    .advertisedModal  .has-error.has-success > span.help-block {
    margin-bottom: 25px;
    font-size: 16px;
    font-weight: 600;
}



.subscribe-section {
    padding: 40px 0;
    background-color: #AF0808;
}
.subscribe-section p {
    color: #fff;
}
.subscribe-section h2 {
    color: #fff;
    font-size: 30px;
    font-weight: 700;
}
.subscribe-form button {
  
    margin-top: 10px;
    right: 0;
    font-size: 24px;
    color: #af0808;
    font-weight: 700;
    text-transform: capitalize;
    padding: 0 50px;
    height: 49px;
    border: inherit;
    border-radius: 0px;
    background-color: #fff;
}
.subscribe-form .form-control {
    height: 52px;
    border: 1px solid #fff;
    border-radius: 0px;
    font-size: 16px;
    color: #fff;
    background-color: inherit;
    padding: 0 200px 0 16px;
}

</style>


<div class="subscribe-section">
    <div class="container">
	<div class="row text-center">
	    <div class="col-md-offset-2 col-md-8 col-sm-12 text-center"> 
		<h2>Subscribe our Newsletter</h2>
		<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sollicitudin fermentum dolor. Nunc nec augue urna.</p>-->
		<div class="subscribe-form">
		    <form>
               <input name="subscribe" class=" form-control" placeholder="your mail here" type="text">
               <button type="submit" value="submit">submit</button>
            </form>
            
                        
                    </div>
	</div>
	</div>
</div>
</div>
