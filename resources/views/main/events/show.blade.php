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
            <div class="form-group col-md-12">
              <label style="font-size:20px;">Name</label>
              <p>{{ $event->name }}</p>
            </div>

            <div class="form-group col-md-12">
              <label style="font-size:20px;">Description</label>
              <p>{{ $event->description }}</p>
            </div>

            <div class="form-group col-md-6">
              <label style="font-size:20px;">Location</label>
              <p>{{ $event->location }}</p>
            </div>

            <div class="form-group col-md-6">
              <label style="font-size:20px;">Room</label>
              <p>{{ $event->room }}</p>
            </div>

            <div class="form-group col-md-6">
              <label style="font-size:20px;">Date</label>
              <p>{{ $event->date }}</p>
            </div>

            <div class="form-group col-md-6">
              <label style="font-size:20px;">Time</label>
              <p>{{ $event->time }}</p>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->

      </div>
    </div>
@stop