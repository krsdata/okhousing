
  <!--sign in-->
      <div class="modal fade forgotpass-box loginModal-box " tabindex="-1" role="dialog" aria-labelledby="loginModal-box" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                    <form action="{{URL('/forgotpass')}}" autocomplete="off" name="forgotpass" id="forgotpass" >
      
                    <div class="signin-box">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <h3>Forgot Password</h3>
                        <div id="loginerror-fp"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                    <input id="forgotemail" name="forgotemail" type="text" class="validate">
                                    <label for="username">Email</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <button class="loginModalBtn signbtn">Forgot password</button>
                            <p class="txt-create-ac">Create an account <a class="signup-btn" data-toggle="modal" data-target=".signup-box" data-dismiss="modal" href="#"  >Sign up</a></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
             
