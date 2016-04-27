<?php $__env->startSection('contentheader_title'); ?>
	Events
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="row">
    <div class="col-md-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buildings</h3>
        </div><!-- /.box-header -->

        <div class="box-body">

          <table id="buildings-table" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>                
              </tr>
            </thead>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('added_js_scripts'); ?>
  <?php echo $__env->make('main.scripts.db-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('main.back.building.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>