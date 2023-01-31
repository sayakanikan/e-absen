<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <a class="nav-link " href="/dashboard">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @can('superAdmin')
      <li class="nav-item {{ Request::is('ruang*') || Request::is('filter*') || Request::is('searchRuang*') ? 'active' : '' }}">
        <a class="nav-link  d-flex align-middle justify-content-center" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon ti-folder mb-1"></i>
          <span class="menu-title">Data Kelas</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/ruang">Ruang Kelas</a></li>
          </ul>
        </div>
      </li>
    @endcan
    @can('superAdmin')
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
    @endcan
    @can('admin')
    <li class="nav-item {{ Request::is('laporan') ? 'active' : '' }}">
      <a class="nav-link " href="/laporan">
        <i class="icon-paper menu-icon mb-1"></i>
        <span class="menu-title">Laporan</span>
      </a>
    </li>
    @endcan
    <li class="nav-item {{ Request::is('riwayat') ? 'active' : '' }}">
      <a class="nav-link " href="/riwayat">
        <i class="icon-paper menu-icon mb-1"></i>
        <span class="menu-title">Riwayat Absen</span>
      </a>
    </li>
    {{-- <hr style="border: 1px solid #8e9aba; width:100%;"> --}}
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