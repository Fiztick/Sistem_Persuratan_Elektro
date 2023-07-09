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
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="align-middle" style="width: 10px">#</th>
                                    <th class="align-middle">No Surat</th>
                                    <th class="align-middle">Kode Surat</th>
                                    <th class="align-middle">Perihal</th>
                                    <th class="align-middle">Tanggal Surat</th>
                                    <th class="align-middle">Tanggal Terima</th>
                                    <th class="align-middle">Asal Surat</th>
                                    <th class="align-middle">Tindak Lanjut</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($inventory as $value) : ?>
                                <tr>
                                    <td class="align-middle"><?=$i++?></td>
                                    <td class="align-middle"><?=$value->no_surat?></td>
                                    <td class="align-middle"><?=$value->kode_surat?></td>
                                    <td class="align-middle"><?=$value->perihal_surat?></td>
                                    <td class="align-middle"><?=date('d/m/Y', strtotime($value->tanggal_surat))?></td>
                                    <td class="align-middle"><?=date('d/m/Y', strtotime($value->tanggal_terima_surat))?>
                                    </td>
                                    <td class="align-middle"><?=$value->asal_surat?></td>
                                    <td class="align-middle">
                                        <?php
                                        $tindak_lanjut = array('Arsip', 'Diteruskan');
                                        echo $tindak_lanjut[$value->tindak_lanjut]
                                    ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?=site_url('inventory/edit/'.$value->id_inventory)?>"
                                            class="btn btn-primary m-2">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button href="" class="btn btn-danger m-2" data-toggle="modal"
                                            onclick="openModalDelete('<?=$value->id_inventory?>', 4)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Delete-->
                    <form method="post" id="formDelete">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog"
                            aria-labelledby="delete-modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delete-modalLabel">Hapus Surat
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
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>


<?= $this->endSection() ?>