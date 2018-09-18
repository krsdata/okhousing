  <?php if(!Auth::guard('front_user')->user()) { ?>
  <!--sign in-->
      <div class="modal fade signin-box" tabindex="-1" role="dialog" aria-labelledby="signin-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                    <form action="{{URL('/post_login')}}" method="POST" autocomplete="off" name="login" id="login" >
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="wishlistid" name="wishlistid" type="hidden" class="validate">


                    <div class="sibox">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <h3>{{trans('countries::home/home.sign_in')}}</h3>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="LusernameBox">
                                <div class="input-field">
                                    <input id="email" name="email" type="text" class="validate">
                                    <label for="username">{{trans('countries::home/home.email')}}</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <div id="LpassBox">
                                <div class="input-field">
                                    <input id="password" name="password" type="password" class="validate">
                                    <label for="password">{{trans('countries::home/home.password')}}</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <ul class="signin-items">
                                <li>
                                    <input type="checkbox" class="filled-in" id="filled-in-box" name="remember_me" value="1" />
                                    <label for="filled-in-box">{{trans('countries::home/home.remb_me')}}</label>
                                </li>
                                <li><a href="#" data-toggle="modal" data-target=".loginModal-box" data-dismiss="modal" > {{trans('countries::home/home.forgot_pass')}}</a></li>
                            </ul>
                            <button class="signbtn">Sign in</button>
                            <p class="txt-create-ac">{{trans('countries::home/home.create_accnt')}} <button data-toggle="modal" data-target=".signup-box" data-dismiss="modal" class="signup-btn">{{trans('countries::home/home.sign_up')}}</button></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
      <script type="text/javascript">
           $('.signup-box .close-popup ,.signin-box .close-popup').unbind('click').click(function () {
                // location.reload();
                $("#login")[0].reset();
                $("#registration_users")[0].reset();
                 $(".val-error").html('');
            });

      </script>       

<?php } ?>
<style type="text/css">
    
.signin .sibox{
padding:45px !important;
position:relative !important;
}
.signin .sibox .close-popup
{    width: 12px !important;
    height: 12px !important;
    right:30px !important;
    top:30px !important;

}

.signin .sibox h3 {
    font-size: 16px !important;
text-align: left !important;
padding-top: 0px !important;
margin-bottom: 15px !important;
    text-transform: uppercase !important;
}
.signin .sibox input
{
        padding: 7px 10px 7px 0 !important;
    width:95.6% !important;
    color: #4e5e87 !important;
    margin: 0 0 10px 0 !important;
    border-bottom: 1px solid #eeecec !important;
    font-family: 'Gotham HTF' !important;
}


.signin .sibox .signin-items{
margin-top: 10px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}


.signin .sibox .signin-items [type="checkbox"] + label
{
    font-size: 0.800em !important;
    padding-left: 42px !important;
}
.signin .sibox .signin-items a
{
    font-size: 0.950em !important;
    font-family: 'Gotham HTF' !important;
    color: #2862f7 !important;
    text-decoration: underline !important;
}

.signin .sibox .txt-create-ac
{

    text-align: center !important;
    font-size: 0.938em !important;
    text-align: center !important;
    color: #4e5e87 !important;
}

.signin .sibox .signup-btn
{
    color: #0d9bff !important;
    background: none !important;
    padding: 0 !important;
    margin: 0 !important;
    border: none !important;
    text-decoration: underline !important;
}
.signin .sibox .signbtn
{
    padding: 12px 20px !important;
    margin-top: 15px !important;
    margin-bottom: 15px !important;
    width: 100%;
    background: #feb63d;
    padding: 18px 20px;
    text-align: center;
    border: 0;
    color: #fff;
    margin-top: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
    -webkit-box-shadow: -1px 3px 39px -12px rgba(0, 0, 0, 0.81);
    -moz-box-shadow: -1px 3px 39px -12px rgba(0, 0, 0, 0.81);
    box-shadow: -1px 3px 39px -12px rgba(0, 0, 0, 0.81);
}

</style>
