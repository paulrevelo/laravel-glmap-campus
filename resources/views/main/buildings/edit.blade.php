@extends('layouts.app')

@section('contentheader_title')
	Buildings
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-6">

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
              {!! Form::label('height', 'Height: ') !!}
                {!! Form::text('height', null, ['class' => 'form-control', 'id' => 'height', 'maxlength' => '4', 'size' => '4' ]) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('description', 'Description: ') !!}
              {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '11']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('polygon', 'Coordinates: ') !!}
              {!! Form::textarea('polygon', null, ['id' => 'resultarea', 'class' => 'form-control', 'rows' => '11']) !!}
            </div> 

            <div class="form-group col-md-6">
              {!! Form::label('wallcolor', 'Wall Color: ') !!}
              <div class="input-group my-colorpicker2">
                {!! Form::text('wallcolor', null, ['class' => 'form-control', 'placeholder' => '#ff0000']) !!}
                <div class="input-group-addon">
                  <i></i>
                </div>
              </div>
            </div>

            <div class="form-group col-md-6">
              {!! Form::label('roofcolor', 'Roof Color: ') !!}
              <div class="input-group my-colorpicker2">
                {!! Form::text('roofcolor', null, ['class' => 'form-control', 'placeholder' => '#ff8000']) !!}
                <div class="input-group-addon">
                  <i></i>
                </div>
              </div>
            </div>  

        </div><!-- /.box-body -->
          <div class="box-footer">
            <a href="{{{ URL::previous() }}}" type="button" class="btn btn-default">Cancel</a>
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
          </div>
          {!! Form::close() !!}

          @if ($errors->any())
            <ul class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
      </div><!-- /.box -->

    </div>

    <div class="col-md-6">
      <div class="box box-success">
      </div>
    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.db-scripts')
  
@endsection