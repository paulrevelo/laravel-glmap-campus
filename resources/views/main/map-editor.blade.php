@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-leaflet')
@endsection

@section('contentheader_title')
	Map Editor
@endsection

@section('main-content')
	<div class="row">
    
    <div class="col-md-12">
      <div id="map-canvas" class="box box-solid"></div>
    </div>

  </div>
@endsection

@section('added_js_scripts')
	@include('main.scripts.js-leaflet')

  <script>

   // create map engine 
    var map = new L.Map('map-canvas');
    map.setView([8.241354685854704, 124.24403356388211], 17, false);

    new L.TileLayer('http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png', {
      attribution: 'Map tiles &copy; <a href="http://mapbox.com">MapBox</a>'
    }).addTo(map);


    function style(feature) {
      return {
        weight: 3,
        color: '#222D32',
        fillOpacity: 1,
        fillColor: '#00A65A'
      };
    }

    function highlightFeature(e) {
      var type = e.layerType;
      
      var layer = e.target;
      if (type === 'polygon') {
          layer.setStyle({
          weight: 5,
          color: 'black'
        });
      }
    }

    var geojsonLayer;
    

    function resetHighlight(e) {
      var type = e.layerType,
          layer = e.layer;
      if (type === 'polygon') {
      geojsonLayer.resetStyle(e.target);
      }
    }

    var selectedFeature = null;

    function zoomAndEditToFeature(e) {
      var type = e.layerType;

      if (type === 'polygon') {
      map.fitBounds(e.target.getBounds());
      }
      // if(selectedFeature)
      //   selectedFeature.editing.disable();
      //   selectedFeature = e.target;
      //   e.target.editing.enable();
    }

    function onEachFeature(feature, layer) {
      layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomAndEditToFeature
      });

      if (feature.properties) {
        var popupString = '<div class="popup">';
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

    //Strictly add per call to map
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
      // // ADD THE DATA
      // osmb.addGeoJSON(geojson);
      geojsonLayer = L.geoJson(geojson, {style:style,onEachFeature:onEachFeature}).addTo(map);
      }
    });
  }); //end strictly add

  </script>
@endsection
