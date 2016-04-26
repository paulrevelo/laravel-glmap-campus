@extends('layouts.app')

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
            <a href="add-event.php" class="btn btn-success btn-flat"><i class="fa fa-plus fa-fw"></i>Add New Event</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body" id="dvData">

          <table id="example" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>{{ trans('front/event.name') }}</th>
                <th>{{ trans('front/event.description') }}</th>
                <th>{{ trans('front/event.location') }}</th>
                <th>{{ trans('front/event.date') }}</th>      
                <th>{{ trans('front/event.time') }}</th>
              </tr>
            </thead>
            <tbody>      
              @include('main.back.event.table')
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.db-scripts')
@endsection