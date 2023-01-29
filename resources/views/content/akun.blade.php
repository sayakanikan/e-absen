@extends('layouts/main')

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Edit Akun Anda</h3>
        </div>
      </div>
    </div>
  </div>
  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="d-flex">
      <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
      <p class="ml-2 mt-2 font-weight-bold">{{ session('success') }}</p>
    </div>
    <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card p-4">
        <div class="card-body">
          <form action="/akun/{{ $akun->id }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row mb-3">
              <div class="col-md-2">
                {{-- <img src="{{ asset('storage/' . $foto) }}" alt="" style="max-width: 100%; max-height: 100%; display:block;"> --}}
                @if (!asset('storage/' . $foto) || $foto == null)
                  <img src="../../template/images/profile.png" alt="profile" style="max-width: 100%; max-height: 100%; display:block;">                    
                @else
                  <img src="{{ asset('storage/' . $foto) }}" alt="profile" class="rounded-circle" style="width: 150px; height: 150px; display:block; object-fit:cover">
                @endif
              </div>
              <div class="col-md-6 my-auto">
                <div class="custom-file form-group">
                  <input type="hidden" name="oldFoto" value="{{ $akun->foto }}">
                  <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" name="foto">
                  <label class="custom-file-label" for="foto">Pilih Foto</label>
                  @error('foto')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  <small id="passwordHelpBlock" class="form-text text-muted">
                    Foto profil anda dapat berformat jpg/png, dengan ukuran maksimal 2 mb.
                  </small>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $akun->name) }}" required>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="nip">NIP</label>
                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" value="{{ old('nip', $akun->nip) }}" required>
                @error('nip')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $akun->email) }}" required>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-2">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                  <option selected hidden disabled>--Pilih Gender--</option>
                    @if (old('gender', $akun->gender) == "L")
                      <option value="L" selected>Laki - laki</option>
                      <option value="P">Perempuan</option>
                    @else
                      <option value="L">Laki - laki</option>
                      <option value="P" selected>Perempuan</option>
                    @endif
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="telepon">No. Telepon</label>
                <input type="tel" class="form-control @error('telepon') is-invalid @enderror" name="telepon" id="telepon" value="{{ old('telepon', $akun->telepon) }}" required>
                @error('telepon')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat Lengkap</label>
              <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $akun->alamat) }}" required>
              @error('alamat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="alert alert-warning" role="alert">
              Isi kolom password jika anda ingin mengubahnya.
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="hidden" name="oldPassword" value="{{ $akun->password }}">
              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="passwordHelpBlock">
              <small id="passwordHelpBlock" class="form-text text-muted">
                Password harus berisi minimal 6 karakter, memiliki huruf dan angka, dan tidak boleh menggunakan simbol, atau emoji.
              </small>
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <a href="/dashboard" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection