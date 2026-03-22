<?php
require_once 'includes/helpers.php';
require_login();
$userId = (int)current_user()['id'];
$id = (int)($_GET['id'] ?? 0);
$stmt = $mysqli->prepare("DELETE FROM watchlists WHERE id = ? AND user_id = ?");
$stmt->bind_param('ii', $id, $userId);
$stmt->execute();
redirect_to('watchlist.php');
