@extends('website::web.common-master')
@section('title', "Ok4homes | Dashboard")

@section('content')
 <section class="dashbord utilitiDashbord">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5  col-xs-12 xspx0">
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
                <div class="col-sm-7 col-xs-12">
                    <div class="right-box">
                        <div class="profile-tab-box featured_properties">
                            <ul class="tab-head" role="tablist">
                                <li role="presentation" class="active"><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab">Properties </a></li>
                                <li role="presentation"><a href="#utilities" aria-controls="utilities" role="tab" data-toggle="tab">Utilities  </a></li>
                                <li role="presentation"><a href="#homeDesign" aria-controls="homeDesign" role="tab" data-toggle="tab">Home Design </a></li>
                                <li role="presentation" ><a href="#favorites" aria-controls="favorites" role="tab" data-toggle="tab">Favorites </a></li>
                                <li role="presentation"><a href="#advertisement" aria-controls="advertisement" role="tab" data-toggle="tab">Advertisement</a></li>
                            </ul>
                            <button class="btn btnEnquiries"> Enquiries </button>
                            <div class="tab-content">   
                                <div role="tabpanel" class="tab-pane active" id="properties">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane " id="utilities">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane " id="homeDesign">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane " id="favorites">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="advertisement">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 property_container " data-toggle="modal" data-target=".modal1">
                                        <div class="property_wrapper">
                                            <div class="image_wrapper">
                                                <div class="badge rent">653 Views</div>

                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                <div class="property_deatil">
                                                    <h4>Utility name</h4>
                                                    <span class="loaction">Aluminium fabrication</span><br>
                                                    <span class="loaction">Contract Base </span>
                                                </div>
                                                <div class="right-btn">
                                                   <a href="#" class="icon"><i class="far fa-edit"></i></a>
                                                   <button class="icon"><i class="far fa-trash-alt"></i></button>
                                                </div>

                                            </div>
                                            <div class="content_wrapper">
                                                <h5> 12.000/- <small>Per Month</small></h5>
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
<div class="modal fade modal1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg list-detail" role="document">
            <div class="modal-content">
                <div class="list-detail-main">
                    <div class="list-cover">
                        <div class="cover-img">
                            <img src="{{asset('public/images/listing-detail-cover.jpg')}}" alt="">
                        </div>
                        <div class="list-price">
                            <span>{{trans('countries::home/home.rupee')}} 55.3 Lac</span>
                        </div>
                    </div>
                    <div class="list-contant">
                        <div class="box-one">
                            <div class="box-one-contant">
                                <ul class="list-one">
                                    <li>
                                        <h3>Lovelace Road Greenfield</h3>
                                        <span>Kottayam, Ettumanoor Apt. 761</span>
                                        <p class="yellow-txt">U.ID - 3426556871</p>
                                    </li>
                                    <li>
                                        <span class="views">653 Views</span>
                                        <div class="fav-icon"><i class="fas fa-heart"></i></div>
                                    </li>
                                </ul>
                                <ul class="list-two">
                                    <li>Apartment</li>
                                    <li>By Owner</li>
                                </ul>
                                <div class="list-box-line"></div>

                                <ul class="list-three">
                                    <li>
                                        <span><img src="{{asset('public/images/icon-bed.png')}}" alt=""></span> 4
                                    </li>
                                    <li>
                                        <span><img src="{{asset('public/images/icon-area.png')}}" alt=""></span> 5
                                    </li>
                                    <li>
                                        <span><img src="{{asset('public/images/icon-bath.png')}}" alt=""></span> 2100Sq Ft
                                    </li>
                                    <li>
                                        <span>Plot area</span>
                                    </li>
                                    <li>
                                        <span>10Cents</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box-two">
                            <h5>Description</h5>
                            <p>Mid-century modern is an architectural, interior, product and graphic design that describes mid-20th century developments in modern design, architecture and urban development from roughly 1933 to 1965. The term, employed as a style descriptor as early as the mid-1950s, was reaffirmed in 1983 by Cara Greenberg in the title of her book, Mid-Century Modern: Furniture of the 1950s (Random House), celebrating the style that is now recognized by scholars and museums worldwide as a significant design movement.</p>
                        </div>
                        <div class="box-three">
                            <h5>Amenities</h5>
                            <div class="amenities">
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item inactive">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>
                                <div class="amenities-item inactive">
                                    <div class="img-box"><img src="{{asset('public/images/tap.png')}}" alt=""></div>
                                    <div class="contant-box">
                                        <p>24/7 Water</p>
                                        <p>Supply</p>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="box-four">
                            <div class="locate-box">
                                <div class="popup-tab">
                                    <h5>Map</h5>

                                    <div class="popup-tab">
                                        <ul class="nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#menu0">Hospital</a></li>
                                            <li><a data-toggle="tab" href="#menu1">School</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Bus Stop</a></li>
                                            <li><a data-toggle="tab" href="#menu1">ATM's</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Banks</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Super Market</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Religious</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="menu0" class="tab-pane fade in active">
                                                <div class="mapbox">
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15715.598825289855!2d76.34635115!3d10.025134699999999!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1522168052641" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <div id="menu1" class="tab-pane fade in">
                                                <div class="mapbox">
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15715.598825289855!2d76.34635115!3d10.025134699999999!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1522168052641" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="socialbox">
                                <div class="col-sm-5 co-xs-12">
                                    <p>Liked this property? Share with people </p>
                                </div>
                                <div class="col-sm-7 co-xs-12">
                                    <ul>
                                        <li><a href="#"><img src="{{asset('public/images/fb.png')}}" alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('public/images/twtter.png')}}" alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('public/images/g-plus.png')}}" alt=""></a></li>
                                        <li><a href="#"><img src="{{asset('public/images/youtube.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="box-five">
                            <div class="grid-list-box">
                                <div class="right-box">
                                    <h5>Similar properties</h5>
                                    <div class="profile-tab-box featured_properties">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active row popup-slide-1" id="favorites">
                                                <div class="item">
                                                    <div class="col-xs-12 property_container" data-toggle="modal" data-target=".modal1">
                                                        <div class="property_wrapper">
                                                            <div class="image_wrapper">
                                                                <div class="badge rent">653 Views</div>
                                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                                <div class="property_deatil">
                                                                    <h4>Lovelace Road Greenfield</h4>
                                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                                </div>
                                                            </div>
                                                            <div class="content_wrapper">
                                                                <h5><span>{{trans('countries::home/home.rupee')}}</span> 12.000/- <small>Per Month</small></h5>

                                                                <div class="quick_detail_list">
                                                                    <ul>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="col-xs-12 property_container" data-toggle="modal" data-target=".modal1">
                                                        <div class="property_wrapper">
                                                            <div class="image_wrapper">
                                                                <div class="badge rent">653 Views</div>
                                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                                <div class="property_deatil">
                                                                    <h4>Lovelace Road Greenfield</h4>
                                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                                </div>
                                                            </div>
                                                            <div class="content_wrapper">
                                                                <h5><span>{{trans('countries::home/home.rupee')}}</span> 12.000/- <small>Per Month</small></h5>

                                                                <div class="quick_detail_list">
                                                                    <ul>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="col-xs-12 property_container" data-toggle="modal" data-target=".modal1">
                                                        <div class="property_wrapper">
                                                            <div class="image_wrapper">
                                                                <div class="badge rent">653 Views</div>
                                                                <img src="{{asset('public/images/image-1.jpg')}}" alt="" class="img-responsive">
                                                                <div class="property_deatil">
                                                                    <h4>Lovelace Road Greenfield</h4>
                                                                    <span class="loaction">Kottayam, Ettumanoor Apt. 761</span>
                                                                </div>
                                                            </div>
                                                            <div class="content_wrapper">
                                                                <h5><span>{{trans('countries::home/home.rupee')}}</span> 12.000/- <small>Per Month</small></h5>

                                                                <div class="quick_detail_list">
                                                                    <ul>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bed.png')}}" alt="" class="img-responsive"></span>4</li>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-bath.png')}}" alt="" class="img-responsive"></span>5</li>
                                                                        <li><span class="icon"><img src="{{asset('public/images/icon-area.png')}}" alt="" class="img-responsive"></span>2100Sq Ft</li>
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
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="list-form-box">
                            <div class="form-box-main">
                                <div class="input-field">
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Name</label>
                                </div>
                                <div class="input-field">
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Email</label>
                                </div>
                                <div class="input-field">
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Mobile</label>
                                </div>
                                <div class="input-field">
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Subject</label>
                                </div>
                                <div class="input-field">
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Message</label>
                                </div>
                                <button class="btn-box">Enquire now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
