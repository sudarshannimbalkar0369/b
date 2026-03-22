<?php
require_once 'includes/header.php';
require_admin();
$usersCount = $mysqli->query("SELECT COUNT(*) AS c FROM users")->fetch_assoc()['c'];
$moviesCount = $mysqli->query("SELECT COUNT(*) AS c FROM movies")->fetch_assoc()['c'];
$watchCount = $mysqli->query("SELECT COUNT(*) AS c FROM watchlists")->fetch_assoc()['c'];
?>
<section class="hero">
    <h2>Admin Dashboard</h2>
    <p>Manage movies, users and reports.</p>
    <div class="btn-row">
        <a class="btn-small primary" href="admin_add_movie.php">Add Movie</a>
        <a class="btn-small" href="admin_movies_report.php">Movies Report</a>
        <a class="btn-small" href="admin_users_report.php">Users Report</a>
        <a class="btn-small" href="admin_watchlist_report.php">Watchlist Report</a>
    </div>
</section>
<div class="grid">
    <article class="movie-card"><div class="movie-content"><h3>Total Users</h3><p><?php echo (int)$usersCount; ?></p></div></article>
    <article class="movie-card"><div class="movie-content"><h3>Total Movies</h3><p><?php echo (int)$moviesCount; ?></p></div></article>
    <article class="movie-card"><div class="movie-content"><h3>Total Watchlist Items</h3><p><?php echo (int)$watchCount; ?></p></div></article>
</div>
<?php require_once 'includes/footer.php'; ?>
