@extends('layouts/main')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Edit Ruang Kelas</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body m-3">
          <form method="POST" action="/ruang/{{ $kelas->id }}">
            @method('put')
            @csrf
            <div class="form-group">
              <label for="kelas">Ruang Kelas</label>
              <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas', $kelas->kelas) }}" required>
              @error('kelas')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="jml_siswa">Jumlah Maksimal Siswa</label>
              <input type="number" class="form-control @error('jml_siswa') is-invalid @enderror" name="jml_siswa" id="jml_siswa" value="{{ old('jml_siswa', $kelas->jml_siswa) }}" required>
              @error('jml_siswa')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <a href="/ruang" type="submit" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-warning">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection