<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <?php if(! Auth::guest()): ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo e(asset('/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p><?php echo e(Auth::user()->name); ?></p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        <?php endif; ?>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- <li class="header">HEADER</li> -->
            <!-- Optionally, you can add icons to the links -->
            <li>
              <a href="<?php echo e(url('index')); ?>">
                <i class="fa fa-home fa-fw"></i>
                <span>Home</span>
              </a>
            </li>

            <li>
              <a href="<?php echo e(url('map-editor')); ?>">
                <i class="fa fa-map fa-fw"></i> 
                <span>Map Editor</span>
              </a>
            </li>

            <li>
              <a href="<?php echo e(url('events')); ?>">
                <i class="fa fa-bookmark fa-fw"></i> 
                <span>Events</span>
              </a>
            </li>

            <li>
              <a href="<?php echo e(url('about')); ?>">
                <i class="fa fa-user fa-fw"></i> 
                <span>About</span>
              </a>
            </li>

            <li>
              <a href="<?php echo e(url('settings')); ?>">
                <i class="fa fa-gears fa-fw"></i> 
                <span>Settings</span>
              </a>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
