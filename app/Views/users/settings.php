<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update User &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex">
            <h1>Pengaturan</h1>
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
                        Pengaturan Akun
                    </div>
                </div>
                <div class="card-body col-md-4">
                    <form action="<?=site_url('settings/'.$user['id_user'])?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" value="<?=$user['nama_user']?>" class="form-control"
                                required autofocus disabled>
                        </div>
                        <div class="form-group">
                            <label>Nomor Induk User</label>
                            <input type="number" value="<?=$user['nomor_induk_user']?>"
                                class="form-control" required autofocus disabled>
                        </div>
                        <div class="form-group">
                            <label>Email User</label>
                            <input type="text" value="<?=$user['email_user']?>"
                                class="form-control" required autofocus disabled>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password_user" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password Baru</label>
                            <input type="password" name="c_password_user" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Jabatan User</label>
                            <input type="text" class="form-control" value="<?=$user['role_user']?>" disabled autofocus>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
                                Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>


<?= $this->endSection() ?>