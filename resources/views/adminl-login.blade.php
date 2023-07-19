<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('agos.ico')}}" type="image/x-icon">
    <title>Authenticate</title>

    <script src="https://kit.fontawesome.com/03ec1819cd.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/login.js'])
</head>
<body>
    <section class="vh-100 bg-dark">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                  <h3 class="mb-5">Sign in</h3>

                  <form id="loginForm" method="post">
                    <div class="form-outline mb-4">
                        <input type="text" name="username" id="typeEmailX-2" class="form-control form-control-md" />
                        <label class="form-label" for="typeEmailX-2">User Name</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-md" />
                        <label class="form-label" for="typePasswordX-2">Password</label>
                    </div>

                    <button class="btn btn-success btn-md btn-block w-100" type="submit">Login</button>
                  </form>
                  <hr class="my-4">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>
