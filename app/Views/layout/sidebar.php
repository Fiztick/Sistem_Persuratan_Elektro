<?php if (session()->get('jabatan') == 0) : ?>
<li class="nav-header">MAIN MENU</li>
<li class="nav-item">
    <a href="<?= site_url('home') ?>" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item" id="mailbox">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-envelope"></i>
        <p>
            Mailbox
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= site_url('inbox') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengajuan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('inventory') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Masuk</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">USER</li>
<li class="nav-item">
    <a href="<?= site_url('user') ?>" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Kelola User
        </p>
    </a>
</li>
<li class="nav-item">
<a href="<?= site_url('settings')?>" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Pengaturan Akun
        </p>
    </a>
</li>
<?php endif ?>

<?php if (session()->get('jabatan') > 0) : ?>
<li class="nav-header">MAIN MENU</li>
<li class="nav-item">
    <a href="<?= site_url('home') ?>" class="nav-link">
        <i class="nav-icon far fa-envelope"></i>
        <p>
            Pengajuan Surat
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('lihat-status') ?>" class="nav-link">
        <i class="nav-icon fas fa-spinner"></i>
        <p>
            Lihat Status Surat
        </p>
    </a>
</li>
<li class="nav-header">USER</li>
<li class="nav-item">
    <a href="<?= site_url('settings')?>" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Pengaturan Akun
        </p>
    </a>
</li>
<?php endif ?>

<script src="<?=base_url('/template/plugins/jquery/jquery-3.6.0.min.js') ?>" type="text/javascript"></script>
<script src="<?=base_url('/template/dist/js/sidebar.js') ?>" type="text/javascript"></script>