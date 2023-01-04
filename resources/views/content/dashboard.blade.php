@extends('layouts/main')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Hai,  $user->name !</h3>
          <h6 class="font-weight-normal mb-0">Selamat datang di aplikasi arsip digital. Anda sekarang adalah 
            {{-- @if ($user->role_id == 1)
              <span class="text-primary">admin!</span>
            @else
              <span class="text-primary">user!</span>
            @endif --}}
          </h6>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white" type="button" disabled>
               $tgl 
            </button>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        <div class="col-lg-6 stretch-card transparent">
          <div class="card card-tale mr-4">
            <div class="card-body">
              <p class="mb-4">Dokumen Arsip</p>
              <p class="fs-30 mb-2"> $jmlDokumen </p>
              <p>+ $dokumen30  dokumen (30 hari)</p>
            </div>
          </div>
          <div class="card card-dark-blue mr-4">
            <div class="card-body">
              <p class="mb-4">Kategori Dokumen</p>
              <p class="fs-30 mb-2"> $jmlKategori  Kategori</p>
            </div>
          </div>
          <div class="card card-light-blue mr-4">
            <div class="card-body">
              <p class="mb-4">Terakhir Backup Database</p>
              <p class="fs-30 mb-2"> $backup->created_at->format('d M Y') </p>
              {{-- @if ($backupnext == 'no')
                <p>Next: Tidak Terjadwal!</p>
              @else
                <p>Next:  $backupnext->format('d M Y') </p>
              @endif --}}
            </div>
          </div>
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">Total Download</p>
              <p class="fs-30 mb-2"> $jmlDownload </p>
              <p>+ $download30  (30 hari)</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
        <div class="d-flex justify-content-between">
          <p class="card-title">Penambahan Dokumen</p>
        </div>
          <p class="font-weight-500">Total penambahan dokumen arsip pada bulan ini, ditampilkan berdasarkan beberapa bulan terakhir.</p>
          <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
          <canvas id="sales-chart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Total Download Dokumen</p>
          <p class="font-weight-500 mb-5">Total download dokumen arsip yang dilakukan user pada bulan ini, ditampilkan berdasarkan 7 hari terakhir.</p>
          <canvas id="order-chart"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <p class="card-title mb-3 ml-2">Arsip terbaru</p>
            <a class="text-info mb-3 ml-2" href="/dokumen">Lihat semua arsip <i class="ti-arrow-right"></i></a>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Dokumen</th>
                  <th>Kategori</th>
                  <th>Kode Dokumen</th>
                  <th>Tanggal Ditambahkan</th>
                  <th>Diinput oleh</th>
                  <th>Aksi</th>
                </tr>  
              </thead>
              <tbody>
                @foreach ($dokumen as $item)
                  <tr>
                    <td> $loop->iteration </td>
                    <td> $item->nama </td>
                    <td class="font-weight-bold"> $item->kategori->kategori </td>
                    <td> $item->kode_dokumen </td>
                    <td> $item->created_at->format('d M Y') </td>
                    <td> $item->user->name </td>
                    <td class="font-weight-medium">
                      <a href="/dokumen/ $item->id " class="btn btn-primary btn-sm"><i class="ti-eye"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <p class="card-title mb-3 ml-2">Baru - baru ini didownload</p>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Dokumen</th>
                  <th>Tanggal Download</th>
                  <th>Didownload oleh</th>
                  <th>Keperluan</th>
                </tr>  
              </thead>
              <tbody>
                @foreach ($download as $item)
                  <tr>
                    <td> $loop->iteration </td>
                    <td> $item->dokumen->nama </td>
                    <td> $item->created_at->format('d M Y') </td>
                    <td class="font-weight-bold"> $item->user->name </td>
                    <td> $item->keperluan </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection