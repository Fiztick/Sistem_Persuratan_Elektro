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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="align-middle" style="width: 10px">#</th>
                                    <th class="align-middle">Nama User</th>
                                    <th class="align-middle">NIP/NIM</th>
                                    <th class="align-middle">Email</th>
                                    <th class="align-middle">Jabatan</th>
                                    <th class="align-middle">Status</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($users as $value) : ?>
                                <tr>
                                    <td class="align-middle"><?=$i++?></td>
                                    <td class="align-middle"><?=$value->nama_user?></td>
                                    <td class="align-middle"><?=$value->nomor_induk_user?></td>
                                    <td class="align-middle"><?=$value->email_user?></td>
                                    <td class="align-middle"><?=$value->nama_role?></td>
                                    <td class="align-middle">
                                        <button href="#" data-toggle="modal" <?php if($value->status_user == 0) : ?>
                                            class="fa fa-pencil-alt btn-outline-secondary p-2"
                                            <?php elseif($value->status_user == 1) : ?>
                                            class="fa fa-pencil-alt btn-outline-success p-2" <?php endif ?>
                                            onclick="openModalEdit('<?=$value->id_user?>', '', '<?=$value->status_user?>', 2, false)">
                                            <?php
                                            $status_user = array('Nonaktif', 'Aktif');
                                            echo $status_user[$value->status_user];
                                        ?>
                                        </button>
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?=site_url('user/edit/'.$value->id_user)?>"
                                            class="btn btn-primary m-2">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button href="" class="btn btn-danger m-2" data-toggle="modal"
                                            onclick="openModalDelete('<?=$value->id_user?>', 3)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button href="" class="btn btn-warning m-2" data-toggle="modal"
                                            onclick="openModalResetPassword('<?=$value->id_user?>', '<?=$value->nomor_induk_user?>')">
                                            <i class="fas fa-refresh" style="color:white"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Update Status User-->
                    <form method="post" id="formUpdate">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="modal fade" id="status-modal" tabindex="-1" role="dialog"
                            aria-labelledby="status-modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="status-modalLabel">Ubah Status User
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="status_user">Status Baru: </label>
                                            <select class="custom-select" aria-label="Default select example"
                                                name="status_user" id="status">
                                                <?php 
                                                    foreach($status_user as $key => $opsi) :
                                                        echo "<option value='".$key."'>".$opsi."</option>";
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
                    <form method="post" id="formDelete">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog"
                            aria-labelledby="delete-modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-modalLabel">Hapus User
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Apakah Anda Yakin?</p>
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

                    <!-- Modal Reset Password-->
                    <form method="post" id="formReset">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <div class="modal fade" id="reset-modal" tabindex="-1" role="dialog"
                            aria-labelledby="reset-modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reset-modalLabel">Reset Password User
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <p>Apakah Anda Yakin?</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning" style="color:white">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end Modal Reset Password -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>


<?= $this->endSection() ?>