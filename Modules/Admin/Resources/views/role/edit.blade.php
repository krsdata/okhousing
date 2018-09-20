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
@include('admin::partials.sidebar')  
 <div class="content-wrapper">
      <div class="panel panel-white"> 

 
        <div class="panel panel-flat">
                      <div class="panel-heading">
                    <h6 class="panel-title"><b>Create {{$heading ?? ''}}</b><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                      <ul class="icons-list">
                        <li> <a type="button" href="{{route('role')}}" class="btn btn-primary text-white   btn-rounded "> View Roles<span class="legitRipple-ripple" ></span></a></li> 
                      </ul>
                    </div>
                  </div> 
            </div>


             {!! Form::model($role, ['method' => 'PATCH', 'route' => ['role.update', $role->id],'class'=>'form-basic ui-formwizard user-form','id'=>'form_sample_3','enctype'=>'multipart/form-data']) !!}
                @include('admin::role.form', compact('role'))

                <table class="table table-striped table-hover table-bordered" id="contact">
                                         
                    <thead>
                              <tr>
                                  <th class="text-center">Permission</th> 
                                   @foreach($role_type as $role )
                                   <th colspan="3" class="text-center">{{$role }} </th>
                                    @endforeach
                                
                              </tr>
                               <tr>
                                  <th class="text-center">Permission</th> 
                                   @foreach($role_type as $role )
                                   <th class="text-center"> Read</th>
                                    <th class="text-center"> Write</th>
                                     <th class="text-center"> Delete</th>
                                    @endforeach
                                
                              </tr> 
                             
                          </thead>
                          </tbody>
                         </tr>
                           @foreach($controllers as $route )
                               <tr>
                                   <td>{{$route}}</td>
                                @foreach($role_type as $role )
                                <?php
                                $canRead = isset($permissions->$route->$role->read)?true:false;
                                $canWrite = isset($permissions->$route->$role->write)?true:false;
                                $canDelete = isset($permissions->$route->$role->delete)?true:false;
                                ?>
                                 <td class="text-center"> 
                                     <input type="checkbox" name="permission[{{$route}}][{{$role}}][read]" value="1"   @if($canRead)  checked="checked" @endif >
                                 </td>  
                                 <td class="text-center"> <input type="checkbox" name="permission[{{$route}}][{{$role}}][write]" value="1"  @if($canWrite)  checked="checked" @endif>
                                 </td> 
                                 <td class="text-center">  <input type="checkbox" name="permission[{{$route}}][{{$role}}][delete]" value="1"  @if($canDelete)  checked="checked" @endif>
                                 </td>
                                    @endforeach
                             </tr>     
                                @endforeach
                    </tbody>
                </table> 

            {!! Form::close() !!}   
                     
        </div> 
@stop
