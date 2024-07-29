<?php
// Get the current URI
$requestUri = $_SERVER['REQUEST_URI'];

// Extract the current page from the URI
// Assuming the base URL is '/no_framework/'
// Remove the base URL and get the remaining part of the URI
$baseUrl = '/no_framework';
$currentPage = trim(str_replace($baseUrl, '', $requestUri), '/');

// Define valid pages for checking
$validPages = ['home', 'advertisements', 'user'];
if (!in_array($currentPage, $validPages)) {
    $currentPage = 'home'; // Default to 'home' if the current page is invalid
}
?>

<nav class="sidebar">
    <!-- Moving Between Pages -->
    <a href="/" class="<?= $currentPage === 'home' ? 'disabled' : '' ?>">
        <div class="sidebar-link <?= $currentPage === 'home' ? 'sidebar-link-this' : '' ?>">
            <img src="/public/images/icons/iconmonstr-home-6.svg" alt="Home">
            <div>Home</div>
        </div>
    </a>

    <a href="/advertisements" class="<?= $currentPage === 'advertisements' ? 'disabled' : '' ?>">
        <div class="sidebar-link <?= $currentPage === 'advertisements' ? 'sidebar-link-this' : '' ?>">
            <img src="/public/images/icons/explore.svg" alt="Explore Advertises">
            <div>Explore Advertises</div>
        </div>
    </a>

    <a href="/user" class="<?= $currentPage === 'user' ? 'disabled' : '' ?>">
        <div class="sidebar-link <?= $currentPage === 'user' ? 'sidebar-link-this' : '' ?>">
            <img src="/public/images/icons/iconmonstr-user-circle-thin.svg" alt="Explore Users">
            <div>Explore Users</div>
        </div>
    </a>

    <div class="bottom-aligner"></div>

    <!-- Showing creator -->
    <div class="creator">
        <p>Made by:</p> Hegedüs János
    </div>
</nav>
