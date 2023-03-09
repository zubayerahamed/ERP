<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Registration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/fontawesome.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/icheck-bootstrap.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/admin-assets/css/kit.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/admin') }}"><b>KIT</b>ERP</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ url(route('admin.register')) }}" method="post">
                    @csrf

                    @error('name')
                        <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Full name" value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    @error('email')
                        <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
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
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    @error('password_confirmation')
                        <div class="form-text text-danger"><i class="ph-x-circle me-1"></i>{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <div class="col-md-12 text-center mt-3">
                    <a href="{{ url(route('admin.login.form')) }}">I already have a membership</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('/assets/admin-assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/admin-assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('/assets/admin-assets/js/kit.js') }}"></script>
</body>

</html>
