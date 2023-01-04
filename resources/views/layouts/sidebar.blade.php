<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <a class="nav-link " href="/dashboard">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ Request::is('dokumen*') || Request::is('kategori*') || Request::is('filter*') || Request::is('searchKategori*') || Request::is('searchDokumen*') ? 'active' : '' }}">
      <a class="nav-link  d-flex align-middle justify-content-center" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon ti-archive mb-1"></i>
        <span class="menu-title">Arsip</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          @can('admin')
            <li class="nav-item"> <a class="nav-link" href="/kategori">Kategori</a></li>
          @endcan
          <li class="nav-item"> <a class="nav-link" href="/dokumen">Dokumen</a></li>
        </ul>
      </div>
    </li>
    @can('admin')
    <li class="nav-item {{ Request::is('admin/*') || Request::is('user/*') || Request::is('searchAdmin*') || Request::is('searchUser*') ? 'active' : '' }}">
      <a class="nav-link  d-flex align-middle justify-content-center" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-columns menu-icon ti-user mb-1"></i>
        <span class="menu-title">Kelola Akun</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin">Akun Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="/user">Akun User</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ Request::is('laporan') ? 'active' : '' }}">
      <a class="nav-link " href="/laporan">
        <i class="icon-paper menu-icon mb-1"></i>
        <span class="menu-title">Laporan</span>
      </a>
    </li>
    <li class="nav-item {{ Request::is('backup') ? 'active' : '' }}">
      <a class="nav-link " href="/backup">
        <i class="icon-paper menu-icon ti-server"></i>
        <span class="menu-title">Backup Database</span>
      </a>
    </li>
    @endcan
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
          {{-- <form method="POST" action="/logout" class="nav-item">
            @csrf
              <button type="submit" class="nav-link">
                Logout
              </button>
          </form> --}}
        </ul>
      </div>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Icons</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
        </ul>
      </div>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
        </ul>
      </div>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
        <i class="icon-ban menu-icon"></i>
        <span class="menu-title">Error pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="error">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
        </ul>
      </div>
    </li> --}}
    
  </ul>
</nav>