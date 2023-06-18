<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update User &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a href="<?=site_url('user')?>" class="btn mr-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1>Users</h1>
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
                        Update Data User
                    </div>
                </div>
                <div class="card-body col-md-4">
                    <form action="<?=site_url('user/0'.$user['id_user'])?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" name="nama_user" value="<?=$user['nama_user']?>" class="form-control"
                                required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Nomor Induk User</label>
                            <input type="number" name="nomor_induk_user" value="<?=$user['nomor_induk_user']?>"
                                class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Password User</label>
                            <input type="password" name="password_user" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password User</label>
                            <input type="password" name="c_password_user" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Jabatan User</label>
                            <select name="id_role" class="custom-select" required>
                                <?php 
                                $jabatan = array('Admin', 'Tendik', 'Dosen', 'Mahasiswa');
                                foreach($jabatan as $key => $opsi) :
                                    if($key == $user['id_role']) {
                                        echo "<option selected value='".$key."'>".$opsi."</option>";
                                    } else {
                                        echo "<option value='".$key."'>".$opsi."</option>";
                                    }
                                endforeach;
                                ?>
                            </select>
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