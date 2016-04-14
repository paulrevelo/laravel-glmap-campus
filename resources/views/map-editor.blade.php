@extends('layouts.app')

@section('css-map-editor')
	<link href="{{ asset('/css/map-styles.css') }}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('/css/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css" />

  <link rel='stylesheet prefetch' href='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.css'>

  <link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css">
  
  <link rel="stylesheet" type="text/css" href="http://cdn.osmbuildings.org/Leaflet.draw/0.2.0/leaflet.draw.css">
@endsection

@section('contentheader_title')
	Map Editor
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-3">

      <div class="box box-success collapsed-box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Building</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form">
            <div class="box-body">

              <div class="form-group">
              <label>Name</label>
                <input type="text" class="form-control" id="building-name" placeholder="Building Name">
              </div>

              <div class="form-group">
              <label>Height</label>
                <input type="text" class="form-control" id="building-height" maxlength="4" size="4" onkeypress="setHeight(this)" placeholder="100">
              </div>

              <div class="form-group">
                <label>Wall Color</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="wallColor" onkeypress="setWallColor(this)"
                  placeholder="#ff0000">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Roof Color</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="roofColor" onkeypress="setRoofColor(this)" placeholder="#ff8000">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

            </div>                
            <!-- /.box-body -->

          </form>
        </div><!-- /.box-body -->
        <!-- /.box-body -->
      </div>

    </div>
    
    <div class="col-md-9">
      <div id="map-canvas" class="box box-solid"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('scripts-map-editor')
	<!-- bootstrap color picker -->
	<script src="{{ asset('/js/colorpicker/bootstrap-colorpicker.min.js') }}" type="text/javascript"></script>

  <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.2.3/leaflet.draw.js" type="text/javascript"></script>

  <script>
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

   // create map engine 
    var map = new L.Map('map-canvas');
    map.setView([8.241354685854704, 124.24403356388211], 16, false);

    new L.TileLayer('http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png', {
      attribution: 'Map tiles &copy; <a href="http://mapbox.com">MapBox</a>',
      maxZoom: 18,
      maxNativeZoom: 20,
      zoom: 19
    }).addTo(map);

    // load GeoJSON from an external file
    $.getJSON("rodents.geojson",function(data){
      // add GeoJSON layer to the map once the file is loaded
      L.geoJson(data).addTo(map);
    });

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
      draw: {
        position: 'topleft',
        polygon: {
          title: 'Draw a sexy polygon!',
          allowIntersection: false,
          drawError: {
            color: '#b00b00',
            timeout: 1000
          },
          shapeOptions: {
            color: '#bada55'
          },
          showArea: true
        },
        polyline: {
          metric: false
        },
        circle: {
          shapeOptions: {
            color: '#662d91'
          }
        }
      },
      edit: {
        featureGroup: drawnItems
      }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {
      var type = e.layerType,
        layer = e.layer;

      if (type === 'marker') {
        layer.bindPopup('A popup!');
      }

      drawnItems.addLayer(layer);
    });
  </script>
@endsection
