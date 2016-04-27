@extends('layouts.app')

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <!-- ADD MODAL -->
      <div class="modal fade" id="add-event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add New Building</h4>
            </div>
            <div class="modal-body row">
              
              {!! Form::open(['url' => 'main/events']) !!}
            
                <div class="form-group col-md-12 {{ $errors->has('event-name') ? 'has-error' : ''}}">
                {!! Form::label('event-name', 'Name: ') !!}
                  {!! Form::text('event-name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'event-name']) !!}
                  {!! $errors->first('event-name', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description: ') !!}
                  {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']) !!}
                  {!! $errors->first('description', '<p class="help-block">:message</p>') !!}   
                </div> 

                <div class="form-group col-md-9 {{ $errors->has('location') ? 'has-error' : ''}}">
                {!! Form::label('location', 'Location: ') !!}
                  {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'location']) !!}
                  {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group col-md-12 {{ $errors->has('schedule') ? 'has-error' : ''}}">
                {!! Form::label('schedule', 'Schedule: ') !!}
                  {!! Form::date('schedule', null, ['class' => 'form-control', 'required' => 'required']) !!}
                  {!! $errors->first('schedule', '<p class="help-block">:message</p>') !!}
                </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

            @if ($errors->any())
              <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif

          </div>
        </div>
      </div>

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Events</h3>
          <div class="box-tools pull-right">
            <a data-toggle="modal" data-target="#add-event-modal" class="btn btn-success btn-flat"><i class="fa fa-plus fa-fw"></i>Add New Event</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">

          <table id="events-table" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Schedule</th>                
              </tr>
            </thead>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.db-scripts')
  @include('main.back.event.table')
@endsection