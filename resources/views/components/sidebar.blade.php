<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="@if(Auth::guard('web')->check()) {{ route('admin.dashboard') }} @else {{ route('masyarakat.dashboard') }} @endif">APPM</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="@if(Auth::guard('web')->check()) {{ route('admin.dashboard') }} @else {{ route('masyarakat.dashboard') }} @endif">APPM</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="nav-item @if(request()->is(request()->segment(2) == 'dashboard')) active @endif"><a href="@if(Auth::guard('web')->check()) {{ route('admin.dashboard') }} @else {{ route('masyarakat.dashboard') }} @endif" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Pengaduan</li>
      <li class="nav-item @if(request()->is( request()->segment(2) == 'pengaduan')) active @elseif(request()->is('*/pengaduan/*')) active @endif"><a href="@if(Auth::guard('web')->check()) {{ route('admin.pengaduan') }} @else {{ route('masyarakat.pengaduan') }} @endif" class="nav-link"><i class="fas fa-suitcase"></i><span>Pengaduan
        @role('admin|petugas')
        <p class="badge badge-danger">{{ count(\App\Models\Pengaduan::ditinjau()->get()) }}</p>
        @endrole
        </span></a></li>
      @role('admin|petugas')
      <li class="menu-header">Tanggapan</li>
      <li class="nav-item @if(request()->is( request()->segment(2) == 'tanggapan')) active @elseif(request()->is('*/tanggapan/*')) active @endif"><a href="{{ route('admin.tanggapan') }}" class="nav-link"><i class="fas fa-gavel"></i><span>Tanggapan</span></a></li>
      @endrole
      @role('admin')
      <li class="menu-header">Petugas & Masyarakat</li>
      <li class="nav-item @if(request()->is( request()->segment(2) == 'masyarakat')) active @elseif(request()->is('*/masyarakat/*')) active @endif"><a href="{{ route('admin.masyarakat') }}" class="nav-link"><i class="fas fa-users-cog"></i><span>Masyarakat</span></a></li>
      <li class="nav-item @if(request()->is( request()->segment(2) == 'petugas')) active @elseif(request()->is('*/petugas/*')) active @endif"><a href="{{ route('admin.petugas') }}" class="nav-link"><i class="fas fa-users"></i><span>Petugas</span></a></li>
    @endrole
    </ul>
 </aside>
