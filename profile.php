<?php
require_once 'includes/header.php';
require_login();
$u = current_user();
?>
<div class="form-wrap">
    <h2>User Profile</h2>
    <p><strong>Name:</strong> <?php echo e($u['name']); ?></p>
    <p><strong>Username:</strong> <?php echo e($u['username']); ?></p>
    <p><strong>Email:</strong> <?php echo e($u['email']); ?></p>
    <p><strong>Role:</strong> <?php echo e($u['role']); ?></p>
</div>
<?php require_once 'includes/footer.php'; ?>
