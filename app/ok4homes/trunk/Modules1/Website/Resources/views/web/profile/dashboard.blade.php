@extends('website::web.common-master')
@section('title', "Ok4homes | Dashboard")

@section('content')
<section class="dashbord">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="left-box">
                        <div class="profile">
                            <div class="cover">
                                <div class="img-box"><img src="{{asset('public/web/images/cover.jpg')}}" alt=""></div>
                                <button><i class="far fa-edit"></i> Edit Cover page</button>
                                <div class="dp-box"><img src="{{asset('public/images/user_pics')}}/{{$user->image}}" alt=""></div>
                            </div>
                             @if(Session::has('val')) 
                                @if(Session::get('val')==1)
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 14px;">×</button>
                                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                                        {{Session::get('msg')}}
                                    </div>
                                @endif
                            @endif
                            <div class="profile-details">
                            <?php 
                                if(Auth::guard('front_user')->user()) {$id=Auth::guard('front_user')->user()->id;}else{$id='';}
                            ?>
                                <a href="{{ URL::to('users/profile/edit')}}/{{$id}}" class="profile-edit"><i class="far fa-edit"></i>Edit</a>
                                <h2>{{$user->name}}</h2>
                                <span class="user-id">U.ID - {{$user->unique_code}}</span>
                                <span class="user-designation">Owner</span>
                                <ul class="profile-contact">
                                    <li><span>Email</span><span>:</span><span>{{$user->email}}</span></li>
                                    <li><span>Phone</span><span>:</span><span>+91 {{$user->mobile}}</span></li>
                                </ul>
                                <h3>About me</h3>
                                <p>{{$user->about_me}}</p>
                                <a type="button" href="{{ URL::to('/property/post')}}" class="btn-box btn">Add Property</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="right-box">
                        <div class="profile-tab-box featured_properties">
                            <ul class="tab-head" role="tablist">
                                <li role="presentation"><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab">Properties </a></li>
                                <li role="presentation" class="active"><a href="#favorites" aria-controls="favorites" role="tab" data-toggle="tab">Favorites </a></li>
                                <li role="presentation"><a href="#advertisement" aria-controls="advertisement" role="tab" data-toggle="tab">Advertisement</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="favorites">
                                @if($user->created_properties)
                                @foreach($user->created_properties as $property)
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>
                                                <?php $PropertyImage= Modules\Properties\Entities\PropertyImages::where('property_id',$property->id)->first();
                                                    if($PropertyImage){
                                                ?>
                                                <img src="{{asset('public/images/properties/')}}/{{$PropertyImage->image}}" alt="" class="img-responsive">
                                                <?php }else{ ?>
                                                <img src="{{asset('public/images/defaultimage.gif')}}" alt="" class="img-responsive">
                                                <?php } ?>
                                                <div class="property_deatil">
                                                    <h4>{{$property->name}}</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span>{{$property->prize}}/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>{{$property->bedroom}}</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>{{$property->bathroom}}</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>{{$property->building_area}}Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <div role="tabpanel" class="tab-pane" id="properties">
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="advertisement">
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 property_container">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="images/image-1.jpg" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Lovelace Road Greenfield</h4>
                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5><span>₹</span> 12.000/- <small>Per Month</small></h5>

                                                <div class="quick_detail_list">
                                                    <ul>
                                                        <li><span class="icon"><img src="images/icon-bed.png" alt="" class="img-responsive"></span>4</li>
                                                        <li><span class="icon"><img src="images/icon-bath.png" alt="" class="img-responsive"></span>5</li>
                                                        <li><span class="icon"><img src="images/icon-area.png" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>

    @stop
