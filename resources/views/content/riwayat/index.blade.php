@extends('layouts/main')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Riwayat Absensi</h3>
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
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card p-4">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
          <button type="button" class="btn btn-primary btn-sm my-auto font-weight-bold " data-toggle="modal" data-target="#filterModal"><i class="ti-filter mr-2"></i>Filter berdasarkan</button>
        </div>
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Hari, Tanggal</th>
              <th scope="col">Pukul</th>
              <th scope="col">Pengabsen</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @if ($absen[0] == null)
              <tr>
                <td colspan="5" class="text-center">Belum ada riwayat absen</td>
              </tr>
            @else
              @foreach ($absen as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td> {{ $item->created_at->format('l, d F Y') }} </td>
                <td> {{ $item->created_at->format('H:i:s') }} </td>
                <td>{{ $item->admin->name }}</td>
                <td class="font-weight-bold">{{ $item->status }}</td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        <div class="d-flex">
          <div class=" mt-3 mx-auto">
            {{ $absen->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Filter  -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content px-3">
      <div class="d-flex justify-content-between px-2 my-3">
        <h4 class="text-muted mt-4">Filter Riwayat Absensi</h4>
        <button type="button" class="close mt-3 mr-2 " data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/filter">
        @csrf
        <div class="modal-body d-flex flex-column">
          <div class="form-group">
            <label for="bulan">Bulan</label>
            <select id="bulan" name="bulan" class="form-control" required>
              <option selected hidden disabled>--Pilih Bulan--</option>
              @if (date('n') >= 1 && date('n') <= 6)
                <option value="1">Januari</option>
                <option value="2">Febuari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
              @else
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              @endif
            </select>
          </div>
        </div>
        <div class="modal-footer mx-auto mb-4">
          <button type="submit" class="btn btn-dark">Filter Absensi</button>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Kembali</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection