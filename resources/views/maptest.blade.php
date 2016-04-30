<html lang="en">
<head>
    @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show

  	@include('main.scripts.css-glscripts')  
</head>
<div class="col-md-6">
	<div id="map-canvas" class="box box-solid"></div>
</div>
<div class="col-md-6">
	<div id="geo">Say something here</div>
</div>

@section('scripts')
    @include('layouts.partials.scripts')
@show

  @include('main.scripts.js-glscripts')  

  <script>
 
    var map = new GLMap('map-canvas', {
      position: {latitude: 8.241354685854704, longitude: 124.24403356388211},
      zoom: 18,
      minZoom: 16.5,
      maxZoom: 19.5,
      tilt: 45
    });

    // OSM BUILDINGS
    var osmb = new OSMBuildings({
      minZoom: 16.5,
      maxZoom: 19.5,
      effects: ['shadows'],
      attribution: '© 3D <a href=http://osmbuildings.org/copyright/>OSM Buildings</a>'
    }).addTo(map);   

    // BASEMAP TILELAYER
    osmb.addMapTiles(
      'http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png'),
    {
      attribution: '© Data <a href=http://openstreetmap.org/copyright/>OpenStreetMap</a> · © Map <a href=http://mapbox.com>MapBox</a>'
    };

    //STRICTLY add per call to map

    var geojson=null;
    //convert string to array.
    function convertToArray(string){
      var array = JSON.parse("" + string +"");
      return array;
    }
    var valid = JSON.stringify(geojson);

    $(function(){

      $.ajax({
      type: 'GET',
      dataType: 'JSON',
      url: '/buildingdata',
      success: function(buildings){
        //console.log(buildings);
        // console.log('success', building);
        var features = new Array();
          $.each(buildings, function(i, building){
            //console.log(building);

            features[i] = {
                type: "Feature", 
                geometry: {
                  type: "Polygon",
                  coordinates: convertToArray(building.polygon)
                },
                properties: {
                  id:  building.id,
                  roofColor: building.roofcolor,
                  height: building.height,
                  wallColor: building.wallcolor
                }
            }
        });

       geojson = {
          type: "FeatureCollection", 
          features: features
       }
    	// ADD THE DATA HERE AND HERE ONLY
    	osmb.addGeoJSON(geojson); //GEOJSON
      }
    });
  });	//end strictly add


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

    // map.on('pointerdown', function(e){
    //  var id = osmb.getTarget(e.x-63, e.y-63);

    //   if (id) {
    //     $('#myModal').modal('show');
    //     //window.alert("Building ID:  + id);
    //     //window.location.href = "-building=" + id;
    //   } else {
        
    //   }
    // });

  </script> 

</body>
</html>
