@extends('layouts/main')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Detail Ruang Kelas</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card p-4">
        <div class="card-body">
          <p class="card-title">Data Wali Kelas {{ $kelas->kelas }}</p>
          @if ($guru == null)
            <div class="alert alert-danger d-flex" role="alert">
              <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
              <p class="ml-2 mt-2 font-weight-bold">Kelas belum memiliki Wali Kelas, silahkan ke menu <a href="/plotGuru" class="font-weight-bold">plot wali kelas</a> untuk memasukan Wali Kelas.</p>
            </div>
            <div class="flex">
              <a href="/ruang" class="btn btn-primary">Kembali</a>
            </div>
          @else
            <div class="row mb-3">
              <div class="col-md-4">
                @if (!asset('storage/' . $guru->foto) || $guru->foto == null)
                  <img src="../../template/images/profile.png" alt="profile" style="max-width: 100%; max-height: 100%; display:block;">                    
                @else
                  <img src="{{ asset('storage/' . $guru->foto) }}" alt="profile" class="rounded-circle" style="width: 300px; height: 300px; display:block; object-fit:cover">                    
                @endif
              </div>
              <div class="col-md-8 d-flex my-auto">
                <table class="table table-borderless table-responsive">
                  <tbody>
                    <tr>
                      <td>Nama Wali Kelas</td>
                      <td>:</td>
                      <td>{{ $guru->name }}</td>
                    </tr>
                    <tr>
                      <td>NIP</td>
                      <td>:</td>
                      <td>{{ $guru->nip }}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td>{{ $guru->email }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="flex">
              <a href="/ruang" class="btn btn-primary">Kembali</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card p-4">
        <div class="card-body">
          <p class="card-title">Daftar Siswa Kelas {{ $kelas->kelas }}</p>
          <div class="table-responsive">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Siswa</th>
                  <th scope="col">NIS</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
                @if ($murid[0] == null)
                  <div class="alert alert-danger d-flex" role="alert">
                    <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <p class="ml-2 mt-2 font-weight-bold">Kelas belum memiliki Siswa, silahkan ke menu <a href="/plotSiswa" class="font-weight-bold">plot siswa</a> untuk memasukan Siswa.</p>
                  </div>
                  <tr>
                    <td colspan="5" class="text-center">Kelas belum memiliki murid.</td>
                  </tr>
                @else
                  @foreach ($murid as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->nis }}</td>
                      @if ($item->gender == "L")
                        <td>Laki - Laki</td>
                      @else
                        <td>Perempuan</td> 
                      @endif
                      <td>{{ $item->email }}</td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex">
            <div class=" mt-3 mx-auto">
              {{ $murid->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div>
          <button type="button" class="close mt-4 mr-5 justify-content-end " data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex flex-column ">
          <img src="../../template/images/warning.png" width="90px" class="mx-auto" alt="warning">
          <br>
          <h3 class="text-center text-muted">Anda yakin akan menghapus akun ini?</h3>
        </div>
        <div class="modal-footer mx-auto mb-4">
          <form action="/admin/1" method="POST">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Ya, hapus</button>
          </form>
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak, Kembali</button>
        </div>
      </div>
    </div>
  </div>
@endsection