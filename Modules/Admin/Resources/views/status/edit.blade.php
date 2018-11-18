@extends('admin::admin.master')
@section('title', $heading. " management")
@section('css')
 
 @stop
  
 @section('heading')
     @include('admin::partials.breadcrumb')
@stop
@section('content') 
  <div class="panel panel-white"> 


    <div class="panel panel-flat">
        <div class="panel-heading">
          <h6 class="panel-title"><b>  {{$page_title ?? ''}}</b><a class="heading-elements-toggle"><i class="icon-more"></i></a>  </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li> <a type="button" href="{{route('status')}}" class="btn btn-primary text-white   btn-rounded "> View {{$heading}}<span class="legitRipple-ripple" ></span></a></li> 
                </ul>
          </div>
        </div> 
    </div>

    {!! Form::model($status, [
        'method' => 'PATCH', 
        'route' => 
          [
            'status.update', $status->id
          ],
          'class'=>'form-basic ui-formwizard user-form',
          'id'=>'form_sample_3',
          'enctype'=>'multipart/form-data'
          ]) 
    !!}
    
    @include('admin::status.form', compact('status'))
    {!! Form::close() !!}
<!-- END FORM-->
</div>
<!-- END VALIDATION STATES-->
                     

        
@stop