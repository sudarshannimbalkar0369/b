<?php
require_once 'includes/header.php';
require_admin();
$users = $mysqli->query("SELECT id, name, username, email, role, created_at FROM users ORDER BY id DESC");
?>
<section class="hero"><h2>User Details Report</h2><p>All registered users.</p></section>
<div class="table-wrap">
<table>
    <tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Role</th><th>Created</th></tr>
    <?php while($u = $users->fetch_assoc()): ?>
        <tr>
            <td><?php echo (int)$u['id']; ?></td>
            <td><?php echo e($u['name']); ?></td>
            <td><?php echo e($u['username']); ?></td>
            <td><?php echo e($u['email']); ?></td>
            <td><?php echo e($u['role']); ?></td>
            <td><?php echo e($u['created_at']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</div>
<?php require_once 'includes/footer.php'; ?>
