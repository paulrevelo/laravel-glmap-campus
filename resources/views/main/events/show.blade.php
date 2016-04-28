@extends('layouts.app')

@section('contentheader_title')
    Events
@endsection

@section('main-content')
    <div class="row">
      <div class="col-md-6">

        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Event Information</h3>
            <div class="box-tools pull-right">
              <a href="{{{ URL::previous() }}}" type="button" class="btn btn-success btn-flat">Go Back</a>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">
            <h4><b>Name</b></h4>
            <p>{{ $event->name }}</p>
            <hr>
            <h4><b>Description</b></h4>
            <p>{{ $event->description }}</p>
            <hr>
            <h4><b>Location</b></h4>
            <p>{{ $event->location }}</p>
            <hr>
            <h4><b>Schedule</b></h4>
            <p>{{ $event->schedule }}</p>

          </div><!-- /.box-body -->
        </div><!-- /.box -->

      </div>

      <div class="col-md-6">
        <div class="box box-success">
        </div>
      </div>
    </div>
@stop