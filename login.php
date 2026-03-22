<?php
require_once 'includes/header.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE (email = ? OR username = ?) LIMIT 1");
    $stmt->bind_param('ss', $login, $login);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to('index.php');
    } else {
        $error = 'Invalid credentials.';
    }
}
?>
<div class="form-wrap">
    <h2>User Login</h2>
    <?php if ($error): ?><div class="alert error"><?php echo e($error); ?></div><?php endif; ?>
    <form method="POST">
        <label>Email or Username</label><input type="text" name="login" required>
        <label>Password</label><input type="password" name="password" required>
        <br><br>
        <button class="btn" type="submit">Login</button>
    </form>
</div>
<?php require_once 'includes/footer.php'; ?>
