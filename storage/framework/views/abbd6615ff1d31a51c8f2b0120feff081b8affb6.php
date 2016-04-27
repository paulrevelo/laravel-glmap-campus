<?php $__env->startSection('contentheader_title'); ?>
	Events
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="row">
    <div class="col-md-12">

      <!-- ADD MODAL -->
      <div class="modal fade" id="add-event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add New Building</h4>
            </div>
            <div class="modal-body row">
              
              <?php echo Form::open(['url' => 'main/events']); ?>

            
                <div class="form-group col-md-12 <?php echo e($errors->has('event-name') ? 'has-error' : ''); ?>">
                <?php echo Form::label('event-name', 'Name: '); ?>

                  <?php echo Form::text('event-name', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'event-name']); ?>

                  <?php echo $errors->first('event-name', '<p class="help-block">:message</p>'); ?>

                </div>

                <div class="form-group col-md-12 <?php echo e($errors->has('description') ? 'has-error' : ''); ?>">
                <?php echo Form::label('description', 'Description: '); ?>

                  <?php echo Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '5']); ?>

                  <?php echo $errors->first('description', '<p class="help-block">:message</p>'); ?>   
                </div> 

                <div class="form-group col-md-12 <?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
                <?php echo Form::label('location', 'Location: '); ?>

                  <?php echo Form::text('location', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'location']); ?>

                  <?php echo $errors->first('location', '<p class="help-block">:message</p>'); ?>

                </div>

                <div class="form-group col-md-12 <?php echo e($errors->has('schedule') ? 'has-error' : ''); ?>">
                <?php echo Form::label('schedule', 'Schedule: '); ?>

                  <?php echo Form::date('schedule', null, ['class' => 'form-control', 'required' => 'required']); ?>

                  <?php echo $errors->first('schedule', '<p class="help-block">:message</p>'); ?>

                </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <?php echo Form::submit('Add', ['class' => 'btn btn-primary']); ?>

            </div>
            <?php echo Form::close(); ?>


            <?php if($errors->any()): ?>
              <ul class="alert alert-danger">
                <?php foreach($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>

          </div>
        </div>
      </div>

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Events</h3>
          <div class="box-tools pull-right">
            <a data-toggle="modal" data-target="#add-event-modal" class="btn btn-success btn-flat"><i class="fa fa-plus fa-fw"></i>Add New Event</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">

          <table id="events-table" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Schedule</th>                
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
  <?php echo $__env->make('main.back.event.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>