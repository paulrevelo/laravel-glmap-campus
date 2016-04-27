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
                <th><?php echo e(trans('front/event.name')); ?></th>
                <th><?php echo e(trans('front/event.description')); ?></th>
                <th><?php echo e(trans('front/event.location')); ?></th>
                <th><?php echo e(trans('front/event.date')); ?></th>      
                <th><?php echo e(trans('front/event.time')); ?></th>
              </tr>
            </thead>
            <tbody>      
              <?php echo $__env->make('main.back.event.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('added_js_scripts'); ?>
  <?php echo $__env->make('main.scripts.db-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>