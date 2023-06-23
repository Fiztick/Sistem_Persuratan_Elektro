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
                        Simpan kode surat untuk melihat status surat
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?=site_url('home/pengajuan')?>">
                        <div class="form-group">
                            <label>Kode Surat</label> <br>
                            <span id="textToCopy" class="mr-2"><?= $id_surat ?></span>
                            <a class="btn btn-secondary" id="copyButton"><i class="fa fa-copy"></i></a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Kembali</button>
                        </div>
                    </form>

                    <div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-labelledby="copyModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="copyModalLabel">Kode Surat Telah di Simpan di Clipboard</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="copiedText"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>

<script>
// JavaScript code
const copyButton = document.getElementById('copyButton');
const textToCopy = document.getElementById('textToCopy');
const copiedText = document.getElementById('copiedText');

copyButton.addEventListener('click', function() {
    const range = document.createRange();
    range.selectNode(textToCopy);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
    copiedText.textContent = textToCopy.textContent;
    $('#copyModal').modal('show');
});

copyModal.addEventListener('hidden.bs.modal', function() {
    // Perform the routing action here
    window.location.href = '<?= site_url('home/pengajuan') ?>';
});
</script>
<script>
    let site = '<?= site_url('home/pengajuan') ?>';

$(document).ready(function(){
    if(session.getItem('id_surat')) {
        window.location.href = site;
    }
});

// $(document).ready(function() {
//     // Check if session value is not present
//     if (!sessionStorage.getItem('sessionValue')) {
//       // Redirect to another page
//       window.location.href = 'http://example.com/redirect-page';
//     }
//   });
</script>
<?= $this->endSection() ?>