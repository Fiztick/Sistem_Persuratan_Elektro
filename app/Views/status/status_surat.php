<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Status Surat &mdash; Sistem Persuratan Elektro</title>

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
    <!-- /.login-logo -->
    <div class="card card-outline d-flex">
        <div class="card-header text-center">
            <img src="<?= site_url() ?>/template/dist/img/pnj.png" alt="PNJ Logo" style="opacity: .8" width="130"
                height="100" />
        </div>
        <?php if(session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success !</b>
                <?=session()->getFlashData('success'); ?>
            </div>
        </div>
        <?php endif ?>

        <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Error !</b>
                <?=session()->getFlashData('error'); ?>
            </div>
        </div>
        <?php endif ?>
        <div class="card-body">
            <p class="login-box-msg">Status surat</p>
            <div class="d-flex justify-content-center align-items-center text-center">
                <div class="line d-flex <?= ($inbox->status_inbox >= 0) ? 'success' : '' ?>"></div>
                <div
                    class="circle d-flex justify-content-center align-items-center <?= ($inbox->status_inbox >= 0) ? 'success' : '' ?>">
                    <label>Surat Diajukan</label>
                </div>
                <div class="line d-flex <?= ($inbox->status_inbox >= 1) ? 'success' : '' ?>"></div>
                <div
                    class="circle d-flex justify-content-center align-items-center <?= ($inbox->status_inbox >= 1) ? 'success' : '' ?>">
                    <label>Surat Diproses</label>
                </div>
                <div class="line d-flex <?= ($inbox->status_inbox >= 2) ? 'success' : '' ?>"></div>
                <div
                    class="circle d-flex justify-content-center align-items-center <?= ($inbox->status_inbox >= 2) ? 'success' : '' ?>">
                    <label>Diteruskan Ke Direktorat Terkait</label>
                </div>
                <div class="line d-flex <?= ($inbox->status_inbox >= 3) ? 'success' : '' ?>"></div>
                <div
                    class="circle d-flex justify-content-center align-items-center <?= ($inbox->status_inbox >= 3) ? 'success' : '' ?>">
                    <?php if ($inbox->status_inbox < 3) : ?>
                    <label>Selesai</label>
                    <?php elseif ($inbox->status_inbox == 3) : ?>
                    <label class="success">Di Ambil di Jurusan</label>
                    <?php elseif ($inbox->status_inbox == 4) : ?>
                    <label class="success">Di Email</label>
                    <?php endif; ?>
                </div>
                <div class="line d-flex <?= ($inbox->status_inbox >= 3) ? 'success' : '' ?>"></div>
            </div>
            <div class="divide"></div>
            <div class="card-body">
                <div class="card-header top">
                    <div class="d-flex justify-content-between">
                        Pemohon
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col">Kode Surat</div>
                        <div class="col-xl-10">: <?=$inbox->id_inbox;?></div>
                        <div class="w-100"></div>
                        <div class="col">Judul Surat</div>
                        <div class="col-xl-10">: <?=$inbox->email_inbox;?></div>
                        <div class="w-100"></div>
                        <div class="col">Jenis Surat</div>
                        <div class="col-xl-10">: <?=$inbox->nama_tipe;?></div>
                        <div class="w-100"></div>
                        <div class="col">NIM/NIP</div>
                        <div class="col-xl-10">: <?=$inbox->nomor_induk_user;?></div>
                        <div class="w-100"></div>
                        <div class="col">Nama</div>
                        <div class="col-xl-10">: <?=$inbox->nama_user;?></div>
                    </div>
                    <a href="<?=site_url('pencarian-surat')?>" class="btn btn-primary mt-3"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- jQuery -->
    <script src="<?=base_url()?>/template/plugins/jquery/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url()?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>/template/dist/js/adminlte.min.js"></script>
</body>

</html>