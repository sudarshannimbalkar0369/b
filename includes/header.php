<?php require_once __DIR__ . '/helpers.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MovieVerse</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<div class="bg-blob top"></div>
<div class="bg-blob bottom"></div>
<header class="main-header glass">
    <div class="brand-area">
        <img class="brand-logo" src="https://upload.wikimedia.org/wikipedia/commons/7/7a/Clapperboard.svg" alt="MovieVerse Logo">
        <h1>MovieVerse Recommendations</h1>
    </div>
    <nav>
        <a href="index.php">Movies</a>
        <a href="watchlist.php">Wishlist</a>
        <?php if (is_logged_in()): ?>
            <a href="profile.php">Profile</a>
            <?php if (is_admin()): ?><a href="admin_dashboard.php">Admin</a><?php endif; ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <div class="dropdown">
                <button class="btn">Login</button>
                <div class="dropdown-content">
                    <a href="login.php">User Login</a>
                    <a href="register.php">Register</a>
                    <a href="admin_login.php">Admin Login</a>
                </div>
            </div>
        <?php endif; ?>
    </nav>
</header>
<main>
