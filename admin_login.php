<?php
require_once 'includes/header.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin' LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['user'] = $admin;
        redirect_to('admin_dashboard.php');
    } else {
        $error = 'Invalid admin credentials. Use adi@gmail.com / 123';
    }
}
?>
<div class="form-wrap">
    <h2>Admin Login</h2>
    <?php if ($error): ?><div class="alert error"><?php echo e($error); ?></div><?php endif; ?>
    <form method="POST">
        <label>Admin Email</label><input type="email" name="email" required>
        <label>Password</label><input type="password" name="password" required>
        <br><br>
        <button class="btn" type="submit">Login as Admin</button>
    </form>
</div>
<?php require_once 'includes/footer.php'; ?>
