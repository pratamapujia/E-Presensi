<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/icon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/auth.css') }}" />
  </head>

  <body>
    <script src="{{ asset('assets/admin/static/js/initTheme.js') }}"></script>
    <div id="auth">
      <div class="row justify-content-center ">
        <div class="col-lg-5 col-12 mt-5">
          <div id="auth-center">
            <h1 class="auth-title">Login Admin.</h1>
            @if (Session::get('pesan'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form action="/prosesLoginAdmin" method="POST" autocomplete="off">
              @csrf
              <div class="form-group position-relative mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required />
              </div>
              <div class="form-group position-relative mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required />
              </div>
              <div class="form-check form-check-lg d-flex align-items-end">
                <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" />
                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                  Keep me logged in
                </label>
              </div>
              <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                Log in
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>
