@php
$fcountry_lang=Session::get('fcountry_lang');
@endphp

<!--featured properties-->
<section class="featured_properties">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 heading_wrapper">
                <h3>{{trans('countries::home/home.featured_properties')}}</h3>
            </div>
        </div>
    </div>

    <div class="container slider_controls desktop">
        <a class="prev"><img src="{{asset('public/web/images/left.png')}}" alt=""></a>
        <a class="next"><img src="{{asset('public/web/images/right.png')}}" alt=""></a>
    </div>

    <div class="tab-control">
        
    <div class="tab-button-main container">
        <ul class="nav nav-tabs tab-title-slide">
            <li class="active"><a data-toggle="tab" href="#featured-1">Individual Houses/ villa</a></li>
            <li><a data-toggle="tab" href="#featured-1">Apartments</a></li>
            <li><a data-toggle="tab" href="#featured-1">Commercial Spaces</a></li>
            <li><a data-toggle="tab" href="#featured-1">Office Spaces</a></li>
            <li><a data-toggle="tab" href="#featured-1">sOffice Spaces</a></li>
            <li><a data-toggle="tab" href="#featured-1">fOffice Spaces</a></li>
            <li><a data-toggle="tab" href="#featured-1">gOffice Spaces</a></li>
            <li><a data-toggle="tab" href="#featured-1">hOffice Spaces</a></li>
        </ul>
        <div class="slider_controls-2 desktop">
            <a class="prev-tab-title"><img src="{{asset('public/web/images/tab-left.svg')}}" alt=""></a>
            <a class="next-tab-title"><img src="{{asset('public/web/images/tab-right.svg')}}" alt=""></a>
        </div>
    </div>
        
    <div class="tab-content desktop">

        <div id="featured-1" class="tab-pane fade in active">
            <div class="featured_slider">
                <div class="featured_slider_item">
                    <div class="container featured_container">
                        <div class="row">
                            
                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                <div class="image_wrapper">
                                    <div class="badge sale">Sale</div> 
                                    <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                    <div class="property_deatil">
                                        <span class="category">Apartment</span>
                                        <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                        <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                    </div> 
                                </div>
                                    
                                <div class="content_wrapper">
                                    <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                    <div class="quick_detail_list">
                                        <ul>
                                            <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                            <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                            <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="featured_slider_item">
                    <div class="container featured_container">
                        <div class="row">
                            
                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                <div class="image_wrapper">
                                    <div class="badge sale">Sale</div> 
                                    <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                    <div class="property_deatil">
                                        <span class="category">Apartment</span>
                                        <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                        <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                    </div> 
                                </div>
                                    
                                <div class="content_wrapper">
                                    <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                    <div class="quick_detail_list">
                                        <ul>
                                            <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                            <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                            <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                <div class="property_wrapper">
                                    
                                    <div class="image_wrapper">
                                        <div class="badge rent">RENT</div>
                                        <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                                        <div class="property_deatil">
                                            <span class="category">Apartment</span>
                                            <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                                            <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                        </div> 
                                    </div>
                                    
                                    <div class="content_wrapper">
                                        <h5><span>₹</span> 12.000/- <small>Per Month</small></h5> 
                                        <div class="quick_detail_list">
                                            <ul>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="featured_slider_item">
                <div class="container featured_container">
                <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                <div class="property_wrapper">
                <div class="image_wrapper">
                <div class="badge rent">RENT</div>

                <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                <div class="property_deatil">
                <span class="category">Apartment</span>
                <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                </div>

                </div>
                <div class="content_wrapper">
                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                <div class="quick_detail_list">
                <ul>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                </ul>
                </div>
                </div>
                </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                <div class="property_wrapper">
                <div class="image_wrapper">
                <div class="badge rent">RENT</div>

                <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                <div class="property_deatil">
                <span class="category">Apartment</span>
                <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                </div>

                </div>
                <div class="content_wrapper">
                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                <div class="quick_detail_list">
                <ul>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                </ul>
                </div>
                </div>
                </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                <div class="property_wrapper">
                <div class="image_wrapper">
                <div class="badge rent">RENT</div>

                <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                <div class="property_deatil">
                <span class="category">Apartment</span>
                <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                </div>

                </div>
                <div class="content_wrapper">
                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                <div class="quick_detail_list">
                <ul>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                </ul>
                </div>
                </div>
                </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                <div class="property_wrapper">
                <div class="image_wrapper">
                <div class="badge rent">RENT</div>

                <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                <div class="property_deatil">
                <span class="category">Apartment</span>
                <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                </div>

                </div>
                <div class="content_wrapper">
                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                <div class="quick_detail_list">
                <ul>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                </ul>
                </div>
                </div>
                </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                <div class="property_wrapper">
                <div class="image_wrapper">
                <div class="badge rent">RENT</div>

                <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                <div class="property_deatil">
                <span class="category">Apartment</span>
                <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                </div>

                </div>
                <div class="content_wrapper">
                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                <div class="quick_detail_list">
                <ul>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                </ul>
                </div>
                </div>
                </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                <div class="property_wrapper">
                <div class="image_wrapper">
                <div class="badge rent">RENT</div>

                <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
                <div class="property_deatil">
                <span class="category">Apartment</span>
                <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
                <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                </div>

                </div>
                <div class="content_wrapper">
                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                <div class="quick_detail_list">
                <ul>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                </ul>
                </div>
                </div>
                </div>
                </div>

                </div>
                </div>
                </div>
            </div>
        </div>

    </div>
        
    <div class="tab-content mobile">

    <div id="home" class="tab-pane fade in active featured_slider2">

    <div class="featured_slider_item">
    <div class="container featured_container">
    <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
    <div class="property_wrapper">
    <div class="image_wrapper">
    <div class="badge rent">RENT</div>

    <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
    <div class="property_deatil">
    <span class="category">Apartment</span>
    <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
    </div>

    </div>
    <div class="content_wrapper">
    <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

    <div class="quick_detail_list">
    <ul>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
    </ul>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="featured_slider_item">
    <div class="container featured_container">
    <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
    <div class="property_wrapper">
    <div class="image_wrapper">
    <div class="badge rent">RENT</div>

    <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
    <div class="property_deatil">
    <span class="category">Apartment</span>
    <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
    </div>

    </div>
    <div class="content_wrapper">
    <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

    <div class="quick_detail_list">
    <ul>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
    </ul>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="featured_slider_item">
    <div class="container featured_container">
    <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
    <div class="property_wrapper">
    <div class="image_wrapper">
    <div class="badge rent">RENT</div>

    <img src="{{asset('public/web/images/image-1.jpg')}}" alt="" class="img-responsive">
    <div class="property_deatil">
    <span class="category">Apartment</span>
    <h4>Lovelace Road Greenfield <span class="posted_by">Builder</span></h4>
    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
    </div>

    </div>
    <div class="content_wrapper">
    <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

    <div class="quick_detail_list">
    <ul>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
    <li><span class="icon"><img src="{{asset('public/web/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
    </ul>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>

    </div>
        
        <div class="btn-box">
        <a href="#" class="explore">{{trans('countries::home/home.explore_more')}}</a>
        </div>
    </div>  
   
</section>
<!--/featured properties-->
