<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Lihat Status Surat &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex">
            <h1>Status Surat</h1>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

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

<!-- Main content -->
<div class="main-content">
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Lihat Status Surat
                    </div>
                </div>
                <div class="card-body d-flex align-items-center text-center">
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
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Pemohon
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col">Kode Surat</div>
                        <div class="col-xl-10">: <?=$inbox->id_inbox;?></div>
                        <div class="w-100"></div>
                        <div class="col">NIM/NIP</div>
                        <div class="col-xl-10">: <?=$inbox->nomor_induk_user;?></div>
                        <div class="w-100"></div>
                        <div class="col">Nama</div>
                        <div class="col-xl-10">: <?=$inbox->nama_user;?></div>
                        <div class="w-100"></div>
                        <div class="col">Jenis Surat</div>
                        <div class="col-xl-10">: <?=$inbox->nama_tipe;?></div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?= $this->endSection() ?>