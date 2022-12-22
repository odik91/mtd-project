<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('dashboard.index') }}" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-th-large"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Actions</span>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out mr-2"></i> Log out
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">---*---</a>
      </div>
    </li>
  </ul>
</nav>
