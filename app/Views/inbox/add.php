<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Pengajuan Surat &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex">
            <h1>Pengajuan Surat</h1>
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
                        Buat Pengajuan Baru
                    </div>
                </div>
                <div class="card-body col-md-4">
                    <form action="<?=site_url('inbox')?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Judul Surat</label>
                            <input type="text" name="email_inbox" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Tipe Surat</label>
                            <select name="tipe_inbox" class="custom-select" required>
                                <option selected value="">--Silahkan Pilih--</option>
                                <?php foreach ($tipe as $row) : ?>
                                <option value="<?= $row['id_tipe'] ?>"><?= $row['nama_tipe'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Surat</label>
                            <textarea name="deskripsi_inbox" class="form-control" placeholder="Max 50 Kata" maxlength="50" autofocus required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Upload File</label>
                            <div class="custom-file">
                            <input type="file" name="file_inbox" class="custom-file-input" id="file_inbox" accept=".doc, .docx, .pdf, .txt">
                                <label class="custom-file-label" for="file_inbox">Choose file (optional)</label>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i>
                                Kirim Permohonan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>

<script>
$(document).ready(function() {
    // When file input changes
    $('#file_inbox').on('change', function() {
        // Get the file name
        var fileName = $(this).val().split('\\').pop();

        // Set the label text to the file name
        $(this).next('.custom-file-label').text(fileName);
    });
});
</script>

<script>
function checkMaxLength(element) {
    if (element.value.length >= 50) {
        element.value = element.value.substring(0, 50);
        element.setAttribute('maxlength', '50');
    } else {
        element.removeAttribute('maxlength');
    }
}
</script>
<?= $this->endSection() ?>