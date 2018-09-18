 <section class="middleBlock Wraper500">
        <div class="container">
            <div class="changePasswordWrap">

                <div class="form-box ">
                    <div class="title">
                        <h3>Reset password</h3>
                    </div>
                    <form action="{{URL('/forgotpass')}}" autocomplete="off" name="ResetPassword" id="ResetPassword" >
                    <div id="loginerror-fp"><span class="help-block"></span></div>
                     <div id="success-up"><span class="success-msg"></span></div>
                    <div class="input-field passwordBox ">
                        <input id="Rpassword" type="password" class="validate" name="Rpassword">
                        <label for="Rpassword" class="">Password</label>
                        <div class="val-error"></div>
                    </div>
                    <div class="input-field confirmBox">
                        <input id="Rconfirmpassword" type="password" class="validate" name="Rconfirmpassword" >
                        <label for="Rconfirmpassword" class="">Confirm Password</label>
                        <div class="val-error"></div>
                    </div>
                     <input type="hidden" value="{{$token}}" name="token">
                    <button class="btn btnChangePassword" id="btnChangePassword">Change password</button> 
                    </form>                  
                </div>
            </div>
        </div>
    </section>
<style type="text/css">
    div#success-up {
    margin-bottom: 15px;
}
</style>
