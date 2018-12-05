
  <!--sign in-->
      <div class="modal fade signin-box" tabindex="-1" role="dialog" aria-labelledby="signin-box">
            <div class="modal-dialog modal-sm signin" role="document">
                <div class="modal-content">
                    <form action="{{URL('/post_login')}}" autocomplete="off" name="login" id="login" >
      
                    <div class="signin-box">
                        <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                        <h3>Sign In</h3>
                        <div id="loginerror"><span class="help-block"></span></div>
                        <div class="form-box">
                            <div id="usernameBox">
                                <div class="input-field">
                                    <input id="email" name="email" type="text" class="validate">
                                    <label for="username">Email</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <div id="passBox">
                                <div class="input-field">
                                    <input id="password" name="password" type="password" class="validate">
                                    <label for="password">Password</label>
                                </div>
                                <span class="help-block"></span> 
                            </div>
                            <ul class="signin-items">
                                <li>
                                    <input type="checkbox" class="filled-in" id="filled-in-box" name="remember_me" value="1" />
                                    <label for="filled-in-box">Remember me</label>
                                </li>
                                <li><a href="#" data-toggle="modal" data-target=".loginModal-box" > Forgot password</a></li>
                            </ul>
                            <button class="signbtn">Sign in</button>
                            <p class="txt-create-ac">Create an account <button class="signup-btn">Sign up</button></p>
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

