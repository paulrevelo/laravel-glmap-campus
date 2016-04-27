@extends('layouts.app')

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buildings</h3>
        </div><!-- /.box-header -->

        <div class="box-body">

          <table id="buildings-table" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>                
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
  @include('main.back.building.table')
@endsection