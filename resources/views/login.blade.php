<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <title>Espire - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/logo/favicon.ico">

    <!-- page css -->

    <!-- Core css -->
    <link href="/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="auth-full-height d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-2">
                                <div class="d-flex justify-content-center mt-3">
                                    {{-- <div class="text-center logo">
                                        <img alt="logo" class="img-fluid" src="/assets/images/logo/logo-fold.png" style="height: 70px;">
                                    </div> --}}
                                </div>
                                <div class="text-center mt-3">
                                    <h3 class="fw-bolder">Login</h3>
                                    <p class="text-muted">Login untuk melanjutkan</p>
                                </div>
                                <form class="form-horizontal mt-4" action="/login" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label">Username</label>
                                        <input class="form-control @error('username') is-invalid @enderror" name="username" autofocus required
                                            value="{{ old('username') }}" />
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="form-group input-affix flex-column">
                                            <label class="d-none">Password</label>
                                            <input class="form-control" name="password" type="password" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="/assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="/assets/js/app.min.js"></script>

</body>

</html>
