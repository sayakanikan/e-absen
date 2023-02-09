@extends('layouts/main')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Hai,  {{ auth()->user()->name }} !</h3>
          <div class="d-flex">
            <h6 class="font-weight-normal mb-0 mr-1">Selamat datang di aplikasi <span class="text-primary font-weight-bold">E-Absen</span>.</h6>
              @if (auth()->user()->role_id == 0)
                <h6>Anda sekarang di kelas <span class="text-primary">{{ $kelas->kelas->kelas }}</span></h6>
              @else
                <h6>Anda sekarang mengajar kelas <span class="text-primary">{{ $kelas->kelas->kelas }}</span></h6>
              @endif
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white" type="button" disabled>
               {{ date('l, d F Y') }} 
            </button>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Highlight Data untuk super Admin --}}
  @can('superAdmin')
    <div class="row">
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-lg-6 stretch-card transparent">
            <div class="card card-tale mr-4">
              <div class="card-body">
                <p class="mb-4">Total Murid</p>
                <p class="fs-30 mb-2"> {{ $jmlMurid }} Orang</p>
                {{-- <p>+ $dokumen30  dokumen (30 hari)</p> --}}
              </div>
            </div>
            <div class="card card-dark-blue mr-4">
              <div class="card-body">
                <p class="mb-4">Total Kelas</p>
                <p class="fs-30 mb-2"> {{ $jmlKelas }}  Kelas</p>
              </div>
            </div>
            <div class="card card-light-blue mr-4">
              <div class="card-body">
                <p class="mb-4">Total Wali Kelas</p>
                <p class="fs-30 mb-2"> {{ $jmlWalikelas }} Wali</p>
                {{-- @if ($backupnext == 'no')
                  <p>Next: Tidak Terjadwal!</p>
                @else
                  <p>Next:  $backupnext->format('d M Y') </p>
                @endif --}}
              </div>
            </div>
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Total Barcode</p>
                <p class="fs-30 mb-2"> {{ $jmlBarcode }} Barcode</p>
                {{-- <p>+ $download30  (30 hari)</p> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endcan
  {{-- Dashboard untuk Role Siswa --}}
  @can('user')
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between">
              <p class="card-title mb-3 ml-2">QR Code anda</p>
            </div>
            <img src="../../template/images/jateng.png" alt="QR siswa" width="200px" class="mx-auto my-3">
            <div class="d-flex">
              <button type="button" class="btn btn-success mt-2 mx-auto"><i class="ti-download"></i> &nbsp; Unduh QR code</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <p class="card-title mb-3 ml-2">Persen kehadiran semester ini</p>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Bulan</th>
                    <th>Kelas</th>
                    <th>Persen Kehadiran</th>
                  </tr>  
                </thead>
                <tbody>
                  @foreach ($bulan as $item)
                    <tr>
                      <td>{{ $item }}</td>
                      <td>{{ $kelas->kelas->kelas }}</td>
                      <td class="font-weight-bold">100%</td>
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
              <p class="card-title mb-3 ml-2">Absen Terakhir</p>
              <a class="text-info mb-3 ml-2" href="/riwayat">Lihat riwayat absen <i class="ti-arrow-right"></i></a>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Hari, Tanggal</th>
                    <th>Pukul</th>
                    <th>Diabsen oleh</th>
                    <th>Status</th>
                  </tr>  
                </thead>
                <tbody>
                  @foreach ($absen as $item)
                    <tr>
                      <td> {{ $loop->iteration }} </td>
                      <td> {{ $item->created_at->format('l, d F Y') }} </td>
                      <td> {{ $item->created_at->format('H:i:s') }} </td>
                      <td> {{ $item->admin->name }} </td>
                      <td class="font-weight-bold"> {{ $item->status }} </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endcan
@endsection