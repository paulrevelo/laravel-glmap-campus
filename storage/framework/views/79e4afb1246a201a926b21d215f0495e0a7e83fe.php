<?php $__env->startSection('css-glmap'); ?>
  <link href="<?php echo e(asset('/css/map-styles.css')); ?>" rel="stylesheet" type="text/css" />

  <link rel='stylesheet prefetch' href='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.css'>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
	Index
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
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

  <div id="map-canvas" class="box box-solid"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-glmap'); ?>
  <script src='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.js'></script>

  <script src='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/OSMBuildings/OSMBuildings-GLMap.js'></script>
      
  <script src="https://cdn.rawgit.com/tweenjs/tween.js/master/src/Tween.js"></script>

  <script>
    
    var pointData = {
      default: function(){
        return {latitude: 8.241354685854704, longitude: 124.24403356388211, rotation: 0, zoom: 18, tilt: 45};
      },
      a: function(){
        return {latitude: 8.239889393667994, longitude: 124.24477636814117, rotation: 0, zoom: 21, tilt: 45};
      },
      b: function(){
        return {latitude: 8.239772594781904, longitude: 124.24459934234618, rotation: 0, zoom: 21, tilt: 45};
      },
      c: function(){
        return {latitude: 8.240072555488139, longitude: 124.24456983804703, rotation: 0, zoom: 21, tilt: 45};
      }
    };

    // map creation
    var initMapConfig = pointData.default();
    var map = new GLMap('map-canvas', {
      position: { latitude: initMapConfig.latitude, longitude: initMapConfig.longitude},
      zoom: initMapConfig.zoom,
      rotation: initMapConfig.rotation,
      tilt: initMapConfig.tilt,
      minZoom: 16,
      maxZoom: 22,
      attribution: '&copy; <a href=http://www.openstreetmap.org/copyright>OpenStreetMap</a> contributors, &copy; <a href=http://cartodb.com/attributions>CartoDB</a>'
    });

    /*var map = new GLMap('map-canvas', {
      position: {latitude: 8.241354685854704, longitude: 124.24403356388211},
      zoom: 19,
      minZoom: 15,
      maxZoom: 22,
      tilt: 45
    }); */

    // OSM BUILDINGS
    var osmb = new OSMBuildings({
      minZoom: 15,
      maxZoom: 22,
      attribution: '© 3D <a href=http://osmbuildings.org/copyright/>OSM Buildings</a>'
    }).addTo(map);   

    // BASEMAP TILELAYER
    osmb.addMapTiles(
      'http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png'),
    {
      attribution: '© Data <a href=http://openstreetmap.org/copyright/>OpenStreetMap</a> · © Map <a href=http://mapbox.com>MapBox</a>'
    };

    // GEOJSON DATA
    osmb.addGeoJSON("<?php echo e(asset('/json/polygons.geojson')); ?>");

    // button handling
    var currentPoint = 'default';
    var animationTime = 1500;
    var buttons = document.querySelectorAll('a');
    var tween = null;
    var isAnimating = false;

    [].forEach.call(buttons, function(button){
       button.addEventListener('click', handleButton, false);      
    });

    function handleButton(){
      var pointTo = this.getAttribute('data-point');
      var pointFrom = pointTo === 'a' ? 'b' : 'a';
      
      if(currentPoint === pointTo || isAnimating){
        return false;
      }
      
      currentPoint = pointTo;
      startAnimation(pointData[pointFrom](), pointData[pointTo]());
    }

    function startAnimation(valuesFrom, valuesTo){
      if(tween){
        tween.stop();
      }
      
      isAnimating = true;
      tween = new TWEEN.Tween(valuesFrom)
      .to(valuesTo, animationTime)
      .onUpdate(function() {
        map.setPosition({ latitude: this.latitude, longitude: this.longitude });
        map.setRotation(this.rotation);
        map.setZoom(this.zoom);
        map.setTilt(this.tilt);
      })
      .onComplete(function(){
        isAnimating = false;
      })
      .start();

      requestAnimationFrame(animate);
    }

    function animate(time) {
      requestAnimationFrame(animate);
      TWEEN.update(time);
    }

    // HIGHLIGHT EVENT LISTENER
    map.on('pointermove', function(e) {
      var id = osmb.getTarget(e.x-63, e.y-63);

      if (id) {
        document.body.style.cursor = 'pointer';
        osmb.highlight(id, '#282828');
      } else {
        document.body.style.cursor = 'default';
        osmb.highlight(null);
      }
    });

    map.on('pointerdown', function(e){
     var id = osmb.getTarget(e.x-63, e.y-63);

      if (id) {
        $('#myModal').modal('show');
        //window.alert(Building ID:  + id);
        //window.location.href = http://localhost/bootstrap-visual-room-mapping/index-glmap.php& + id;
      } else {
        
      }
    });

    // CONTROL BUTTONS
    var controlButtons = document.querySelectorAll('.control button');

    for (var i = 0; i < controlButtons.length; i++) {
      controlButtons[i].addEventListener('click', function(e) {
        var button = this;
        var parentClassList = button.parentNode.classList;
        var direction = button.classList.contains('inc') ? 1 : -1;
        var increment;
        var property;

        if (parentClassList.contains('tilt')) {
          property = 'Tilt';
          increment = direction*10;
        }
        if (parentClassList.contains('rotation')) {
          property = 'Rotation';
          increment = direction*10;
        }
        if (parentClassList.contains('zoom')) {
          property = 'Zoom';
          increment = direction*1;
        }
        if (parentClassList.contains('bend')) {
          property = 'Bend';
          increment = direction*1;
        }
        if (property) {
          map['set'+ property](map['get'+ property]()+increment);
        }
      });
    }

    $(document).ready(function(){
        $('[data-toggle=tooltip]').tooltip(); 
    });

  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>