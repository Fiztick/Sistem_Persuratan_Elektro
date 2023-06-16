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

<form action="<?=site_url('register/proses')?>" method="post">
    <?= csrf_field() ?>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nama" name="nama" id="nama"
            value="<?= isset(session()->get('data')['nama']) ? session()->get('data')['nama'] : '' ?>" required>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="NIM/NIP" name="niu" id="niu"
            value="<?= isset(session()->get('data')['niu']) ? session()->get('data')['niu'] : '' ?>" minlength="10" required>
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
                <?= (isset(session()->get('data')['jabatan']) && session()->get('data')['jabatan'] == 1) ? 'selected' : '' ?>>
                Tendik</option>
            <option value="2"
                <?= (isset(session()->get('data')['jabatan']) && session()->get('data')['jabatan'] == 2) ? 'selected' : '' ?>>
                Dosen</option>
            <option value="3"
                <?= (isset(session()->get('data')['jabatan']) && session()->get('data')['jabatan'] == 3) ? 'selected' : '' ?>>
                Mahasiswa</option>
        </select>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
</form>
<p class="mb-0">
    Sudah punya akun?
    <a href="<?=site_url()?>" class="text-center">Login</a>
</p>
<?= $this->endSection() ?>