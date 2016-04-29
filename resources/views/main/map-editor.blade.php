@extends('layouts.app')

@section('added-css-scripts')
	@include('main.scripts.css-glscripts')
  @include('main.scripts.css-editgl')
@endsection

@section('contentheader_title')
	Map Editor
@endsection

@section('main-content')
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
            
            {!! Form::open(['url' => 'main/map-editor']) !!}
          
              <div class="form-group col-md-9 {{ $errors->has('building-name') ? 'has-error' : ''}}">
              {!! Form::label('building-name', 'Name: ') !!}
                {!! Form::text('building-name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name']) !!}
                {!! $errors->first('building-name', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group col-md-3 {{ $errors->has('building-height') ? 'has-error' : ''}}">
              {!! Form::label('building-height', 'Height: ') !!}
                {!! Form::text('building-height', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name', 'maxlength' => '4', 'size' => '4' ]) !!}
                {!! $errors->first('building-height', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group col-md-6 {{ $errors->has('wall-color') ? 'has-error' : ''}}">
                {!! Form::label('wall-color', 'Wall Color: ') !!}
                <div class="input-group my-colorpicker2">
                  {!! Form::text('wall-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'wall-color', 'placeholder' => '#ff0000']) !!}
                  {!! $errors->first('wall-color', '<p class="help-block">:message</p>') !!}
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6 {{ $errors->has('roof-color') ? 'has-error' : ''}}">
                {!! Form::label('roof-color', 'Roof Color: ') !!}
                <div class="input-group my-colorpicker2">
                  {!! Form::text('roof-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'roof-color', 'placeholder' => '#ff8000', 'onkeypress' => 'setRoofColor(this)']) !!}
                  {!! $errors->first('roof-color', '<p class="help-block">:message</p>') !!}
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
              {!! Form::label('description', 'Description: ') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}   
              </div>     

              <div class="form-group col-md-12 {{ $errors->has('coordinates') ? 'has-error' : ''}}">
              {!! Form::label('coordinates', 'Coordinates: ') !!}
                {!! Form::textarea('coordinates', null, ['id' => 'resultarea', 'class' => 'form-control', 'required' => 'required', 'rows' => '5']) !!}
                {!! $errors->first('coordinates', '<p class="help-block">:message</p>') !!}       
              </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
          </div>
          {!! Form::close() !!}

          @if ($errors->any())
            <ul class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif

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
            
            {!! Form::open(['url' => 'main/map-editor']) !!}
          
              <div class="form-group col-md-9 {{ $errors->has('building-name') ? 'has-error' : ''}}">
              {!! Form::label('building-name', 'Name: ') !!}
                {!! Form::text('building-name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name']) !!}
                {!! $errors->first('building-name', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group col-md-3 {{ $errors->has('building-height') ? 'has-error' : ''}}">
              {!! Form::label('building-height', 'Height: ') !!}
                {!! Form::text('building-height', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'building-name', 'maxlength' => '4', 'size' => '4' ]) !!}
                {!! $errors->first('building-height', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group col-md-6 {{ $errors->has('wall-color') ? 'has-error' : ''}}">
                {!! Form::label('wall-color', 'Wall Color: ') !!}
                <div class="input-group my-colorpicker2">
                  {!! Form::text('wall-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'wall-color', 'placeholder' => '#ff0000']) !!}
                  {!! $errors->first('wall-color', '<p class="help-block">:message</p>') !!}
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6 {{ $errors->has('roof-color') ? 'has-error' : ''}}">
                {!! Form::label('roof-color', 'Roof Color: ') !!}
                <div class="input-group my-colorpicker2">
                  {!! Form::text('roof-color', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'roof-color', 'placeholder' => '#ff8000', 'onkeypress' => 'setRoofColor(this)']) !!}
                  {!! $errors->first('roof-color', '<p class="help-block">:message</p>') !!}
                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
              {!! Form::label('description', 'Description: ') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}   
              </div>     

              <div class="form-group col-md-12 {{ $errors->has('coordinates') ? 'has-error' : ''}}">
              {!! Form::label('coordinates', 'Coordinates: ') !!}
                {!! Form::textarea('coordinates', null, ['id' => 'resultarea', 'class' => 'form-control', 'required' => 'required', 'rows' => '5']) !!}
                {!! $errors->first('coordinates', '<p class="help-block">:message</p>') !!}       
              </div>  

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
          </div>
          {!! Form::close() !!}

          @if ($errors->any())
            <ul class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif

        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('added_js_scripts')
	@include('main.scripts.js-editgl')

  <script>
  
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

   // create map engine 
    var map = new L.Map('map-canvas');
    map.setView([8.241354685854704, 124.24403356388211], 17, false);

    new L.TileLayer('http://{s}.tiles.mapbox.com/v3/osmbuildings.kbpalbpk/{z}/{x}/{y}.png', {
      attribution: 'Map tiles &copy; <a href="http://mapbox.com">MapBox</a>'
    }).addTo(map);

    @include('main.back.partials.json-scripts')

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

    var selectedFeature = null;

    function zoomAndEditToFeature(e) {
      map.fitBounds(e.target.getBounds());
      if(selectedFeature)
          selectedFeature.editing.disable();
          selectedFeature = e.target;
          e.target.editing.enable();
    }

    function onEachFeature(feature, layer) {
      editableLayers.addLayer(layer);
      layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomAndEditToFeature
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

    var editableLayers = new L.FeatureGroup().addTo(map);
    // SHOW BUILDINGS
    geojsonLayer = L.geoJson(geojson, {style:style,onEachFeature:onEachFeature}).addTo(map);

  </script>
@endsection
