@extends('layouts.app')

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-6">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Edit Event</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          {!! Form::model($event,['method' => 'PATCH','url'=>['events',$event->id]]) !!}
            
            <div class="form-group col-md-12 {{ $errors->has('event-name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name: ') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'event-name']) !!}
              {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description: ') !!}
              {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']) !!}
              {!! $errors->first('description', '<p class="help-block">:message</p>') !!}   
            </div> 

            <div class="form-group col-md-12 {{ $errors->has('location') ? 'has-error' : ''}}">
            {!! Form::label('location', 'Location: ') !!}
              {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'location']) !!}
              {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group col-md-6 {{ $errors->has('schedule') ? 'has-error' : ''}}">
            {!! Form::label('schedule', 'Schedule: ') !!}
              {!! Form::text('schedule', null, ['class' => 'form-control', 'required' => 'required']) !!}
              {!! $errors->first('schedule', '<p class="help-block">:message</p>') !!}
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