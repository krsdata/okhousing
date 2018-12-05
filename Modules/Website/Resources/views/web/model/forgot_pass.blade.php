
  <!--sign in-->
      <div class="modal fade forgotpass-box loginModal-box " tabindex="-1" role="dialog" aria-labelledby="loginModal-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                    <form action="{{URL('/forgotpass')}}" autocomplete="off" name="forgotpass" id="forgotpass" >
      
                    <div class="sibox">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <h3>{{trans('countries::home/home.forgot_pass')}}</h3>
                        <div id="loginerror-fp"><span class="help-block"></span></div>
                        <div id="loginerror-fp_pass"><span class="help-block"></span></div>

                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                    <input id="forgotemail" name="forgotemail" type="text" class="validate">
                                    <label for="username">{{trans('countries::home/home.email')}}</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <button class="loginModalBtn signbtn">{{trans('countries::home/home.forgot_pass')}}</button>
                            <p class="txt-create-ac">{{trans('countries::home/home.create_accnt')}} <a class="signup-btn" data-toggle="modal" data-target=".signup-box" data-dismiss="modal" href="#"  >{{trans('countries::home/home.sign_up')}}</a></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
             
<style type="text/css">
    div#loginerror-fp_pass span {
    color: green !important;
}

</style>
