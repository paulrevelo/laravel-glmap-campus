<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

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
              <a href="{{ url('index') }}">
                <i class="fa fa-home fa-fw"></i>
                <span>Home</span>
              </a>
            </li>

            <li>
              <a href="{{ url('map-editor') }}">
                <i class="fa fa-map fa-fw"></i> 
                <span>Map Editor</span>
              </a>
            </li>

            <li>
              <a href="{{ url('events') }}">
                <i class="fa fa-bookmark fa-fw"></i> 
                <span>Events</span>
              </a>
            </li>

            <li>
              <a href="{{ url('about') }}">
                <i class="fa fa-user fa-fw"></i> 
                <span>About</span>
              </a>
            </li>

            <li>
              <a href="{{ url('settings') }}">
                <i class="fa fa-gears fa-fw"></i> 
                <span>Settings</span>
              </a>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
