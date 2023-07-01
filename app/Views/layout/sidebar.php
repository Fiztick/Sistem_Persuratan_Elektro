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
                <p>Surat Masuk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('mailbox') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Selesai</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('inventory') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inventarisasi</p>
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

<script>
// Function to handle the state of the navigation items
function handleNavigationState() {
    // Retrieve the state from local storage
    const navState = JSON.parse(localStorage.getItem('navState')) || {};

    // Iterate over each navigation item
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach((navItem) => {
        const navItemId = navItem.getAttribute('id');
        const navItemState = navState[navItemId];

        // Check if the navigation item has a stored state
        if (navItemState) {
            // Add the 'menu-open' class to open the navigation item
            navItem.classList.add('menu-open');

            // Find the corresponding submenu and make it visible
            const subMenu = navItem.querySelector('.nav-treeview');
            subMenu.style.display = 'block';
        }
    });
}

// Function to store the state of the navigation items in local storage
function storeNavigationState() {
    const navState = {};

    // Iterate over each navigation item
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach((navItem) => {
        const navItemId = navItem.getAttribute('id');

        // Check if the navigation item is open
        if (navItem.classList.contains('menu-open')) {
            navState[navItemId] = true;
        }
    });

    // Store the state in local storage
    localStorage.setItem('navState', JSON.stringify(navState));
}

// Call the functions when the page finishes loading
window.addEventListener('load', handleNavigationState);
window.addEventListener('unload', storeNavigationState);
</script>

<script>
$(document).ready(function() {
    // Get the current URL
    var currentUrl = window.location.href;

    // Find the active nav link and add the 'active' class
    $('.nav-link').each(function() {
        var linkUrl = $(this).attr('href');

        if (currentUrl.includes(linkUrl)) {
            $(this).addClass('active');

            // If the active nav link is in a submenu, open the corresponding parent menu
            var parentMenu = $(this).closest('.nav-treeview').siblings('.nav-link');
            parentMenu.addClass('active');
            parentMenu.closest('.nav-item').addClass('menu-open');
        }
    });
});
</script>