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
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
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
  attribution: '© 3D <a href="http://osmbuildings.org/copyright/">OSM Buildings</a>'
}).addTo(map);

// BASEMAP TILELAYER
osmb.addMapTiles(
  'http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png'),
{
  attribution: '© Data <a href="http://openstreetmap.org/copyright/">OpenStreetMap</a> · © Map <a href="http://mapbox.com">MapBox</a>'
};

// GEOJSON DATA
osmb.addGeoJSONTiles('http://localhost:8000/interactive-map/public/json/polygons.json');

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
    //window.alert("Building ID: " + id);
    //window.location.href = "http://localhost/bootstrap-visual-room-mapping/index-glmap.php&" + id;
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
    $('[data-toggle="tooltip"]').tooltip(); 
});


