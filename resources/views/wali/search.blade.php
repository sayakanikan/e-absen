@extends('wali/layout')
@section('contentWali')
  <div class="rounded-3 d-flex mt-5">
    <div class="container align-items-center my-auto">
      <h2 class="mb-3 font-weight-bold text-center">Data Murid</h2>
    </div>
  </div>
  <div class="container py-5">
    <div class="row ">
      <div class="col-md-6 d-flex">
        <img src="../../template/images/jateng.png" alt="Foto murid" style="max-width: 50%; max-height: 75%;" class="m-auto">
      </div>
      <div class="col-md-6 d-flex flex-column my-auto">
        <table class="table table-borderless table-responsive">
          <tbody>
            <tr>
              <th>Nama</th>
              <td>:</td>
              <td>{{ $murid->name }}</td>
            </tr>          
            <tr>
              <th>NIS</th>
              <td>:</td>
              <td>{{ $murid->nis }}</td>
            </tr>
            <tr>
              <th>Jenis Kelamin</th>
              <td>:</td>
              @if ($murid->gender == "L")
                <td>Laki - laki</td>
              @else
                <td>Perempuan</td>
              @endif
            </tr>
            <tr>
              <th>Kelas</th>
              <td>:</td>
              <td>{{ $murid->kelas->kelas }}</td>
            </tr>
            <tr>
              <th>Wali Kelas</th>
              <td>:</td>
              <td>{{ $guru->name }}</td>
            </tr>
            <tr>
              <th>Persen kehadiran</th>
              <td>:</td>
              <td>100%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-12">
        <h3 class="mb-3">Presensi Semester ini</h3>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Bulan</th>
              <th scope="col">Hadir</th>
              <th scope="col">Tidak Hadir</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>September</td>
              <td>30 kali</td>
              <td>0 kali</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection