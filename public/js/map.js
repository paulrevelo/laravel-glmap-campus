
$(document).ready(function(){ /* google maps -----------------------------------------------------*/

  var map;

  google.maps.event.addDomListener(window, 'load', initialize);

  function initialize() {

    map = new google.maps.Map(document.getElementById('map-canvas'), {
      center: {lat: 8.23997567, lng: 124.24481962}, // MSU-IIT
      zoom: 18,
      mapTypeId:google.maps.MapTypeId.HYBRID,
      disableDoubleClickZoom: true
    });

    map.data.loadGeoJson('http://localhost/bootstrap-visual-room-mapping/dist/json/polygons.json');

    map.data.setStyle({
      strokeColor: '#333333',
      strokeOpacity: 1,
      strokeWeight: 2,
      fillColor: '#333333',
      fillOpacity: 0.5
    });

    map.data.addListener('mouseover', function(event) {
      document.getElementById('info-box').textContent = event.feature.getProperty('building-name');
      map.data.revertStyle();
      map.data.overrideStyle(event.feature, {
        strokeColor: '#ff4949', 
        strokeWeight: 4, 
        fillColor: '#ff4949', 
        fillOpacity: 0.5
      });
    });

    map.data.addListener('mouseout', function(event) {
      map.data.revertStyle();
    });

    map.data.addListener('click', showArrays);

    infoWindow = new google.maps.InfoWindow;
  }

  function showArrays(event) {
      // Since this polygon has only one path, we can call getPath() to return the
      // MVCArray of LatLngs.
      var vertices = this.getPath();

      var contentString = '<b>Bermuda Triangle polygon</b><br>' +
          'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
          '<br>';

      // Iterate over the vertices.
      for (var i =0; i < vertices.getLength(); i++) {
        var xy = vertices.getAt(i);
        contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
            xy.lng();
      }

      // Replace the info window's content and position.
      infoWindow.setContent(contentString);
      infoWindow.setPosition(event.latLng);

      infoWindow.open(map);
    }
});