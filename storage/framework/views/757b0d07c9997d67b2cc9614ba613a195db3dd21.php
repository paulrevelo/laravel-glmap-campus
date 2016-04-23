<?php $__env->startSection('css-map-editor'); ?>
	<link href="css/map-styles.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo e(asset('/css/colorpicker/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet" type="text/css" />

  <link rel='stylesheet prefetch' href='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.css'>

  <link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css">
  
  <link rel="stylesheet" type="text/css" href="http://cdn.osmbuildings.org/Leaflet.draw/0.2.0/leaflet.draw.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
	Map Editor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="row">

    <div class="col-md-3">
      <div class="box box-success collapsed-box box-solid">
        <textarea id="resultarea" class="form-control" rows="15"></textarea>
      </div>
    </div>

    <!-- <div class="col-md-3">

      <div class="box box-success collapsed-box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Building</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>

        </div>

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

              </div>

              <div class="form-group">
                <label>Roof Color</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="roofColor" onkeypress="setRoofColor(this)" placeholder="#ff8000">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>

              </div>

            </div>                

          </form>
        </div>

      </div>

    </div> -->
    
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-map-editor'); ?>
	<!-- bootstrap color picker -->
	<script src="<?php echo e(asset('/js/colorpicker/bootstrap-colorpicker.min.js')); ?>" type="text/javascript"></script>

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

    var geojson = {"type":"Feature","geometry":{"type":"Polygon","coordinates":[[[124.24492120742796,8.24466219137958],[124.24698114395143,8.243791518450246],[124.24693822860716,8.241986458709938],[124.24524307250975,8.240648585587165],[124.24442768096922,8.243536686986348]]]}};
    
    L.geoJson(geojson).addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
      draw: {
        position: 'topleft',
        polygon: {
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
        polyline: false,
        circle: false,
        rectangle: false,
        marker: false
      },
      edit: {
        featureGroup: drawnItems
      }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {
    var type = e.layerType,
        layer = e.layer;

    if (type === 'polygon') {
      // structure the geojson object
      var geojson = {};
      geojson['type'] = 'Feature';
      geojson['geometry'] = {};
      geojson['geometry']['type'] = "Polygon";

      // export the coordinates from the layer
      coordinates = [];
      latlngs = layer.getLatLngs();
      for (var i = 0; i < latlngs.length; i++) {
          coordinates.push([latlngs[i].lng, latlngs[i].lat])
      }

      // push the coordinates to the json geometry
      geojson['geometry']['coordinates'] = [coordinates];

      // Finally, show the poly as a geojson object in the console
      //console.log(JSON.stringify(geojson));

      var result = JSON.stringify(geojson);

      document.getElementById("resultarea").innerHTML = result;
    }
  drawnItems.addLayer(layer);
  });

  map.on('draw:edited', function (e) {
    var layers = e.layers;
    layers.eachLayer(function (layer) {
      if (layer instanceof L.Polyline) {
          //Do marker specific actions here
      }
        //do whatever you want, most likely save back to db
    });
  });

  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>