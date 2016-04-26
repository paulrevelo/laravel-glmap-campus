@extends('layouts.app')

@section('contentheader_title')
	About
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-solid">
        <div class="box-header">
          <h3 class="box-title">Add New Building</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          <form role="form">
            <div class="box-body">

              <div class="form-group">
              <label>Name</label>
                <input type="text" class="form-control" id="building-name" placeholder="Building Name">
              </div>

              <div class="form-group">
              <label>Height</label>
                <input type="text" class="form-control" id="building-height" maxlength="4" size="4" onkeypress="setHeight(this)" placeholder="100">
              </div>

              <div class="form-group">
                <label>Wall Color</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="wallColor" onkeypress="setWallColor(this)"
                  placeholder="#ff0000">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Roof Color</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" id="roofColor" onkeypress="setRoofColor(this)" placeholder="#ff8000">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

            </div>                
      <!-- /.box-body -->

			      <div class="box-footer">
			        <!-- <button type="submit" class="btn btn-success">Submit</button> -->
			      </div>
			    </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
@endsection