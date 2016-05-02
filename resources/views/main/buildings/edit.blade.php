@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-create')
@endsection

@section('contentheader_title')
	Buildings
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Edit Building</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          {!! Form::model($building,['method' => 'PATCH','url'=>['buildings',$building->id]]) !!}
            
            <div class="form-group col-md-9">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
            </div>

            <div class="form-group col-md-3">
              {!! Form::label('height', 'Height') !!}
              {!! Form::text('height', null, ['class' => 'form-control', 'id' => 'height', 'maxlength' => '4', 'size' => '4' ]) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '11']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('polygon', 'Coordinates') !!}
            {!! Form::textarea('polygon', null, ['class' => 'form-control', 'rows' => '11', 'readonly']) !!}
            </div> 

            <div class="form-group col-md-4">
              {!! Form::label('roofcolor', 'Roof Color') !!}
              {!! Form::text('roofcolor', null, ['class' => 'form-control my-colorpicker1', 'placeholder' => '#ff8000']) !!}
            </div> 

            <div class="form-group col-md-4">
              {!! Form::label('wallcolor', 'Wall Color') !!}
              {!! Form::text('wallcolor', null, ['class' => 'form-control my-colorpicker1', 'placeholder' => '#ff0000']) !!}
            </div>

            <div class="form-group col-md-4">
              {!! Form::label('image', 'Image Name') !!}
              <div class="input-group">
                {!! Form::text('image', null, ['class' => 'form-control', 'placeholder' => 'building-name']) !!}
                <div class="input-group-addon">.jpg</div>
              </div>
            </div> 

        </div><!-- /.box-body -->

        <div class="box-footer">
          <a href="{{{ URL::previous() }}}" type="button" class="btn btn-default">Cancel</a>
          {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        </div>
  
      </div><!-- /.box -->

    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.js-create')

  <script>

    //color picker with addon
    $(".my-colorpicker1").colorpicker();

  </script>
  
@endsection