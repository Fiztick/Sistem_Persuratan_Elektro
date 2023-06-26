<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data User &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid d-flex">
        <h1>Users</h1>
        <a href="<?=site_url('user/add')?>" class="btn btn-primary ml-3">Add New</a>
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
                        Data User
                        <!-- <a href="" class="btn btn-primary">Add New</a> -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama User</th>
                                <th>NIP/NIM</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($users as $value) : ?>
                            <tr>
                                <td class="align-middle"><?=$i++?></td>
                                <td class="align-middle"><?=$value['nama_user']?></td>
                                <td class="align-middle"><?=$value['nomor_induk_user']?></td>
                                <td class="align-middle">
                                    <?php
                                        $jabatan = array('Admin', 'Tendik', 'Dosen', 'Mahasiswa');
                                        echo $jabatan[$value['id_role']]
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($value['status_user'] == 0) : ?>
                                        <button href="#" class="fa fa-pencil-alt btn-outline-secondary p-2" data-toggle="modal"
                                        data-target="#status-modal<?=$value['id_user']?>">
                                    <?php endif ?>
                                    <?php if($value['status_user'] == 1) : ?>
                                        <button href="#" class="fa fa-pencil-alt btn-outline-success p-2" data-toggle="modal"
                                        data-target="#status-modal<?=$value['id_user']?>">
                                    <?php endif ?>
                                    <?php
                                        // echo $value->status_inbox;
                                        $status_option = array('Nonaktif', 'Aktif');
                                        echo $status_option[$value['status_user']];
                                    ?>
                                    </button>
                                </td>
                                <td class="align-middle">
                                    <a href="<?=site_url('user/edit/'.$value['id_user'])?>" class="btn btn-primary m-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button href="" class="btn btn-danger m-2" data-toggle="modal"
                                        data-target="#delete-modal<?=$value['id_user']?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Update Status User-->
                            <form action="<?=site_url('user/updateStatus/'.$value['id_user'])?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="modal fade" id="status-modal<?=$value['id_user']?>" tabindex="-1"
                                    role="dialog" aria-labelledby="status-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="status-modalLabel">Ubah Status User
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <?php if($value['status_user'] == 0) : ?>
                                                    <label>Aktifkan akun dengan Nomor Induk: </label>
                                                    <?php endif ?>
                                                    <?php if($value['status_user'] == 1) : ?>
                                                    <label>Nonaktifkan akun dengan Nomor Induk: </label>
                                                    <?php endif ?>
                                                    <p><?= $value['nomor_induk_user'] ?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_user">Status Baru: </label>
                                                    <select class="custom-select" aria-label="Default select example"
                                                        name="status_user">
                                                        <?php 
                                                        foreach($status_option as $key => $opsi) :
                                                            if($key == $value['status_user']) {
                                                                echo "<option selected value='".$key."'>".$opsi."</option>";
                                                            } else {
                                                                echo "<option value='".$key."'>".$opsi."</option>";
                                                            }
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- end Modal Update Status User -->

                            <!-- Modal Delete-->
                            <form action="<?=site_url('user/'.$value['id_user'])?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="modal fade" id="delete-modal<?=$value['id_user']?>" tabindex="-1"
                                    role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete-modalLabel">Hapus Pengajuan
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Dengan NIM: </label>
                                                    <p><?= $value['nomor_induk_user'] ?></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- end Modal Delete -->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>


<?= $this->endSection() ?>