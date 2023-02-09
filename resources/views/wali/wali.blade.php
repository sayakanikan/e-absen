@extends('wali/layout')
@section('contentWali')
    {{-- <div class="row py-5">
      <div class="col-12">
        <h1 class="text-center font-weight-bold">Dashboard Wali Murid</h1>
      </div>
    </div> --}}
    <div class="bg-image rounded-3 d-flex mb-5" style="
      background: url(../../template/images/banner-ketik.jpg);
      height: 400px;
      background-size: cover;
    ">
      <div class="container align-items-center my-auto">
        <h1 class="mb-3 font-weight-bold text-white">Dashboard <br> Wali Murid</h1>
      </div>
    </div>

    @if (session()->has('error'))
    <div class="container pb-3">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex">
          <svg aria-hidden="true" class="ml-2 mt-1" style="width: 25px; height: 25px;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
          <p class="ml-2 mt-2 font-weight-bold">{{ session('error') }}</p>
        </div>
        <button type="button" class="close mt-2" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    @endif

    <div class="container pb-5">
      <div class="row ">
        <div class="col-6">
          <h3 class="font-weight-bold mb-3">Selamat Datang Wali Murid!</h3>
          <p class="font-weight-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum at eius vel cum magni alias iure odit distinctio quasi aliquam dolorem deserunt expedita enim rerum vero, rem quia sint adipisci laudantium doloremque libero voluptatum quos vitae repellat! Consectetur, eius. Quae, minus id. Praesentium perferendis ratione aperiam excepturi veniam sit aliquid tempore distinctio eveniet animi in, nisi deserunt rem, enim perspiciatis velit voluptatum atque, sed similique quaerat soluta vel nostrum? Ex veritatis accusamus nisi dolorem impedit.</p>
        </div>
        <div class="col-6">
          <h3 class="font-weight-bold mb-4">Pencarian murid</h3>
          <form action="/wali" method="POST">
            @csrf
            <div class="form-group">
              <label for="nis" class="font-weight-bold">Masukan NIS Murid</label>
              <input type="text" class="form-control form-control-sm" id="nis" placeholder="" name="nis" required>
            </div>
            <div class="form-group">
              <label for="tanggal" class="font-weight-bold">Masukan Tanggal Lahir Ayah/Ibu</label>
              <input type="date" class="form-control form-control-sm" id="tanggal" placeholder="Format(mm-dd-yyyy)" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> &nbsp; Cari</button>
          </form>
        </div>
      </div>
    </div>
@endsection