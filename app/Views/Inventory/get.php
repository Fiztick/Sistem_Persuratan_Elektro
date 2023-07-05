<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Arsip &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid d-flex">
        <h1>Arsip</h1>
        <a href="<?=site_url('inventory/add')?>" class="btn btn-primary ml-3">Add New</a>
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
                        Data Arsip
                        <!-- <a href="" class="btn btn-primary">Add New</a> -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>No Surat</th>
                                <th>Kode Surat</th>
                                <th>Perihal</th>
                                <th>Tanggal Surat</th>
                                <th>Tanggal Terima</th>
                                <th>Asal Surat</th>
                                <th>Tindak Lanjut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($inventory as $value) : ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$value['no_surat']?></td>
                                <td><?=$value['kode_surat']?></td>
                                <td><?=$value['perihal_surat']?></td>
                                <td><?=$value['tanggal_surat']?></td>
                                <td><?=$value['tanggal_terima_surat']?></td>
                                <td><?=$value['asal_surat']?></td>
                                <td>
                                    <?php
                                        $tindak_lanjut = array('Arsip', 'Diteruskan');
                                        echo $tindak_lanjut[$value['tindak_lanjut']]
                                    ?>
                                </td>
                                <td>
                                    <a href="<?=site_url('inventory/edit/'.$value['id_inventory'])?>"
                                        class="btn btn-primary m-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button href="" class="btn btn-danger m-2" data-toggle="modal"
                                        data-target="#delete-modal<?=$value['id_inventory']?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal Delete-->
                            <form action="<?=site_url('inventory/'.$value['id_inventory'])?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="modal fade" id="delete-modal<?=$value['id_inventory']?>" tabindex="-1"
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
                                                    <label>Dengan Nomor Surat: </label>
                                                    <p><?= $value['no_surat'] ?></p>
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