
  <!--sign in-->
      <div class="modal fade forgotpass-box loginModal-box" tabindex="-1" role="dialog" aria-labelledby="loginModal-box">
            <div class="modal-dialog modal-sm loginModal" role="document">
                <div class="modal-content">
                    <form action="{{URL('/forgotpass')}}" autocomplete="off" name="forgotpass" id="forgotpass" >
      
                    <div class="loginModal-box">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <h3>Forgot Password</h3>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                    <input id="email" name="forgotemail" type="text" class="validate">
                                    <label for="username">Email</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <button class="loginModalBtn ">Forgot password</button>
                            <p class="txt-create-ac">Create an account <a class="signup-btn" data-toggle="modal" data-target=".signup-box" href="#" >Sign up</a></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
             
<!--/sign in-->
@section('js')
<script src="{{asset('public/site/js/front_users.js')}}"></script>
@stop


<style >
.loginModal {
    width: 498px;
    border-radius: 10px;
}    
.loginModal .loginModal-box {
    padding: 60px;
    position: relative;
}
.loginModal .loginModal-box .close-popup img{
    position: absolute;
    right: 60px;
    top: 60px;
    width: 15px;
    height: 15px;
    cursor: pointer;
    z-index: 99;
}
.loginModal .loginModal-box h3 {
    text-align: left;
    margin-bottom: 50px;
    padding-top: 0px;
    text-transform: uppercase;
}
.loginModal .loginModal-box input {
    width: 95.6%;
    padding: 15px 20px 15px 0;
    color: #4e5e87;
    margin: 0 0 30px 0;
    border-bottom: 1px solid #eeecec;
    font-family: 'Gotham HTF';
}
.loginModal .loginModal-box .loginModalBtn {
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
.loginModal .loginModal-box .txt-create-ac {
    text-align: center;
    font-size: 0.938em;
    text-align: center;
    color: #4e5e87;
}
.loginModal .loginModal-box .signup-btn {
    color: #0d9bff;
    background: none;
    padding: 0;
    margin: 0;
    border: none;
    text-decoration: underline;
}
</style>
