@extends('layouts.app')

@section('contentheader_title')
	Events
@endsection

@section('main-content')
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buildings</h3>
        </div><!-- /.box-header -->

        <div class="box-body" id="dvData">

          <table id="example" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>      
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
@endsection

@section('scripts-events')

	<!-- DATA TABLE -->
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/jquery.dataTables.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/dataTables.buttons.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/dataTables.select.min.js') }}"></script>

  <!-- DATA TABLE - BUTTONS -->
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/buttons.flash.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/buttons.html5.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/buttons.print.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/buttons.bootstrap.min.js') }}"></script>
  
  <!-- DATA TABLE - FUNCTIONS -->
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/jszip.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/pdfmake.min.js') }}"></script>
  <script type="text/javascript" language="javascript" src="{{ asset('/js/datatables/more/vfs_fonts.js') }}"></script>

  <script>
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            select: true,
            paging: false,
            lengthChange: false,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [
          {
              extend: 'copy',
              text: 'Copy',
              exportOptions: {
                  modifier: {
                      selected: true
                  }
              }
          },
          {
              extend: 'csv',
              text: 'CSV',
              exportOptions: {
                  modifier: {
                      selected: true
                  }
              }
          },
          {
              extend: 'pdf',
              text: 'PDF',
              exportOptions: {
                  modifier: {
                      selected: true
                  }
              }
          },
          {
              extend: 'print',
              text: 'Print',
              exportOptions: {
                  modifier: {
                      selected: true
                  }
              }
          }
      ],
      select: true
        } );
     
        table.buttons().container()
            .appendTo( '#example_wrapper .col-sm-6:eq(1)' );
    } );  
  </script>
@endsection