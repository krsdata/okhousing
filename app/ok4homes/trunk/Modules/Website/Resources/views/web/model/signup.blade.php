 @php
$fcountry=Session::get('fcountry');
$flag = $fcountry['flag'];

@endphp
 
  <!--sign up-->
         <div class="modal fade signup-box" tabindex="-1" role="dialog" aria-labelledby="signup-box" data-keyboard="false" data-backdrop="static">
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
                                      
                                        <div class="namesection">

                                            <li>
                                                                   
                                                    <div class="input-field GnameBox">
                                                        <input id="Gname" name="Gname" type="text" class="validate">
                                                        <label for="Gname">Name in English</label>
                                                        <div class="val-error"></div>
                                                    </div>
                                                                                        
                                                                          
                                                   
                                                          
                                            </li>

                                            </div>
                                        <!--/Name--> 
                                        <!--Email-->
                                        <li>
                                            <div class="input-field emailBox">
                                                <input type="text" class="validate" id="Gemail" name="Gemail"> 
                                                <label for="Gemail">Email</label>
                                                <div class="val-error"></div> 
                                            </div>
                                        </li>
                                        <!--/Email--> 
                                         <!--mobile-->
                                         <li class="numberBox">
                                            <div class="input-field number">

                                                <div class="intl-tel-input"><div class="flag-container"><div class="selected-flag" title="India (भारत): +91"><div class="iti-flag in"></div></div></div><input type="tel" name="Gcode" id="Gcode" class="validate" placeholder="Mobile" autocomplete="off"></div>
                                                <input type="hidden" name="hidcode" id="hidcode" value="{{$flag}}">
                                               
                                            </div>
                                            <div class="val-error"></div>
                                           
                                            
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
                                    <button class="signup-btn Rnext1">Next</button>
                                    <p class="txt-create-ac">Already have an account? <a href="#" class="signin-btn-2" data-toggle="modal" data-target=".signin-box" data-dismiss="modal">Sign In</a></p>
                                </div>
                                <!--/General information-->
                                
                                <!--User Category-->
                                <div class="disabled" id="categorys"></div>
                                <!--/User Category-->
                                
                                <!--User profile-->
                                <div class="disabled" id="profile"></div>
                                <!--User profile-->
                                <!--Verification-->
                                <div class="disabled" id="verification"></div>
                                <!--Verification-->
                  
                                
                                
                                
                            </div>
                        </div>
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
<!--/sign up-->

