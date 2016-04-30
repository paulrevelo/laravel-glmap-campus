@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-create')
@endsection

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Edit Event</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          {!! Form::model($event,['method' => 'PATCH','url'=>['events',$event->id]]) !!}
            
            <div class="form-group col-md-12">
            {!! Form::label('name', 'Name: ') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('description', 'Description: ') !!}
              {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '13']) !!}  
            </div> 

            <div class="form-group col-md-6">
            {!! Form::label('location', 'Location: ') !!}
              {!! Form::textarea('location', null, ['id' => 'resultarea', 'class' => 'form-control', 'required' => 'required', 'rows' => '2']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('room', 'Room: ') !!}
              {!! Form::text('room', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('date', 'Date: ') !!}
              {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '2017-08-01']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('time', 'Time: ') !!}
              {!! Form::time('time', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '08:00:00']) !!}
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
          <div class="box-tools pull-right">
            <a href="{{{ URL::previous() }}}" type="button" class="btn btn-default btn-flat">Cancel</a>
            {!! Form::submit('Update', ['class' => 'btn btn-primary btn-flat']) !!}
            {!! Form::close() !!}
          </div>
        </div>
            
      </div>
        
    </div><!-- /.box -->

    <div class="col-md-6">
      <div id="map-canvas" class="box box-solid"></div>
    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.js-create')
@endsection