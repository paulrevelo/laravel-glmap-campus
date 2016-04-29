<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @section('htmlheader')
    @include('layouts.partials.htmlheader')
    @include('main.scripts.css-user-map') 
  @show     
</head>

<body class="skin-green sidebar-collapse">
<div class="wrapper">

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

<!--   <div class="control tilt btn-group-vertical">
    <a href="{{url('/login')}}" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Login">
      Login</a>
    </button>
  </div> -->

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

  <!-- Main Header -->
<!--     <header class="main-header">

        
        <a class="logo">
          
          <span class="logo-lg"><b>Virtual.ly</b></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
           <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li>
                <a href="{{url('/login')}}" type="button">Login</a>
              </li>

            </ul>
          </div> 
        </nav>

    </header> -->



    <!-- Content Wrapper. Contains page content -->
    <!-- <div class="content-wrapper">
    </div> --><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

@section('scripts')
  @include('layouts.partials.scripts')
  @include('main.scripts.js-glscripts') 
@show

   

  <script>

    // BASEMAP
    var map = new GLMap('map-canvas', {
      position: {latitude: 8.241097198309157, longitude: 124.24392879009247},
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

    // GEOJSON DATA
    @include('main.back.partials.json-scripts')

    // ADD THE DATA
    osmb.addGeoJSON(geojson);

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
        } else {
          
        }
      });
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

  </script> 

</body>
</html>
