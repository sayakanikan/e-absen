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
              @can('user')
                <div class="col-md-4 my-auto mx-auto">
                  <img src="../../template/images/jateng.png" alt="QR" style="max-width: 125px; max-height: 125px; display:block; object-fit:cover" class="mx-auto mb-2">
                  <p class="font-weight-bold text-center">QR anda</p>
                </div>
              @endcan
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
              {{-- Jika admin/super admin maka input nip--}}
              @cannot('user')
                <div class="form-group col-md-6">
                  <label for="nip">NIP</label>
                  <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" value="{{ old('nip', $akun->nip) }}" required>
                  @error('nip')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              @endcannot
              {{-- Jika user maka input nis --}}
              @can('user')
                <div class="form-group col-md-6">
                  <label for="nis">NIS</label>
                  <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis" value="{{ old('nis', $akun->nis) }}" required>
                  @error('nis')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              @endcan
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
              @can('admin')
                  <div class="form-group col-md-6">
                    <label for="ruang">Ruang Kelas</label>
                    <select id="ruang" name="ruang" class="form-control" required>
                      <option selected hidden disabled>--Pilih Kelas--</option>
                      {{-- @foreach ($ruang as $item)
                        @if (old('kelas_id', $akun[0]->kelas_id) == $item->id)
                          <option value="{{ $item->id }}" selected>{{ $item->kelas }}</option>
                        @else
                          <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                        @endif
                      @endforeach --}}
                    </select>
                  </div>
              @endcan
              @can('user')
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
                <div class="form-group col-md-2">
                  <label for="lahir_ayah">Lahir ayah</label>
                  <input type="date" class="form-control @error('lahir_ayah') is-invalid @enderror" name="lahir_ayah" id="lahir_ayah" value="{{ old('lahir_ayah', $akun->lahir_ayah) }}" required>
                  @error('lahir_ayah')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group col-md-2">
                  <label for="lahir_ibu">Lahir ibu</label>
                  <input type="date" class="form-control @error('lahir_ibu') is-invalid @enderror" name="lahir_ibu" id="lahir_ibu" value="{{ old('lahir_ibu', $akun->lahir_ibu) }}" required>
                  @error('lahir_ibu')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              @endcan
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