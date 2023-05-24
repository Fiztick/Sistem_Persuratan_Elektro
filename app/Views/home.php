<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Home &mdash; Sistem Persuratan Elektro</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="main-content">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= esc($inbox_total) ?></h3>
                            <p>Total Surat yang Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-email"></i>
                        </div>
                        <a href="inbox" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h3><?= esc($inbox_diproses) ?></h3>

                            <p>Surat yang Diproses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-email-unread"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                        <h3><?= esc($inbox_selesai) ?></h3>

                            <p>Surat yang Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-email"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><h3><?= esc($users) ?></h3></h3>

                            <p>Jumlah User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div><!-- /.container-fluid -->
    </section>
</div>

<?= $this->endSection() ?>