<?php $__env->startSection('css-glmap'); ?>
  <link href="<?php echo e(asset('/css/map-styles.css')); ?>" rel="stylesheet" type="text/css" />

  <link rel='stylesheet prefetch' href='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.css'>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
	Index
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-glmap'); ?>
  <script src='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/GLMap/GLMap.js'></script>

  <script src='http://cdn.osmbuildings.org/OSMBuildings-GLMap-2.0.0/OSMBuildings/OSMBuildings-GLMap.js'></script>
      
  <script src="https://cdn.rawgit.com/tweenjs/tween.js/master/src/Tween.js"></script>

  <script src="<?php echo e(asset('/js/index2.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>