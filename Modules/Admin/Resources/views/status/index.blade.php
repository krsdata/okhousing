@extends('admin::admin.master')
@section('title', "section management")
@section('css')
 
 @stop
  
 @section('heading')
    @include('admin::partials.breadcrumb')
@stop
@section('content') 
            <div class="panel panel-white"> 
  		          <div class="panel panel-flat">
                  <div class="panel-heading">
                    <h6 class="panel-title"><b> {{$heading }} List</b><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                      <ul class="icons-list">
                        <li> <a type="button" href="{{route('status.create')}}" class="btn btn-primary text-white btn-labeled btn-rounded "><b><i class="icon-plus3"></i></b> Add Project Status<span class="legitRipple-ripple" ></span></a></li> 
                      </ul>
                    </div>
                  </div> 
  		        </div> 
              <div class="panel-body"> 
                  <div class="table-toolbar">
                    <div class="row">
                      <form action="{{route('status')}}" method="get" id="filter_data">
                     
                       
                      <div class="col-md-2">
                          <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="search by status" type="text" name="search" id="search" class="form-control" >
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
                            <th> Sno. </th>
                            <th> Project Status </th> 
                            <th> Created date</th> 
                            <th> Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($status as $key => $result)
                        <tr>
                            <td> {{++$key}} </td>
                            <td> {{ucfirst($result->name)}}  </td> 
                              <td>
                                {!! Carbon\Carbon::parse($result->created_at)->format($date_format); !!}
                          </td>
                                
                      <td> 
                                    
                            <a href="{{ route('status.edit',$result->id)}}" class="btn btn-primary btn-xs" style="margin-left: 20px">
                            <i class="fa fa-edit" title="edit"></i> Edit
                            </a>

                            {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('status.destroy', $result->id))) !!}

                            <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="fa fa-trash" title="Delete"></i> Delete
                            </button>

                            {!! Form::close() !!}

                                </td>
                           
                        </tr>
                       @endforeach
                        
                    </tbody>
                </table>
                 <div class="center" align="center">  {!! $status->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() !!}</div>
                </div>

                </div>
              </div> 
   @stop