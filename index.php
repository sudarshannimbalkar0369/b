<?php
require_once 'includes/header.php';
$movies = $mysqli->query("SELECT * FROM movies ORDER BY created_at DESC");
$categories = ['All', 'Horror', 'Thriller', 'Romantic', 'Sci-Fi', 'Action', 'Comedy', 'Drama'];
?>
<section class="hero">
    <h2>Discover Your Next Favorite Movie</h2>
    <p>High-energy recommendation interface with 3D animated movie cards and teaser previews.</p>
</section>

<div class="category-row">
    <?php foreach ($categories as $i => $cat): ?>
        <button class="category-btn <?php echo $i===0 ? 'active' : ''; ?>" data-category="<?php echo e($cat); ?>"><?php echo e($cat); ?></button>
    <?php endforeach; ?>
</div>

<section class="grid">
    <?php while($movie = $movies->fetch_assoc()): ?>
        <article class="movie-card" data-category="<?php echo e($movie['category']); ?>">
            <img class="movie-img" src="<?php echo e($movie['poster_url']); ?>" alt="<?php echo e($movie['title']); ?>">
            <div class="movie-content">
                <h3><?php echo e($movie['title']); ?></h3>
                <div class="meta"><?php echo e($movie['category']); ?> • <?php echo e($movie['release_year']); ?></div>
                <p><?php echo e($movie['description']); ?></p>
                <div class="btn-row">
                    <button class="btn-small primary" data-teaser="<?php echo e($movie['teaser_url']); ?>">Watch Teaser</button>
                    <?php if (is_logged_in()): ?>
                        <a class="btn-small" href="add_watchlist.php?movie_id=<?php echo (int)$movie['id']; ?>">Add to Watchlist</a>
                    <?php else: ?>
                        <a class="btn-small" href="login.php">Login to Save</a>
                    <?php endif; ?>
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
<button id="rightScroll" class="scroll-right-btn">➜</button>
<?php require_once 'includes/footer.php'; ?>
