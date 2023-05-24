<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update Arsip &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a href="<?=site_url('inventory')?>" class="btn mr-2">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1>Arsip</h1>
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
                        Update Data Arsip
                    </div>
                </div>
                <div class="card-body col-md-4">
                    <form action="<?=site_url('inventory/update/0'.$inventory['id_inventory'])?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>No Surat</label>
                            <input type="text" name="no_surat" class="form-control" value="<?= $inventory['no_surat'] ?>" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Kode Surat</label>
                            <input type="number" name="kode_surat" class="form-control" maxLength="3" value="<?= $inventory['kode_surat'] ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Perihal Surat</label>
                            <textarea name="perihal_surat" class="form-control" autofocus><?= $inventory['perihal_surat'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" class="form-control" value="<?= $inventory['tanggal_surat'] ?>" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Terima</label>
                            <input type="date" name="tanggal_terima_surat" class="form-control" value="<?= $inventory['tanggal_terima_surat'] ?>" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Asal Surat</label>
                            <input type="text" name="asal_surat" class="form-control" value="<?= $inventory['asal_surat'] ?>" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Tindak Lanjut Surat</label>
                            <select name="tindak_lanjut" class="custom-select" required>
                            <?php 
                                $tindak_lanjut = array('Arsip', 'Diteruskan');
                                foreach($tindak_lanjut as $key => $opsi) :
                                    if($key == $inventory['tindak_lanjut']) {
                                        echo "<option selected value='".$key."'>".$opsi."</option>";
                                    } else {
                                        echo "<option value='".$key."'>".$opsi."</option>";
                                    }
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>


<?= $this->endSection() ?>