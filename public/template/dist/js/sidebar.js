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