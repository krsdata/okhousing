@extends('admin::layouts.master')

    @section('content')

      @include('admin::partials.navigation')

      @include('admin::partials.breadcrumb')

       @include('admin::partials.sidebar') 

            <div class="panel panel-white">
  		          <div class="panel panel-flat">
                  <div class="panel-heading">
                    <h6 class="panel-title"><b> Store {{$heading }}</b><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                      <ul class="icons-list">
                      <li> <a type="button" href="{{route('product.create')}}" class="btn btn-primary text-white btn-labeled btn-rounded "><b><i class="icon-plus3"></i></b> Add Product<span class="legitRipple-ripple" ></span></a></li>
                      </ul>
                    </div>
                  </div>
                  </div>

              <div class="panel-body">
                  <div class="table-toolbar">
                    <div class="row">
                    <form action="{{route('product')}}" method="get" id="filter_data">
                      <div class="col-md-2">
                          <input value="" placeholder="search by product" type="text" name="search" id="search" class="form-control" >
                      </div>
                      <div class="col-md-2">
                          <input type="submit" value="Search" class="btn btn-primary form-control">
                      </div>
                    </form>
                    </div>
                </div>
            </div>


               @if(Session::has('flash_alert_notice'))
                   <div class="alert alert-success alert-dismissable" style="margin:10px">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <i class="icon fa fa-check"></i>
                   {{ Session::get('flash_alert_notice') }}
                   </div>
              @endif

  		        <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="">
                    <thead>
                        <tr>
                          <th><div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" onclick="checkAll(this)" > 
                                        <span></span>
                                    </label>
                                    </div></th>
                            <th> #Sno. </th>
                            <th> Product Title </th>
                            <th> Image </th>
                            <th> Category </th>
                            <th> Stock Price </th> 
                            <th> MRP </th>
                            <th> Discount </th> 
                            <th> Selling Price </th>
                            <th> Status</th>
                            <th> Created date</th>
                            <th> Action</th>
                        </tr>
                         @if(count($products )==0)
                            <tr>
                                <td colspan="12">
                                    <div class="alert alert-danger alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                        <i class="icon fa fa-check"></i>  
                                        {{ 'Record not found. !' }}
                                    </div>
                                </td>
                            </tr>
                            @endif
                    </thead>
                    <tbody>
                    @foreach($products as $key => $result)
                      @if(!$result->photo)
                       <?php $url = '#' ?>
                        @else
                       <?php $url = url($result->photo); ?>
                      @endif
                        <tr>
                          <td>     
                          <input type="checkbox" name="checkAll" id="chk_{{$result->id}}" value="{{$result->id}}" >  
                                    
                           </td>
                            <td> {{++$key}} </td>
                            <td> {{$result->product_title}} </td>
                            <td>
                                <a href="{{ $url??'#' }}" target="_blank" data-popup="lightbox">
                                    <img src="{!! $url  !!}" width="100px" height="50px;">
                                </a>
                            </td>

                            <td>{{$result->category->category_name??null}}</td>
                            <td>{{ money_format("%.2n", (float)$result->store_price)}} INR</td> 
                            <td>{{ money_format("%.2n", (float)$result->price)}} INR</td>
                            <td>{{ money_format("%.2n", (float)$result->discount)}} ({{$result->discount_type}})  </td> 
                            <td>{{ money_format("%.2n", (float)$result->discount_price)}} INR</td>
                            <td>
                                <span class="label label-{{ ($result->status==1)?'success':'warning'}} status" id="{{$result->id}}"  data="{{$result->status}}"  onclick="changeStatus({{$result->id}},'product')" >
                                    {{ ($result->status==1)?'Active':'Inactive'}}
                                </span>
                            </td>
                            <td>
                                    {!! Carbon\Carbon::parse($result->created_at)->format($date_format); !!}
                            </td>
                           <td> 
                             <a href="{{ route('product.edit',$result->id)}}" class="btn btn-primary btn-xs" style="margin: 3px">
                            <i class="icon-pencil7" title="edit"></i>  
                            </a> 

                            {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'style'=>'margin:3px', 'route' => array('product.destroy', $result->id))) !!}

                            <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="icon-trash" title="Delete"></i> 
                            </button> 
                            {!! Form::close() !!} 

                            </td>

                        </tr>
                       @endforeach

                    </tbody>

                </table> 
                <p style="margin: 10px">
                 Showing {{($products->currentpage()-1)*$products->perpage()+1}} to {{$products->currentpage()*$products->perpage()}}
                of  {{$products->total()}} entries  </p>
                </div> 
                </div>

                <div class="col-md-12">  
                   <div class="col-md-5">
                   @if($products->count())
                      <span id="error_msg"></span>
                      <button class="btn btn-danger" onclick="deleteAll('{{url('admin')}}','products')">Delete Selected Item</button>
                   @endif
                 </div>
                 <div class="col-md-6">
                    <div class="center" align="left">  {!! $products->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() !!}</div>
                </div> 

              </div>
              </div>
   @stop
