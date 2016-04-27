<?php $__env->startSection('added-css-scripts'); ?>
	<?php echo $__env->make('main.scripts.css-glscripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('main.scripts.css-editgl', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
	Map Editor
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="row">
    
    <div class="col-md-12">
      <div id="map-canvas" class="box box-solid"></div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Building</h4>
          </div>
          <div class="modal-body row">
            
            <form role="form">
          
              <div class="form-group col-md-9">
              <label>Name</label>
                <input type="text" class="form-control" id="building-name" placeholder="Building Name">
              </div>

              <div class="form-group col-md-3">
              <label>Height</label>
                <input type="text" class="form-control" id="building-height" maxlength="4" size="4" onkeypress="setHeight(this)" placeholder="10">
              </div>

              <div class="form-group col-md-6">
                <label>Wall Color</label>
                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="wallColor" onkeypress="setWallColor(this)"placeholder="#ff0000">
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label>Roof Color</label>
                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="roofColor" onkeypress="setRoofColor(this)" placeholder="#ff8000">
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12">
              <label>Description</label>
                <textarea id="description" class="form-control" rows="5"></textarea>        
              </div>     

              <div class="form-group col-md-12">
              <label>Coordinates</label>
                <textarea id="resultarea" class="form-control" rows="5"></textarea>        
              </div>  

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Building</h4>
          </div>
          <div class="modal-body row">
            
            <form role="form">
          
              <div class="form-group col-md-9">
              <label>Name</label>
                <input type="text" class="form-control" id="building-name" placeholder="Building Name">
              </div>

              <div class="form-group col-md-3">
              <label>Height</label>
                <input type="text" class="form-control" id="building-height" maxlength="4" size="4" onkeypress="setHeight(this)" placeholder="10">
              </div>

              <div class="form-group col-md-6">
                <label>Wall Color</label>
                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="wallColor" onkeypress="setWallColor(this)"placeholder="#ff0000">
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label>Roof Color</label>
                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="roofColor" onkeypress="setRoofColor(this)" placeholder="#ff8000">
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12">
              <label>Description</label>
                <textarea id="description" class="form-control" rows="5"></textarea>        
              </div>     

              <div class="form-group col-md-12">
              <label>Coordinates</label>
                <textarea id="resultarea" class="form-control" rows="5"></textarea>        
              </div>  

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('added_js_scripts'); ?>
	<?php echo $__env->make('main.scripts.js-editgl', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
      zoom: 20
    }).addTo(map);

    <?php echo $__env->make('main.back.partials.json-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

    function zoomToFeature(e) {
      map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
      layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
      });

      if (feature.properties) {
        var popupString = '<div class="popup"> <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit-modal">Edit</button><br>';
        for (var k in feature.properties) {
            var v = feature.properties[k];
            popupString += k + ': ' + v + '<br>';
        }
        popupString += '</div>';
        layer.bindPopup(popupString, {
            maxHeight: 200
        });
      }
    }

    // SHOW BUILDINGS
    geojsonLayer = L.geoJson(geojson, {style:style,onEachFeature:onEachFeature}).addTo(map);

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

      // export the coordinates from the layer
      coordinates = [];
      latlngs = layer.getLatLngs();
      for (var i = 0; i < latlngs.length; i++) {
          coordinates.push([latlngs[i].lng, latlngs[i].lat])
      }

      var coordinates_result = JSON.stringify(coordinates, null, 4);

      document.getElementById("resultarea").innerHTML = coordinates_result;
      $('#add-modal').modal('show');
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