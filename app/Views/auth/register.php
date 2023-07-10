<?= $this->extend('layout/auth_template') ?>

<?= $this->section('title') ?>
<title>Register &mdash; Sistem Persuratan Elektro</title>
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

<p class="register-box-msg">Buat akun</p>
<form action="<?=site_url('register/proses')?>" method="post">
    <?= csrf_field() ?>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama"
            value="<?= isset(session()->get('data')['nama_user']) ? session()->get('data')['nama_user'] : '' ?>" required>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="NIM/NIP" name="niu" id="niu"
            value="<?= isset(session()->get('data')['nomor_induk_user']) ? session()->get('data')['nomor_induk_user'] : '' ?>" minlength="10" required>
    </div>
    <div class="input-group mb-3">
        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
            value="<?= isset(session()->get('data')['email_user']) ? session()->get('data')['email_user'] : '' ?>" minlength="10" required>
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" minlength="8" required>
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" minlength="8" id="cpassword"
            required>
    </div>
    <div class="input-group mb-3">
        <select class="custom-select" name="jabatan" required>
            <option value="">--Silahkan Pilih--</option>
            <option value="1"
                <?= (isset(session()->get('data')['id_role']) && session()->get('data')['id_role'] == 1) ? 'selected' : '' ?>>
                Tendik</option>
            <option value="2"
                <?= (isset(session()->get('data')['id_role']) && session()->get('data')['id_role'] == 2) ? 'selected' : '' ?>>
                Dosen</option>
            <option value="3"
                <?= (isset(session()->get('data')['id_role']) && session()->get('data')['id_role'] == 3) ? 'selected' : '' ?>>
                Mahasiswa</option>
        </select>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
</form>
<!-- <div class="mb-3">
    <a href="<?=site_url('pencarian-surat')?>" class="btn btn-primary btn-block">Progres Pengajuan Surat</a>
</div> -->
<p class="mb-0">
    Sudah punya akun?
    <a href="<?=site_url()?>" class="text-center">Login</a>
</p>
<?= $this->endSection() ?>