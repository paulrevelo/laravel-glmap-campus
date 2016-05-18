@extends('layouts.app')

@section('added-css-scripts')
  @include('main.scripts.css-database')  
@endsection

@section('contentheader_title')
	Buildings

@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buildings</h3>


          <div class="box-tools pull-right">

<!--           {!! Form::open(['method' => 'GET', 'class' => 'form navbar-form searchform']) !!}
             {!! Form::text('search', null,
                           array('required',
                                'class'=>'form-control',
                                'placeholder'=>'Missing route')) !!}
              {!! Form::submit('Search', ['class' => 'btn btn-success btn-flat']) !!}
          {!! Form::close() !!} -->
          
            <a href="{{url('/buildings/create')}}" class="btn btn-success btn-flat"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>Add New Building</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">

          <table id="buildings-table" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Height</th>
                <th>Roof Color</th>
                <th>Wall Color</th>
                <th>Polygon</th>
                <th>Floors</th>
                <th>Rooms</th>
                <th>Actions</th> 
                <th></th>               
              </tr>
            </thead>

            <tbody>
              @foreach($buildings as $building)
                  <tr>
                      <td style="width:50px;">{{ $building->id }}</td>
                      <td style="width:50px;"><img src="{{asset('img/buildings/'.$building->image.'.jpg')}}" height="35" width="30"></td>
                      <td style="width:300px;"><a href="{{ url('buildings', $building->id) }}">{{ $building->name }}</a></td>
                      <td>{{ $building->description }}</td>
                      <td style="width:50px;">{{ $building->height }}</td>
                      <td style="width:50px; background-color:{{ $building->roofcolor }};" title="{{ $building->roofcolor }}"></td>
                      <td style="width:50px; background-color:{{ $building->wallcolor }};" title="{{ $building->wallcolor }}"></td>
                      <td>{{ $building->polygon }}</td>
                      <td></td>
                      <td></td>
                      <td style="width:50px;"><a href="{{route('buildings.edit',$building->id)}}" class="btn btn-default btn-md"></i>Edit</a></td>
                      <td style="width:50px;">
                          {!! Form::open(['method' => 'DELETE', 'route'=>['buildings.destroy', $building->id]]) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-md']) !!}
                          {!! Form::close() !!}
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
@endsection

@section('added_js_scripts')
  @include('main.scripts.js-database')
  
  <script>
    $(function() {
      $('#buildings-table').DataTable({    
        responsive: true,
        ordering: true,
        searching: true,
        paging: true,
        autoWidth: false,
        "dom": '<"pull-left"f><"pull-right"l>tip',
        "columnDefs": [{
          "targets": [1,5,6,8,9],
          "orderable": false
          }]
      });
    });
  </script>
@endsection