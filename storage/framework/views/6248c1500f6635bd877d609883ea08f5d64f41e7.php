<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <?php $__env->startSection('htmlheader'); ?>
        <?php echo $__env->make('layouts.partials.htmlheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldSection(); ?>

  	<?php echo $__env->make('main.scripts.css-glscripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
</head>

<body class="skin-green sidebar-collapse">
  <div class="wrapper">

      <!-- <?php 
        $current_page = "home";
      ?> -->

  <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Vir</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Virtual.ly</b></span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
           <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-info-circle"></i></a>
              </li>

            </ul>
          </div> 
        </nav>

    </header>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

          <!-- Main content -->
          <section class="content">
              <!-- Your Page Content Here -->
      		<div id="map-canvas" class="box box-solid"></div>
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
       <?php echo $__env->make('layouts.partials.controlsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div><!-- ./wrapper -->

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('layouts.partials.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldSection(); ?>

  <?php echo $__env->make('main.scripts.js-glscripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  

</body>
</html>
