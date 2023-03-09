<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/fontawesome.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/icheck-bootstrap.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/kit.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/admin') }}"><b>KIT</b>ERP</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ url(route('admin.login')) }}" method="post">
                    @csrf

                    @error('email')
                        <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    @error('password')
                        <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <div class="col-md-12 text-center mt-3">
                    <a href="{{ url(route('admin.register.form')) }}" class="text-center">Register a new membership</a>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('/assets/admin-assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/admin-assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('/assets/admin-assets/js/kit.js') }}"></script>
</body>

</html>
