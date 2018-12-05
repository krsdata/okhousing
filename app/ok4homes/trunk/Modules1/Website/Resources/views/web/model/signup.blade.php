 @php
$fcountry=Session::get('fcountry');
@endphp
 
  <!--sign up-->
         <div class="modal fade signup-box" tabindex="-1" role="dialog" aria-labelledby="signup-box">
        <div class="modal-dialog modal-sm signup" role="document">
            <div class="modal-content">
                <form action="javascript:void(0);" id="registration_users">
                <div class="signup-box">
                    <div class="close-popup" data-dismiss="modal"><img src="{{asset('public/web/images/close.svg')}}" alt=""></div>
                    <h3>Sign Up</h3>
                    <div class="signupmain responsiveTabs">
                        <div class="left-box">
                            <ul id="myTab">
                                <!--fas fa-check-->
                                <li class="active"><a href="#gi" data-toggle="tab">General information <i id="check_1"></i></a></li>
                                <li><a href="#categorys" data-toggle="tab">Categorys <i id="check_2"></i></a></li>
                                <li><a href="#profile" data-toggle="tab">Profile information <i id="check_3"></i></a></li>
                                <li><a href="#verification" data-toggle="tab">Verification <i id="check_4"></i></a></li>
                            </ul>
                        </div>
                        <div class="right-box">
                            <div id="myTabContent" class="tab-content">   
                                <!--General information-->
                                <div class="tab-pane gi active" id="gi">
                                    <ul class="form-list">
                                        <!--Name-->
                                      <!--   <li>
                                            <div class="input-field GnameBox">
                                                <input id="Gname" name="Gname" type="text" class="validate" >
                                                <label for="Gname">Name</label>
                                                <div class="val-error"></div>
                                            </div>
                                        </li> -->
                                        <div class="namesection"></div>
                                        <!--/Name--> 
                                        <!--Email-->
                                        <li>
                                            <div class="input-field emailBox">
                                                <input   type="text" class="validate" id="Gemail" name="Gemail"> 
                                                <label for="Gemail">Email</label>
                                                <div class="val-error"></div> 
                                            </div>
                                        </li>
                                        <!--/Email--> 
                                         <!--mobile-->
                                         <li class="numberBox">
                                            <div class="input-field number" >

                                                <input  type="tel"  name="Gcode" id="Gcode" class="validate" placeholder="Mobile">
                                                <input  type="hidden"  name="hidcode" id="hidcode" value="{{$fcountry['flag']}}">
                                               
                                            </div>
                                            <div class="val-error" ></div>
                                            <!--  <div class="input-field number">
                                                <div class="left">
                                                    <input  type="text" class="validate" name="Gcode" id="Gcode" value="{{$fcountry['callingCodes']}}" readonly="true" disabled="true" style="    width: 30px;margin-right: 8px;">
                                                </div>
                                                <div class="right">
                                                    <input type="text" class="validate" id="Gmobile" name="Gmobile"/>
                                                </div>
                                                 <div class="val-error" style="margin-top: 5px !important"></div>
                                            </div> -->
                                            
                                        </li>
                                        <!--/mobile-->
                                        <!--password-->
                                        <li>
                                            <div class="input-field passwordBox">
                                                <input id="Gpassword" name="Gpassword" type="password" class="validate">
                                                <label for="Gpassword">Password</label>
                                                <div class="val-error"></div>
                                            </div>
                                        </li>
                                        <!--/password--> 
                                        <!--Confirm Password-->
                                        <li>
                                            <div class="input-field confirmBox">
                                                <input id="Gpasswordconfirm" name="Gpasswordconfirm" type="password" class="validate">
                                            <label for="Gpasswordconfirm">Confirm Password</label>
                                            <div class="val-error"></div>
                                            </div>
                                        </li>
                                        <!--/Confirm Password-->
                                        
                                    </ul>
                                    <div class="val-error" id="gi-err" style="margin-left: 15px;"></div>
                                    <button class="signup-btn Rnext1" >Next</button>
                                    <p class="txt-create-ac">Already have an account? <button class="signin-btn-2">Sign In</button></p>
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
                                
                                
<!--                                <div class="tab-pane" id="verification">
                                    <div class="verification">
                                        <p>Please type the verification code <br> sent to (+1) 182-1523</p>
                                        <div class="input-box">
                                            <input type="text">
                                            <input type="text">
                                            <input type="text">
                                            <input type="text">
                                            <button>Resend</button>
                                        </div>
                                    </div>
                                    <button class="signup-btn">Next</button>
                                </div>-->
                                
                                
                                
                                
                            </div>
                        </div>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>
               
<!--/sign up-->

