
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
                            <input id="adv_name"  name="adv_name" type="text" class="validate">
                            <label for="username">{{trans('countries::home/home.name')}}</label>
                            <span class="help-block"></span> 
                        </div>
                        <div class="input-field col-sm-6 " id="phonenobox">
                            <input id="adv_phoneno" name="adv_phoneno" type="text" class="validate">
                            <label for="phoneNo">{{trans('countries::home/home.phone_no')}}</label>
                            <span class="help-block"></span> 
                        </div>

                        <div class="input-field col-sm-12" id="usernameBox" >
                            <input id="adv_email" name="adv_email" type="text" class="validate">
                            <label for="email">{{trans('countries::home/home.ad_email')}}</label>
                            <span class="help-block"></span> 
                        </div>
                        
                        <div class="input-field col-sm-12 " id="messagebox" >
                            <textarea id="adv_message" name="adv_message" type="text" rows="3" class="validate"></textarea>
                            <label for="message">{{trans('countries::home/home.ad_msg')}}</label>
                            <span class="help-block"></span> 
                        </div>

                        <button class="advertiseBtn">{{trans('countries::home/home.submit_button')}}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

       <script type="text/javascript">
             $('.advertise-box .close-popup ').unbind('click').click(function () {
                $("#adverise_form")[0].reset();
                 $(".val-error").html('');
            });

        </script>       
<style type="text/css">
    .advertisedModal  .has-error.has-success > span.help-block {
    margin-bottom: 25px;
    font-size: 16px;
    font-weight: 600;
}
</style>
