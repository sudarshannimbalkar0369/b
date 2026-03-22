<?php
require_once __DIR__ . '/../db.php';

function current_user() {
    return $_SESSION['user'] ?? null;
}

function is_logged_in() {
    return isset($_SESSION['user']);
}

function is_admin() {
    return is_logged_in() && ($_SESSION['user']['role'] ?? 'user') === 'admin';
}

function redirect_to($url) {
    header("Location: $url");
    exit;
}

function require_login() {
    if (!is_logged_in()) {
        redirect_to('login.php');
    }
}

function require_admin() {
    if (!is_admin()) {
        redirect_to('admin_login.php');
    }
}

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
