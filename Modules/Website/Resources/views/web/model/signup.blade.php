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
                    <h3>{{trans('countries::home/home.sign_up')}}</h3>
                    <div class="signupmain responsiveTabs">
                        <div class="left-box">
                            <ul id="myTab">
                                <!--fas fa-check-->
                                <li class="active"><a href="#gi" data-toggle="tab">{{trans('countries::home/home.general_info')}} <i id="check_1"></i></a></li>
                                <li><a href="#categorys" data-toggle="tab">{{trans('countries::home/home.category_tab')}} <i id="check_2"></i></a></li>
                                <li><a href="#profile" data-toggle="tab">{{trans('countries::home/home.profile_info')}} <i id="check_3"></i></a></li>
                                <li><a href="#verification" data-toggle="tab">{{trans('countries::home/home.verification')}} <i id="check_4"></i></a></li>
                            </ul>
                        </div>
                        <div class="right-box">
                              <div class="preLoad Noloader preLoadSignup"></div>
                            <div id="myTabContent" class="tab-content">   
                                <!--General information-->
                                <div class="tab-pane gi active" id="gi">
                                    <ul class="form-list">
                                        <!--Name-->
                                      
                                        <div class="namesection thi_name_sec">

                                            <li>
                                                                   
                                                    <div class="input-field GnameBox">
                                                        <input id="Gname" name="Gname" type="text" class="validate">
                                                        <label for="Gname">{{trans('countries::home/home.name_in_eng')}} English</label>
                                                        <div class="val-error"></div>
                                                    </div>
                                                                                        
                                                                          
                                                   
                                                          
                                            </li>

                                            </div>
                                        <!--/Name--> 
                                        <!--Email-->
                                        <li>
                                            <div class="input-field emailBox">
                                                <input type="text" class="validate" id="Gemail" name="Gemail"> 
                                                <label for="Gemail">{{trans('countries::home/home.email')}}</label>
                                                <div class="val-error"></div> 
                                            </div>
                                        </li>
                                        <!--/Email--> 
                                         <!--mobile-->
                                         <li class="numberBox" id="mobileBox">
                                            <div class="input-field number">

                                                <div class="intl-tel-input"><div class="flag-container"><div class="selected-flag" title="India (भारत): +91"><div class="iti-flag in"></div></div></div><input type="tel" name="Gcode" id="Gcode" class="validate" placeholder="{{trans('countries::home/home.mobile')}}" autocomplete="off"></div>
                                                <input type="hidden" name="hidcode" id="hidcode" value="{{$flag}}">
                                               
                                            </div>
                                            <div class="val-error"></div>
                                           
                                            
                                        </li>
                                        <!--/mobile-->
                                        <!--password-->
                                        <li>
                                            <div class="input-field passwordBox">
                                                <input id="Gpassword" name="Gpassword" type="password" class="validate">
                                                <label for="Gpassword">{{trans('countries::home/home.password')}}</label>
                                                <div class="val-error"></div>
                                            </div>
                                        </li>
                                        <!--/password--> 
                                        <!--Confirm Password-->
                                        <li>
                                            <div class="input-field confirmBox">
                                                <input id="Gpasswordconfirm" name="Gpasswordconfirm" type="password" class="validate">
                                            <label for="Gpasswordconfirm">{{trans('countries::home/home.confirm_password')}}</label>
                                            <div class="val-error"></div>
                                            </div>
                                        </li>
                                        <!--/Confirm Password-->
                                        
                                    </ul>
                                    <div class="val-error" id="gi-err" style="margin-left: 15px;"></div>
                                    <button class="signup-btn Rnext1">{{trans('countries::home/home.next_button')}}</button>
                                    <p class="txt-create-ac">{{trans('countries::home/home.already_account')}}? <a href="#" class="signin-btn-2" data-toggle="modal" data-target=".signin-box" data-dismiss="modal">{{trans('countries::home/home.sign_in')}}</a></p>
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
<style type="text/css">
    
    .signup-box .signup .form-list input{    
        margin: 0px 0 20px 0 !important;
        }
        .signup-box .signup .form-list .val-error
        {
           position:relative !important;
            margin-top: -16px !important;
            margin-bottom: 20px !important;
        }
        #registration_users .signupmain .namesection .GnameBox.thi_name#name_116
        {
            width: 48%;
            display: inline-block;
                margin-right: 5px;
        }
        @media (max-width: 767px){
        #registration_users .signupmain .namesection .GnameBox.thi_name#name_116,#registration_users .signupmain .namesection .GnameBox.thi_name#name_1
        {
            width: 100% !important;
        }
        }
        #registration_users .signupmain .namesection.thi_name_sec{
            width: 100%;
        }
        #registration_users .signupmain .namesection .GnameBox.thi_name#name_1
        {
            width: 48%;
            display: inline-block;
        }

</style>
