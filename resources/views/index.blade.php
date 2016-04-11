@extends('layouts.app')

@section('css-glmap')
  <link href="{{ asset('/css/map-styles.css') }}"rel="stylesheet" type="text/css" />

  <link rel='stylesheet prefetch' href='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.css'>
@endsection

@section('contentheader_title')
	Index
@endsection

@section('main-content')
	<div class="control tilt btn-group-vertical">
    <button type="button" class="btn btn-default dec" data-toggle="tooltip" data-placement="right" title="Tilt down">
      <i class="fa fa-long-arrow-up"></i>
    </button>
    <button type="button" class="btn btn-default inc" data-toggle="tooltip" data-placement="right" title="Tilt up">
      <i class="fa fa-long-arrow-down "></i>
    </button>
  </div>

  <div class="control rotation btn-group-vertical">
    <button type="button" class="btn btn-default inc" data-toggle="tooltip" data-placement="right" title="Rotate clockwise">
      <i class="fa fa-repeat"></i>
    </button>
    <button type="button" class="btn btn-default dec" data-toggle="tooltip" data-placement="right" title="Rotate counter clockwise">
      <i class="fa fa-undo"></i>
    </button>
  </div>

  <div class="control zoom btn-group-vertical">
    <button type="button" class="btn btn-default inc" data-toggle="tooltip" data-placement="right" title="Zoom in">
      <i class="fa fa-plus"></i>
    </button>
    <button type="button" class="btn btn-default dec"data-toggle="tooltip" data-placement="right" title="Zoom out">
      <i class="fa fa-minus"></i>
    </button>
  </div>

  <div id="map-canvas" class="box box-solid"></div>
@endsection

@section('scripts-glmap')
  <script src='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.js'></script>

  <script src='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/OSMBuildings/OSMBuildings-GLMap.js'></script>
      
  <script src="https://cdn.rawgit.com/tweenjs/tween.js/master/src/Tween.js"></script>

  <script src="{{ asset('/js/index2.js') }}" type="text/javascript"></script>
@endsection