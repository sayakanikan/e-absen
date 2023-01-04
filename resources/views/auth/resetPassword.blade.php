<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>E-Absen | {{ $title }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../template/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../template/images/jateng.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper-auth d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo d-flex">
                <img src="../../template/images/jateng.png" class="m-auto" alt="logo">
              </div>
              <h4 class="text-center font-weight-bold mb-4">Ganti Password Akun Anda</h4>
              {{-- Alert Login Error --}}
              @if (session()->has('loginError'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="close mb-3" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              <form class="" method="POST" action="/updatepassword">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required autofocus value="{{ old('email') }}">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password Baru</label>
                  <input type="password" class="form-control form-control-lg @error('email') is-invalid @enderror" id="password" name="password" placeholder="Password Baru" required>
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-block btn-primary btn-rounded btn-lg font-weight-bold auth-form-btn mt-3">RESET PASSWORD</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../template/js/off-canvas.js"></script>
  <script src="../../template/js/hoverable-collapse.js"></script>
  <script src="../../template/js/template.js"></script>
  <script src="../../template/js/settings.js"></script>
  <script src="../../template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
