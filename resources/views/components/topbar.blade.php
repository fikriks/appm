<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="#" src="{{ asset('assets/img/avatar-1.png') }}" class="rounded-circle mr-1">
      @if(Auth::guard('web')->check())
      <div class="d-sm-none d-lg-inline-block">Hai, {{ ucfirst(strtok(Auth::user()->nama_petugas, " ")) }}</div>
      @else
      <div class="d-sm-none d-lg-inline-block">Hai, {{ ucfirst(strtok(Auth::guard('masyarakat')->user()->nama, " ")) }}</div>
      @endif
    </a>
      <div class="dropdown-menu dropdown-menu-right">
        @if(Auth::guard('web')->check())
        <div class="dropdown-title">Halo, {{ strtok(Auth::user()->nama_petugas, " ") }}</div>
        @else
        <div class="dropdown-title">Halo, {{ strtok(Auth::guard('masyarakat')->user()->nama, " ") }}</div>
        @endif
        <a href="{{ route('profiles') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profil
        </a>
        <div class="dropdown-divider"></div>
        <a href="@if(Auth::guard('web')->check()) {{ route('admin.logout') }} @else {{ route('masyarakat.logout') }} @endif" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="@if(Auth::guard('web')->check()) {{ route('admin.logout') }} @else {{ route('masyarakat.logout') }} @endif" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
    </li>
  </ul>
