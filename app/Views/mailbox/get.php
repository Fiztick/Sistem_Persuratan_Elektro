<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Semua Surat &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mailbox</h1>
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
                    Data Semua Surat
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Kode Surat</th>
                                <th>Judul Surat</th>
                                <th>Pemohon</th>
                                <th>Tipe Pengajuan</th>
                                <th>Deskripsi Pengajuan</th>
                                <th>File</th>
                                <th>Tanggal Surat Masuk</th>
                                <th>Status Pengajuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($mailbox as $value) : ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$value['id_inbox']?></td>
                                <td><?=$value['email_inbox']?></td>
                                <td><?=$value['nama_user']?> - <a href="mailto:<?=$value['email_user']?>?Subject=Some%20subject"><?=$value['email_user']?></a></td>
                                <td><?=$value['nama_tipe']?></td>
                                <td><?=$value['deskripsi_inbox']?></td>
                                <?php if (!empty($value['file_inbox'])): ?>
                                <td><a href="<?=site_url('download/'.$value['id_inbox'])?>"><i class="far fa-file fa-3x"
                                            style="color: #7a7a7a"></i></a></td>
                                <?php else: ?>
                                <td>Tidak ada file yang diupload</td>
                                <?php endif ?>
                                <td><?=date('d/m/Y', strtotime($value['tanggal_inbox']))?></td>
                                <td>
                                    <a href="#" class="fa fa-pencil-alt" data-toggle="modal"
                                        data-target="#status-modal<?=$value['id_inbox']?>">
                                        <?php
                                            // echo $value->status_inbox;
                                            $status_option = array('Pengajuan', 'Diproses', 'Diteruskan', 'Selesai Diambil di Jurusan', 'Selesai Diemail');
                                            echo $status_option[$value['status_inbox']];
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    <button href="" class="btn btn-danger m-2" data-toggle="modal"
                                        data-target="#delete-modal<?=$value['id_inbox']?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Update-->
                            <form action="<?=site_url('mailbox/'.$value['id_inbox'])?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="modal fade" id="status-modal<?=$value['id_inbox']?>" tabindex="-1"
                                    role="dialog" aria-labelledby="status-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="status-modalLabel">Ubah Status Pengajuan
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Dari Pemohon: </label>
                                                    <p><?= $value['nama_user'] ?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_inbox">Status Baru: </label>
                                                    <select class="custom-select" aria-label="Default select example"
                                                        name="status_inbox">
                                                        <?php 
                                                        foreach($status_option as $key => $opsi) :
                                                            if($key == $value['status_inbox']) {
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
                            <!-- end Modal Update -->

                            <!-- Modal Delete-->
                            <form action="<?=site_url('mailbox/'.$value['id_inbox'])?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="modal fade" id="delete-modal<?=$value['id_inbox']?>" tabindex="-1"
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
                                                    <label>Dari Pemohon: </label>
                                                    <p><?= $value['nama_user'] ?></p>
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