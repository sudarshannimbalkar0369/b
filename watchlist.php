<?php
require_once 'includes/header.php';
require_login();
$userId = (int)current_user()['id'];
$sql = "SELECT w.id AS wid, m.* FROM watchlists w JOIN movies m ON m.id=w.movie_id WHERE w.user_id = $userId ORDER BY w.created_at DESC";
$rows = $mysqli->query($sql);
?>
<section class="hero">
    <h2>Your Watchlist</h2>
    <p>Movies you saved for later.</p>
</section>
<section class="grid">
    <?php while($movie = $rows->fetch_assoc()): ?>
        <article class="movie-card" data-category="<?php echo e($movie['category']); ?>">
            <img class="movie-img" src="<?php echo e($movie['poster_url']); ?>" alt="<?php echo e($movie['title']); ?>">
            <div class="movie-content">
                <h3><?php echo e($movie['title']); ?></h3>
                <div class="meta"><?php echo e($movie['category']); ?> • <?php echo e($movie['release_year']); ?></div>
                <div class="btn-row">
                    <button class="btn-small primary" data-teaser="<?php echo e($movie['teaser_url']); ?>">Watch Teaser</button>
                    <a class="btn-small danger" href="remove_watchlist.php?id=<?php echo (int)$movie['wid']; ?>">Remove</a>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</section>

<div class="teaser-modal" id="teaserModal">
    <div class="inner">
        <div class="btn-row" style="justify-content:flex-end;margin-bottom:8px;">
            <button class="btn-small danger" data-close-modal>Close</button>
        </div>
        <iframe id="teaserFrame" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
