<?= $this->extend('layout/auth_template') ?>

<?= $this->section('title') ?>
<title>Pencarian Surat &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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



<p class="login-box-msg">Masukkan kode surat</p>
<form action="<?=site_url('status-surat')?>" method="post" autocomplete="off">
    <?= csrf_field() ?>
    <div class="form-group">
        <input type="text" name="id_inbox" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
            Cari Surat</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
<p class="mb-0">
    Sudah punya akun?
    <a href="<?=site_url()?>" class="text-center">Login</a>
</p>
<p class="mb-0">
    Belum punya akun?
    <a href="<?=site_url('register')?>" class="text-center">Buat Akun</a>
</p>
<?= $this->endSection() ?>