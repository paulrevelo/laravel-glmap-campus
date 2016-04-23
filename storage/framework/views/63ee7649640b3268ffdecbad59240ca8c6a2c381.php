<?php $__env->startSection('contentheader_title'); ?>
	Events
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Events</h3>
          <div class="box-tools pull-right">
            <a href="add-event.php" class="btn btn-success btn-flat"><i class="fa fa-plus fa-fw"></i>Add New Event</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body" id="dvData">

          <table id="example" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Date</th>      
                <th>Time</th>
              </tr>
            </thead>
            <tbody>      
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-events'); ?>

	<!-- DATA TABLE -->
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/dataTables.bootstrap.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/dataTables.buttons.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/dataTables.select.min.js')); ?>"></script>

  <!-- DATA TABLE - BUTTONS -->
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/buttons.flash.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/buttons.html5.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/buttons.print.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/buttons.bootstrap.min.js')); ?>"></script>
  
  <!-- DATA TABLE - FUNCTIONS -->
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/jszip.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/pdfmake.min.js')); ?>"></script>
  <script type="text/javascript" language="javascript" src="<?php echo e(asset('/js/datatables/more/vfs_fonts.js')); ?>"></script>

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>