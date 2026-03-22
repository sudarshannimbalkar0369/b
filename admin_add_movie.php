<?php
require_once 'includes/header.php';
require_admin();
$msg = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $year = (int)($_POST['release_year'] ?? 0);
    $poster = trim($_POST['poster_url'] ?? '');
    $teaser = trim($_POST['teaser_url'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $adminId = (int)current_user()['id'];

    if (!$title || !$category) {
        $error = 'Title and category are required.';
    } else {
        $stmt = $mysqli->prepare("INSERT INTO movies(title, category, release_year, poster_url, teaser_url, description, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssisssi', $title, $category, $year, $poster, $teaser, $description, $adminId);
        if ($stmt->execute()) {
            $msg = 'Movie added successfully.';
        } else {
            $error = 'Failed to add movie.';
        }
    }
}
?>
<div class="form-wrap">
    <h2>Add Movie</h2>
    <?php if ($error): ?><div class="alert error"><?php echo e($error); ?></div><?php endif; ?>
    <?php if ($msg): ?><div class="alert ok"><?php echo e($msg); ?></div><?php endif; ?>
    <form method="POST">
        <label>Movie Title</label><input type="text" name="title" required>
        <label>Category</label>
        <select name="category" required>
            <option>Horror</option><option>Thriller</option><option>Romantic</option><option>Sci-Fi</option><option>Action</option><option>Comedy</option><option>Drama</option>
        </select>
        <label>Release Year</label><input type="number" name="release_year" value="2026">
        <label>Poster URL</label><input type="url" name="poster_url" placeholder="https://...">
        <label>Teaser URL (YouTube embed)</label><input type="url" name="teaser_url" placeholder="https://www.youtube.com/embed/...">
        <label>Description</label><textarea name="description"></textarea>
        <br><br>
        <button class="btn" type="submit">Save Movie</button>
    </form>
</div>
<?php require_once 'includes/footer.php'; ?>
