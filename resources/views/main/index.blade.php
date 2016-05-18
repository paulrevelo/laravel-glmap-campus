@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-osm')  
@endsection

@section('contentheader_title')
	Index
@endsection

@section('main-content')

  <!-- <div id="info-box">
    <span id="preview-name"></span>
  </div> -->

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
          <span id="modal-id" style="font-size:20px;"></span>&nbsp;&#45;&nbsp;<span id="modal-title" style="font-size:20px;"></span>
        </div> 
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12" id="modal-image">
            </div>
            <div class="col-md-12" id="modal-description" style="text-align: justify; text-justify: inter-word;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        </div>
      </div>
    </div>
  </div>

  <div id="map-canvas" class="box box-solid"></div>

@endsection

@section('added_js_scripts')

  @include('main.scripts.js-osm') 

  <script>
  
    // BASEMAP
    var map = new GLMap('map-canvas', {
      position: {latitude: 8.241768789184688, longitude: 124.24392879009247},
      zoom: 17.8,
      tilt: 45
    });

    // OSM BUILDINGS
    var osmb = new OSMBuildings({
      minZoom: 17,
      maxZoom: 20,
      effects: ['shadows']
    }).addTo(map);     

    // BASEMAP TILELAYER
    osmb.addMapTiles('http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png'),
    {attribution: '© Data <a href=http://openstreetmap.org/copyright/>OpenStreetMap</a> · © Map <a href=http://mapbox.com>MapBox</a>'};

    //osmb.addOBJ('{{asset('obj/csm.obj')}}', { latitude: 8.24176613467753, longitude: 124.24443304538725}, {id: "my_object_1", scale: 1, rotation: 101, color: '#cccccc'});

    osmb.addGeoJSON("{{ asset('/json/landarea.json') }}");
    
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
      // ADD THE DATA
      osmb.addGeoJSON(geojson);
      }
    });
  }); //end strictly add

    // HIGHLIGHT
    map.on('pointermove', function(e) {
      var id = osmb.getTarget(e.x, e.y, function(id) {
        if (id) {
          document.body.style.cursor = 'pointer';
          osmb.highlight(id, '#f08000');
          
        } else {
          document.body.style.cursor = 'default';
          osmb.highlight(null);
        }
      });
    });

    // SHOW MODAL
    map.on('pointerdown', function(e) {
      var id = osmb.getTarget(e.x, e.y, function(id) {
        if (id) {
          $('#myModal').modal('show');
          getBuilding(id);
        }
      });
    });

     function getBuilding(id){
      $.ajax({
        type: 'GET',
      dataType: 'JSON',
      url: '/buildingdata/'+id,
      success: function(buildingData){
        $('#modal-id').html(buildingData.id);
        $('#modal-title').html(buildingData.name);
        // $('#preview-name').html(buildingData.name);
        $('#modal-description').html(buildingData.description);
        $('#modal-image').html('<img src="/img/buildings/'+buildingData.image+'.jpg" width="570">');
      }
      });
    }

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

  </script> 
@endsection

