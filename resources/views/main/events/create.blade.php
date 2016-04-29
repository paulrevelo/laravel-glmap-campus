@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-glscripts')
  @include('main.scripts.css-editgl')
@endsection

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-6">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Add New Event</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          {!! Form::open(['url' => 'events']) !!}
            
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
            {!! Form::submit('Add', ['class' => 'btn btn-primary btn-flat']) !!}  
          </div>
          {!! Form::close() !!}
        </div><!-- /.box -->

      </div>
    </div>

    <div class="col-md-6">
      <div id="map-canvas" class="box box-solid"></div>
    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.js-editgl')

  <script>
  
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

   // create map engine 
    var map = new L.Map('map-canvas');
    map.setView([8.241354685854704, 124.24403356388211], 17, false);

    new L.TileLayer('http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png', {
      attribution: 'Map tiles &copy; <a href="http://mapbox.com">MapBox</a>'
    }).addTo(map);

    // GEOJSON DATA
    @include('main.back.partials.json-scripts')

    function style(feature) {
      return {
        weight: 2,
        color: '#222D32',
        fillOpacity: 0.8,
        fillColor: '#00A65A'
      };
    }

    function highlightFeature(e) {
      var layer = e.target;

      layer.setStyle({
        weight: 5,
        color: 'black'
      });

      if (!L.Browser.ie && !L.Browser.opera) {
          layer.bringToFront();
      }
    }

    var geojsonLayer;

    function resetHighlight(e) {
      geojsonLayer.resetStyle(e.target);
    }

    function onEachFeature(feature, layer) {
      layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight
      });

      layer.bindPopup("ID: " + feature.properties.id + "</br>Name: " + feature.properties.name);

    }

    // SHOW BUILDINGS
    geojsonLayer = L.geoJson(geojson, {style:style,onEachFeature:onEachFeature}).addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
      draw: {
        position: 'topleft',
        polygon: false,
        polyline: false,
        circle: false,
        rectangle: false,
        marker: true
      },
      edit: {
        featureGroup: drawnItems
      }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {

    var marker,
        type = e.layerType,
        layer = e.layer;

    if (type === 'marker') {

      marker = layer.getLatLng();

      resultarea.innerHTML = "&#91 " + marker.lng + ', ' + marker.lat + " &#93";

      }
    drawnItems.addLayer(layer);
    });

    map.on('draw:edited', function (e) {
      var marker,
          layers = e.layers;
      layers.eachLayer(function (layer) {
        if (layer instanceof L.Marker) {
          marker = layer.getLatLng();

          resultarea.innerHTML = "&#91 " + marker.lng + ', ' + marker.lat + " &#93";
        }
      });
    });
  </script>
  
@endsection