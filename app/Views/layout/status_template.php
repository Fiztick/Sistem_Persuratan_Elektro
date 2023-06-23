<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->renderSection('title') ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url()?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>/template/dist/css/adminlte.min.css">
    <!-- custom -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/spe.css">
</head>

<body class="hold-transition login-page">
    <div class="">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="<?= site_url() ?>/template/dist/img/pnj.png" alt="PNJ Logo" style="opacity: .8" width="130"
                    height="100" />
            </div>
            <div class="card-body">
                <?= $this->renderSection('content') ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?=base_url()?>/template/plugins/jquery/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/template/dist/js/adminlte.min.js"></script>
</body>

</html>