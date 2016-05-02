@extends('layouts.app')

@section('contentheader_title')
    Buildings
@endsection

@section('main-content')
    <div class="row">
      <div class="col-md-6">

        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Building Information</h3>
            <div class="box-tools pull-right">
              <a href="{{{ URL::previous() }}}" type="button" class="btn btn-success btn-flat">Go Back</a>
            </div>
          </div><!-- /.box-header -->

          <div class="box-body">

            <h4><b>Name</b></h4>
            <p>{{ $building->name }}</p>
            <hr>
            <h4><b>Description</b></h4>
            <p>{{ $building->description }}</p>
            <hr>
            <h4><b>Height</b></h4>
            <p>{{ $building->height }}</p>
            <hr>
            <h4><b>Roof Color</b></h4>
            <p>{{ $building->roofcolor }}</p>
            <hr>
            <h4><b>Wall Color</b></h4>
            <p>{{ $building->wallcolor }}</p>
            <hr>
            <h4><b>Coordinates</b></h4>
            <p>{{ $building->polygon }}</p>
            <hr>
          </div><!-- /.box-body -->
        </div><!-- /.box -->

      </div>

      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-body">
            <img src="{{asset('img/buildings/'.$building->image.'.jpg')}}" height="100%" width="100%" class="img-rounded">
          </div>
        </div>
      </div>
    </div>
@stop