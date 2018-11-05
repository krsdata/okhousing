{!! Form::model($project, ['route' => ['project.store'],'class'=>'form-basic ui-formwizard user-form','id'=>'user-form','enctype'=>'multipart/form-data']) !!}

@include('admin::projects.form')

{!! Form::close() !!}

<!-- 
<input type="text" class="form-control" id="builder_code" name="builder_code" placeholder="search by Builder ID Ex. BLD-10001">
                         -->