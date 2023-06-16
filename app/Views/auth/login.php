<?= $this->extend('layout/auth_template') ?>

<?= $this->section('title') ?>
<title>Login &mdash; Sistem Persuratan Elektro</title>
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

<p class="login-box-msg">Sign in to start your session</p>
<form action="<?=site_url('auth/proses')?>" method="post">
    <?= csrf_field() ?>
    <div class="input-group mb-3">
        <input type="username" class="form-control" placeholder="NIM/NIP" name="username" id="username" required>
        <div class="input-group-append">
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
        <div class="input-group-append">
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
</form>
<p class="mb-0">
    Belum punya akun?
    <a href="<?=site_url('register')?>" class="text-center">Buat Akun</a>
</p>
<?= $this->endSection() ?>