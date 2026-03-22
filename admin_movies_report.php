<?php
require_once 'includes/header.php';
require_admin();
$movies = $mysqli->query("SELECT m.*, u.username AS admin_name FROM movies m LEFT JOIN users u ON u.id=m.created_by ORDER BY m.id DESC");
?>
<section class="hero"><h2>Movies Report</h2><p>Full movies catalog with uploader details.</p></section>
<div class="table-wrap">
<table>
    <tr><th>ID</th><th>Title</th><th>Category</th><th>Year</th><th>Teaser</th><th>Added By</th><th>Date</th></tr>
    <?php while($m = $movies->fetch_assoc()): ?>
        <tr>
            <td><?php echo (int)$m['id']; ?></td>
            <td><?php echo e($m['title']); ?></td>
            <td><?php echo e($m['category']); ?></td>
            <td><?php echo e($m['release_year']); ?></td>
            <td><a href="<?php echo e($m['teaser_url']); ?>" target="_blank">View</a></td>
            <td><?php echo e($m['admin_name'] ?: 'Seed'); ?></td>
            <td><?php echo e($m['created_at']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</div>
<?php require_once 'includes/footer.php'; ?>
