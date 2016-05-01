@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-database')  
@endsection

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Events</h3>
          <div class="box-tools pull-right">
            <a href="{{url('/events/create')}}" class="btn btn-success btn-flat"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add New Event</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">

          <table id="events-table" class="table table-hover table-condensed table-responsive">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Room</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th> 
                <th></th>              
              </tr>
            </thead>
            
            <tbody>
              @foreach($events as $event)
                <tr>
                  <td>{{ $event->id }}</td>
                  <td><a href="{{ url('events', $event->id) }}">{{ $event->name }}</a></td>
                  <td>{{ $event->description }}</td>
                  <td>{{ $event->location }}</td>
                  <td>{{ $event->room }}</td>
                  <td>{{ $event->date }}</td>
                  <td>{{ $event->time }}</td>
                  <td><a href="{{route('events.edit',$event->id)}}" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i>Edit</a></td>
                  <td>
                      {!! Form::open(['method' => 'DELETE', 'route'=>['events.destroy', $event->id]]) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                      {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>

          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.js-database')
  
  <script>
  $(function() {
    $('#events-table').DataTable({    
      ordering: true,
      searching: true,
      paging: true,
      autoWidth: false,
      pagingType: "full_numbers",
      columnDefs: [ {
        targets: 2,
        render: function ( data, type, row ) {
            return data.length > 10 ?
              data.substr( 0, 10 ) +'…' :
              data;
        }
      }]
    });
  });
  </script>

@endsection