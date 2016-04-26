<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show

  	@include('main.scripts.css-glscripts')  
</head>

<body class="skin-green sidebar-mini sidebar-collapse">
<div class="wrapper">

    <!-- <?php 
      $current_page = "home";
    ?> -->

<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/index') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Vir</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Virtual.ly</b></span>
    </a>

</header>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
    		<div id="map-canvas" class="box box-solid"></div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

@section('scripts')
    @include('layouts.partials.scripts')
@show

  @include('main.scripts.js-glscripts')  

</body>
</html>
