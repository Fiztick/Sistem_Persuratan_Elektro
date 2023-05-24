<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login &mdash; Sistem Persuratan Elektro</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url()?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/template/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="<?= site_url() ?>/template/dist/img/pnj.png" alt="PNJ Logo" style="opacity: .8" width="130"
                    height="100" />
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="<?=base_url()?>/template/index3.html" method="post">
                    <div class="input-group mb-3">
                        <input type="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="row sm-gutters mb-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </form>
                <p class="mb-0">
                    Belum punya akun? 
                    <a href="register.html" class="text-center">Buat Akun</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?=base_url()?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/template/dist/js/adminlte.min.js"></script>
</body>

</html>