@extends('wali/layout')
@section('contentWali')
    {{-- Jumbotron --}}
    <div class="bg-image rounded-3 d-flex" style="
      background-image: url(../../template/images/carousel/banner_12.jpg);
      height: 600px;
      background-size: cover;
    ">
      <div class="container align-items-center my-auto">
        <h1 class="mb-3 font-weight-bold">Gali Potensimu <br> dengan E-Absen</h1>
        <h4 class="mb-3 font-weight-normal">Permudah pengelolan, dan pemantauan absen siswa di sekolah!</h4>
        <a class="btn btn-primary font-weight-bold" href="#!" role="button">Siswa/Guru</a>
        <a class="btn btn-dark font-weight-bold" href="#!" role="button">Wali Murid</a>
      </div>
    </div>
    {{-- End of Jumbotron --}}

  {{-- Section 1 --}}
  <div class="container py-5">
    <div class="row my-5">
      <div class="col-6">
        <h1 class="font-weight-bolder my-4">E-Absen</h1>
        <h4>Aplikasi <span class="text-warning">pengelolaan absensi</span> berbasis website, yang dapat digunakan untuk <span class="text-warning">absen</span>, serta pengelolaanya</h4>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum est beatae magnam ea nihil ab ducimus similique atque veritatis illo. Sunt ratione voluptates sint. Sunt, eius voluptates inventore earum nobis adipisci labore facilis deleniti libero impedit eligendi veniam excepturi modi praesentium fugiat? Asperiores, corporis consequatur aliquam officia esse et blanditiis ratione eos, sequi modi nesciunt repellendus soluta pariatur, natus quo reprehenderit eveniet doloremque dolorum sint vitae assumenda necessitatibus. Quam aperiam eveniet rem eum suscipit mollitia.</p>
      </div>
      <div class="col-6 d-flex">
        <img src="../../template/images/carousel/banner_3.jpg" alt="gambar sekolah" width="500px" class="mx-auto rounded">
      </div>
    </div>
  </div>
  {{-- End of Section 1 --}}
@endsection