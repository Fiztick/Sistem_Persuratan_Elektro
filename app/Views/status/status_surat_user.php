<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Surat &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Status Surat</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
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
                    Data Status Surat yang Terkirim
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode Surat</th>
                                    <th>Judul Surat</th>
                                    <th>Tipe Pengajuan</th>
                                    <th>Deskripsi Pengajuan</th>
                                    <th>Tanggal Surat Masuk</th>
                                    <th>Status Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($inbox as $value) : ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$value->id_inbox?></td>
                                    <td><?=$value->email_inbox?></td>
                                    <td><?=$value->nama_tipe?></td>
                                    <td><?=$value->deskripsi_inbox?></td>
                                    <td><?=date('d/m/Y', strtotime($value->tanggal_inbox))?></td>
                                    <td><?=$value->nama_status?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
<?= $this->endSection() ?>