<?php
require_once 'includes/header.php';
require_admin();
$sql = "SELECT w.id, u.username, u.email, m.title, m.category, w.created_at
        FROM watchlists w
        JOIN users u ON w.user_id = u.id
        JOIN movies m ON w.movie_id = m.id
        ORDER BY w.id DESC";
$rows = $mysqli->query($sql);
?>
<section class="hero"><h2>Watchlist Report</h2><p>Track what users are saving.</p></section>
<div class="table-wrap">
<table>
    <tr><th>ID</th><th>Username</th><th>Email</th><th>Movie</th><th>Category</th><th>Saved On</th></tr>
    <?php while($r = $rows->fetch_assoc()): ?>
        <tr>
            <td><?php echo (int)$r['id']; ?></td>
            <td><?php echo e($r['username']); ?></td>
            <td><?php echo e($r['email']); ?></td>
            <td><?php echo e($r['title']); ?></td>
            <td><?php echo e($r['category']); ?></td>
            <td><?php echo e($r['created_at']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</div>
<?php require_once 'includes/footer.php'; ?>
