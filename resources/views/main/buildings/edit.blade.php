@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-leaflet')
  @include('main.scripts.css-create')
@endsection

@section('contentheader_title')
  Buildings
@endsection

@section('main-content')
  <div class="row">
    <div class="col-md-5">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Edit Building</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          {!! Form::model($building,['method' => 'PATCH','url'=>['buildings',$building->id]]) !!}
            
            <div class="form-group col-md-9">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
            </div>

            <div class="form-group col-md-3">
              {!! Form::label('height', 'Height') !!}
              {!! Form::text('height', null, ['class' => 'form-control', 'id' => 'height', 'maxlength' => '4', 'size' => '4' ]) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '11']) !!}
            </div>

            <div class="form-group col-md-6">
            {!! Form::label('polygon', 'Coordinates') !!}
            {!! Form::textarea('polygon', null, ['id' => 'resultarea', 'class' => 'form-control', 'rows' => '11', 'readonly']) !!}
            </div> 

            <div class="form-group col-md-4">
              {!! Form::label('roofcolor', 'Roof Color') !!}
              {!! Form::text('roofcolor', null, ['class' => 'form-control my-colorpicker1', 'placeholder' => '#ff8000']) !!}
            </div> 

            <div class="form-group col-md-4">
              {!! Form::label('wallcolor', 'Wall Color') !!}
              {!! Form::text('wallcolor', null, ['class' => 'form-control my-colorpicker1', 'placeholder' => '#ff0000']) !!}
            </div>

            <div class="form-group col-md-4">
              {!! Form::label('image', 'Image Name') !!}
              <div class="input-group">
                {!! Form::text('image', null, ['class' => 'form-control', 'placeholder' => 'building-name']) !!}
                <div class="input-group-addon">.jpg</div>
              </div>
            </div> 

        </div><!-- /.box-body -->

        <div class="box-footer">
          <a href="{{{ URL::previous() }}}" type="button" class="btn btn-default">Cancel</a>
          {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        </div>
  
      </div><!-- /.box -->

    </div>

    <div class="col-md-7">

      <!-- <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        You cannot edit the building polygon after this, make sure you do this seriously.      
      </div> -->

      <div id="map-canvas" class="box box-solid"></div>
    </div>

  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.js-leaflet')
  @include('main.scripts.js-create')

  <script>

  //color picker with addon
  $(".my-colorpicker1").colorpicker();

  // create map engine 
    var map = new L.Map('map-canvas');
    map.setView([8.241354685854704, 124.24403356388211], 17, false);

    new L.TileLayer('http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png', {
      attribution: 'Map tiles &copy; <a href="http://mapbox.com">MapBox</a>'
    }).addTo(map);

    function style(feature) {
      return {
        weight: 2,
        color: '#222D32',
        fillOpacity: 0.8,
        fillColor: '#00A65A'
      };
    }

    var geojson = null;
    var featureGroup = L.featureGroup().addTo(map);
    //convert string to array
    function convertToArray(string){
      var array = JSON.parse("" + string +"");
      return array;
    }
    var valid = JSON.stringify(geojson);

    var idpath = window.location.pathname.split('/');
    var id = idpath[2];
    console.log(id);

    $(function(){

      $.ajax({
      type: 'GET',
      dataType: 'JSON',
      url: '/buildingdata/' +id,
      success: function(building){
        
        console.log(building);
        // console.log('success', building);
        var features;

            //console.log(building);
            //add if stand alone
            features = {
                type: "Feature", 
                geometry: {
                  type: "Polygon",
                  coordinates: convertToArray(building.polygon)
                },
                properties: {
                  id:  building.id,
                  name:  building.name,
                  roofColor: building.roofcolor,
                  height: building.height,
                  wallColor: building.wallcolor
                }
            }
        //add if all data
        geojson = {
          type: "FeatureCollection", 
          features: features
        }

        console.log(geojson);
        // SHOW BUILDINGS
        //geojsonLayer = L.geoJson(features, {style:style,onEachFeature:onEachFeature}).addTo(featureGroup);
        L.geoJson(features, {
          onEachFeature: function (feature, layer) {
            featureGroup.addLayer(layer);
          }
        });

        } 
      });
    }); //end strictly add


    var drawControl = new L.Control.Draw({
      draw: {
        position: 'topright',
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
        featureGroup: featureGroup
      }
    }).addTo(map);

    map.on('draw:edited', function (e) {
      var layers = e.layers;
      layers.eachLayer(function (layer) {
        if (layer instanceof L.Polyline) {
          coordinates = [];
          latlngs = layer.getLatLngs();
          for (var i = 0; i < latlngs.length; i++) {
            coordinates.push([latlngs[i].lng, latlngs[i].lat])
          }

          coordinates.splice((latlngs.length + 1), 0, [latlngs[0].lng, latlngs[0].lat]); 

          var coordinates_result = JSON.stringify(coordinates, null, 4);

          var final_result = "&#91" + coordinates_result +  "&#93";

          document.getElementById("resultarea").innerHTML = final_result;
        }
      });
    });

  </script>
  
@endsection