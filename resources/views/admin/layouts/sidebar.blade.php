<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('temp-adm/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('temp-adm/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ ucwords( Auth::user()->name) }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link {{ (isset($title) && $title == 'Dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header mt-2">PENGATURAN UTAMA</li>
        <li><hr class="bg-secondary mt-0"></li>
        <li class="nav-item">
          <a href="{{ route('main-settings.index') }}" class="nav-link {{ (isset($title) && $title == 'Pengaturan Halaman Utama') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Halam Utama 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tour-travel.index') }}" class="nav-link {{ (isset($title) && $title == 'Tour & Travel') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Tour & Travel 
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('oleh-oleh.index') }}" class="nav-link {{ (isset($title) && $title == 'Oleh-oleh') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Oleh-oleh
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('about.index') }}" class="nav-link {{ (isset($title) && $title == 'About') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              About
            </p>
          </a>
        </li>
        <li class="nav-header mt-2">HALAMAN TAMBAHAN</li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
