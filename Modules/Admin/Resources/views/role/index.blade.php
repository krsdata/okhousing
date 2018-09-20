@extends('admin::admin.master')
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li class="active"><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Dashboard</a></li>
           
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4> <span class="text-semibold">Dashboard</span> <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

        
    </div>
@stop
@section('content') 

            <div class="panel panel-white"> 
                <div class="panel panel-flat">
                  <div class="panel-heading">
                    <h6 class="panel-title"><b> {{$heading }} List</b><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                      <ul class="icons-list">
                        <li> <a type="button" href="{{route('role.create')}}" class="btn btn-primary text-white btn-labeled btn-rounded "><b><i class="icon-plus3"></i></b> Add Role<span class="legitRipple-ripple" ></span></a></li> 
                      </ul>
                    </div>
                  </div> 
              </div>  
            
              <div class="panel-body">
                  <table class="table datatable-basic table-bordered table-hover" id="roles_list">
                      <thead>
                          <tr>
                              <th>#Sno</th>
                              <th>Name</th> 
                              <th>Role Type</th> 
                              <th>Created at</th> 
                              <th class="text-center">Actions</th>
                          </tr>
                      </thead>
                          <tbody>
                                          @foreach($role as $key => $result)
                                              <tr>
                                               <th> {{++$key}} </th> 
                                               <td> {{$result->name }} </td>
                                                <td> 
                                                  {{ $role_type[$result->type] }}
                                                 </td>
                                                       <td>
                                                          {!! Carbon\Carbon::parse($result->created_at)->format('Y-m-d'); !!}
                                                      </td>
                                                      
                                                      <td> 
                                                          <a href="{{ route('role.edit',$result->id)}}" class="btn btn-primary btn-xs" style="margin-left: 20px">
                                                              <i class="fa fa-edit" title="edit"></i> Edit
                                                          </a>

                                                          {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('role.destroy', $result->id))) !!}

                                                          <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="fa fa-trash" title="Delete"></i> Delete
                                                          </button>
                                                          
                                                           {!! Form::close() !!}

                                                      </td>
                                                 
                                              </tr>
                                             @endforeach
                                              
                                          </tbody>
                  </table> 
              </div> 
           </div>
       </div> 
   @stop