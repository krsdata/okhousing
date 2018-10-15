<?php $Sections = Modules\Admin\Entities\Sections::where('title','Builders coming soon projects')->first();

if($Sections->status == 1) 
{ ?>

  <!--builders Coming Soon-->
 
    <section class="builders-csp">
        <h3 class="orange-line">Builders Coming Soon Projects</h3>
        <div class="builders-csp-slider">
            <div class="item ">
                <div class="item-contant container">
                    <div class="col-sm-10 col-xs-12 item-main-wrap">
                        <div class="img-box">
                            <div class="image" style="background-image: url({{asset('public/images/business-slide-1.jpg')}});"></div>
                        </div>
                        <div class="contant">
                            <div class="project-details">
                                <div class="left-box">
                                    <span>Apartment</span>
                                    <h4>Be Investment Developer</h4>
                                    <span>Kottayam, Ettumanoor Apt. 761</span>
                                </div>
                                <div class="right-box">
                                    <img src="{{asset('public/web/images/bul-logo-1.png')}}" alt="">
                                </div>
                                <a href="#" class="builders-link"><img src="{{asset('public/web/images/right-blk.png')}}" alt=""></a>
                            </div>
                            <ul class="builders-facility">
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                            </ul>
                            <ul class="price-box">
                                <li>
                                    <h5><span>₹</span> 12.000/- <span>Per Month</span></h5>
                                </li>
                                <li><span>Builder</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item ">
                <div class="item-contant container">
                    <div class="col-sm-10 col-xs-12 item-main-wrap">
                        <div class="img-box">
                            <div class="image" style="background-image: url({{asset('public/images/business-slide-1.jpg')}});"></div>
                        </div>
                        <div class="contant">
                            <div class="project-details">
                                <div class="left-box">
                                    <span>Apartment</span>
                                    <h4>Be Investment Developer</h4>
                                    <span>Kottayam, Ettumanoor Apt. 761</span>
                                </div>
                                 <div class="right-box">
                                    <img src="{{asset('public/web/images/bul-logo-1.png')}}" alt="">
                                </div>
                                <a href="#" class="builders-link"><img src="{{asset('public/web/images/right-blk.png')}}" alt=""></a>
                            </div>
                            <ul class="builders-facility">
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                            </ul>
                            <ul class="price-box">
                                <li>
                                    <h5><span>₹</span> 12.000/- <span>Per Month</span></h5>
                                </li>
                                <li><span>Builder</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item ">
                <div class="item-contant container">
                    <div class="col-sm-10 col-xs-12 item-main-wrap">
                        <div class="img-box">
                            <div class="image" style="background-image: url({{asset('public/images/business-slide-1.jpg')}});"></div>
                        </div>
                        <div class="contant">
                            <div class="project-details">
                                <div class="left-box">
                                    <span>Apartment</span>
                                    <h4>Be Investment Developer</h4>
                                    <span>Kottayam, Ettumanoor Apt. 761</span>
                                </div>
                                 <div class="right-box">
                                    <img src="{{asset('public/web/images/bul-logo-1.png')}}" alt="">
                                </div>
                                <a href="#" class="builders-link"><img src="{{asset('public/web/images/right-blk.png')}}" alt=""></a>
                            </div>
                            <ul class="builders-facility">
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                            </ul>
                            <ul class="price-box">
                                <li>
                                    <h5><span>₹</span> 12.000/- <span>Per Month</span></h5>
                                </li>
                                <li><span>Builder</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <a class="prev-2"><img src="{{asset('public/web/images/left.png')}}" alt=""></a>
        <a class="next-2"><img src="{{asset('public/web/images/right.png')}}" alt=""></a>
        <div class="bg-box"></div>
    </section>
    

  <!--/builders Coming Soon-->
 <?php } ?>
