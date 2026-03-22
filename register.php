<?php
require_once 'includes/header.php';
$msg = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$username || !$email || !$password) {
        $error = 'All fields are required.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';
        $stmt = $mysqli->prepare("INSERT INTO users(name, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sssss', $name, $username, $email, $hash, $role);
            if ($stmt->execute()) {
                $msg = 'Registration successful. You can login now.';
            } else {
                $error = 'Username or email may already exist.';
            }
        } else {
            $error = 'Server error.';
        }
    }
}
?>
<div class="form-wrap">
    <h2>User Register</h2>
    <?php if ($error): ?><div class="alert error"><?php echo e($error); ?></div><?php endif; ?>
    <?php if ($msg): ?><div class="alert ok"><?php echo e($msg); ?></div><?php endif; ?>
    <form method="POST">
        <label>Name</label><input type="text" name="name" required>
        <label>Username</label><input type="text" name="username" required>
        <label>Email</label><input type="email" name="email" required>
        <label>Password</label><input type="password" name="password" required>
        <br><br>
        <button class="btn" type="submit">Register</button>
    </form>
</div>
<?php require_once 'includes/footer.php'; ?>
