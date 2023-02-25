<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <a class="nav-link " href="/dashboard">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    @if(auth()->guard('admin')->check())
    <li class="nav-item {{ Request::is('ruang*') || Request::is('searchRuang*') ? 'active' : '' }}">
      <a class="nav-link " href="/ruang">
        <i class="icon-layout menu-icon ti-folder mb-1"></i>
        <span class="menu-title">Ruang Kelas</span>
      </a>
    </li>
    <li class="nav-item {{ Request::is('plotGuru*') || Request::is('plotSiswa*') ? 'active' : '' }}">
      <a class="nav-link  d-flex align-middle justify-content-center" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon ti-direction-alt mb-1"></i>
        <span class="menu-title">Plot Kelas</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/plotGuru">Wali Kelas</a></li>
          <li class="nav-item"> <a class="nav-link" href="/plotSiswa">Siswa</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ Request::is('wali*') || Request::is('siswa*') || Request::is('searchWali*') || Request::is('searchSiswa*') ? 'active' : '' }}">
      <a class="nav-link  d-flex align-middle justify-content-center" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-columns menu-icon ti-user mb-1"></i>
        <span class="menu-title">Semua Akun</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/walikelas">Akun Wali Kelas</a></li>
          <li class="nav-item"><a class="nav-link" href="/siswa">Akun Siswa</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ Request::is('absen*') ? 'active' : '' }}">
      <a class="nav-link " href="/absen">
        <i class="icon-paper menu-icon mb-1"></i>
        <span class="menu-title">Absen</span>
      </a>
    </li>
    <li class="nav-item {{ Request::is('riwayat') ? 'active' : '' }}">
      <a class="nav-link " href="/riwayat">
        <i class="icon-paper menu-icon mb-1"></i>
        <span class="menu-title">Riwayat Absen</span>
      </a>
    </li>
    <li class="nav-item {{ Request::is('laporan*') ? 'active' : '' }}">
      <a class="nav-link " href="/laporan">
        <i class="icon-paper menu-icon mb-1"></i>
        <span class="menu-title">Laporan</span>
      </a>
    </li>
    
    {{-- Riwayat Absen --}}
    @elseif(auth()->guard('web')->check())
      <li class="nav-item {{ Request::is('riwayat') ? 'active' : '' }}">
        <a class="nav-link " href="/riwayat">
          <i class="icon-paper menu-icon mb-1"></i>
          <span class="menu-title">Riwayat Absen</span>
        </a>
      </li>
    @endif
    
    {{-- Pengaturan Akun --}}
    <li class="nav-item {{ Request::is('akun') ? 'active' : '' }}">
      <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="icon-grid-2 menu-icon ti-settings mb-1"></i>
        <span class="menu-title">Akun Anda</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/akun">Profile</a></li>
          <li class="nav-item"> 
            <form action="/logout" method="POST" class="nav-link">
              @csrf
              <button type="submit" class="btn-link">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </li>
    
  </ul>
</nav>