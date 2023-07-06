<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Inbox &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Inbox</h1>
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
                    Data Surat Masuk
                </div>
                <!-- Using DataTable -->
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
                        </tbody>
                    </table>
                </div>
                <!-- end using data table -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>

<script>
$.ajax({
    url: 'inbox/ajaxGetData', // URL to the ajaxGetData() method in the Inbox controller
    method: 'GET', // or 'POST' depending on your server-side implementation
    dataType: 'json',
    success: function(response) {
        // Initialize DataTable with fetched data
        $('#myTable').DataTable({
            data: response,
            columns: [{
                    data: null
                },
                {
                    data: 'id_inbox'
                },
                {
                    data: 'email_inbox'
                },
                {
                    data: 'nama_user'
                },
                {
                    data: 'nama_tipe'
                },
                {
                    data: 'deskripsi_inbox'
                },
                {
                    data: 'file_inbox'
                },
                {
                    data: 'tanggal_inbox'
                },
                {
                    data: 'nama_status'
                },
                {
                    data: null
                }
            ],
            columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Generate row numbers
                    }
                },
                {
                    targets: 9,
                    render: function(data, type, row) {
                        // Generate actions buttons
                        return '<button>Edit</button> <button>Delete</button>';
                    }
                }
            ]
        });
    },
    error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
    }
});
</script>

<?= $this->endSection() ?>