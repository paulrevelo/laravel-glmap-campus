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
            
            <?php echo Form::open(['url' => 'main/map-editor']); ?>

          
              <div class="form-group col-md-9 <?php echo e($errors->has('building-name') ? 'has-error' : ''); ?>">
              <?php echo Form::label('building-name', 'Name: '); ?>

                <?php echo Form::text('building-name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name']); ?>

                <?php echo $errors->first('building-name', '<p class="help-block">:message</p>'); ?>

              </div>

              <div class="form-group col-md-3 <?php echo e($errors->has('building-height') ? 'has-error' : ''); ?>">
              <?php echo Form::label('building-height', 'Height: '); ?>

                <?php echo Form::text('building-height', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name', 'maxlength' => '4', 'size' => '4' ]); ?>

                <?php echo $errors->first('building-height', '<p class="help-block">:message</p>'); ?>

              </div>

              <div class="form-group col-md-6 <?php echo e($errors->has('wall-color') ? 'has-error' : ''); ?>">
                <?php echo Form::label('wall-color', 'Wall Color: '); ?>

                <div class="input-group my-colorpicker2">
                  <?php echo Form::text('wall-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'wall-color', 'placeholder' => '#ff0000']); ?>

                  <?php echo $errors->first('wall-color', '<p class="help-block">:message</p>'); ?>

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6 <?php echo e($errors->has('roof-color') ? 'has-error' : ''); ?>">
                <?php echo Form::label('roof-color', 'Roof Color: '); ?>

                <div class="input-group my-colorpicker2">
                  <?php echo Form::text('roof-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'roof-color', 'placeholder' => '#ff8000', 'onkeypress' => 'setRoofColor(this)']); ?>

                  <?php echo $errors->first('roof-color', '<p class="help-block">:message</p>'); ?>

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12 <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
              <?php echo Form::label('description', 'Description: '); ?>

                <?php echo Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']); ?>

                <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>   
              </div>     

              <div class="form-group col-md-12 <?php echo e($errors->has('coordinates') ? 'has-error' : ''); ?>">
              <?php echo Form::label('coordinates', 'Coordinates: '); ?>

                <?php echo Form::textarea('coordinates', null, ['id' => 'resultarea', 'class' => 'form-control', 'required' => 'required', 'rows' => '5']); ?>

                <?php echo $errors->first('coordinates', '<p class="help-block">:message</p>'); ?>       
              </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <?php echo Form::submit('Add', ['class' => 'btn btn-primary']); ?>

          </div>
          <?php echo Form::close(); ?>


          <?php if($errors->any()): ?>
            <ul class="alert alert-danger">
              <?php foreach($errors->all() as $error): ?>
                  <li><?php echo e($error); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="edit-modal" onclick="getData(feature.id)" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Building</h4>
          </div>
          <div class="modal-body row">
            
            <?php echo Form::open(['url' => 'main/map-editor']); ?>

          
              <div class="form-group col-md-9 <?php echo e($errors->has('building-name') ? 'has-error' : ''); ?>">
              <?php echo Form::label('building-name', 'Name: '); ?>

                <?php echo Form::text('building-name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name']); ?>

                <?php echo $errors->first('building-name', '<p class="help-block">:message</p>'); ?>

              </div>

              <div class="form-group col-md-3 <?php echo e($errors->has('building-height') ? 'has-error' : ''); ?>">
              <?php echo Form::label('building-height', 'Height: '); ?>

                <?php echo Form::text('building-height', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name', 'maxlength' => '4', 'size' => '4' ]); ?>

                <?php echo $errors->first('building-height', '<p class="help-block">:message</p>'); ?>

              </div>

              <div class="form-group col-md-6 <?php echo e($errors->has('wall-color') ? 'has-error' : ''); ?>">
                <?php echo Form::label('wall-color', 'Wall Color: '); ?>

                <div class="input-group my-colorpicker2">
                  <?php echo Form::text('wall-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'wall-color', 'placeholder' => '#ff0000']); ?>

                  <?php echo $errors->first('wall-color', '<p class="help-block">:message</p>'); ?>

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6 <?php echo e($errors->has('roof-color') ? 'has-error' : ''); ?>">
                <?php echo Form::label('roof-color', 'Roof Color: '); ?>

                <div class="input-group my-colorpicker2">
                  <?php echo Form::text('roof-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'roof-color', 'placeholder' => '#ff8000', 'onkeypress' => 'setRoofColor(this)']); ?>

                  <?php echo $errors->first('roof-color', '<p class="help-block">:message</p>'); ?>

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12 <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
              <?php echo Form::label('description', 'Description: '); ?>

                <?php echo Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']); ?>

                <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>   
              </div>     

              <div class="form-group col-md-12 <?php echo e($errors->has('coordinates') ? 'has-error' : ''); ?>">
              <?php echo Form::label('coordinates', 'Coordinates: '); ?>

                <?php echo Form::textarea('coordinates', null, ['id' => 'resultarea', 'class' => 'form-control', 'required' => 'required', 'rows' => '5']); ?>

                <?php echo $errors->first('coordinates', '<p class="help-block">:message</p>'); ?>       
              </div>  

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <?php echo Form::submit('Update', ['class' => 'btn btn-primary']); ?>

          </div>
          <?php echo Form::close(); ?>


          <?php if($errors->any()): ?>
            <ul class="alert alert-danger">
              <?php foreach($errors->all() as $error): ?>
                  <li><?php echo e($error); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

        </div>
      </div>
    </div>
    
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('added_js_scripts'); ?>
	<?php echo $__env->make('main.scripts.js-editgl', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <script>

    // function getData(id) {
    //   $.ajax
    // }

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
      //alert(feature.properties.id);
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