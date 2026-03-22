<?php
require_once 'includes/helpers.php';
require_login();
$userId = (int)current_user()['id'];
$movieId = (int)($_GET['movie_id'] ?? 0);
if ($movieId > 0) {
    $stmt = $mysqli->prepare("INSERT IGNORE INTO watchlists(user_id, movie_id) VALUES (?, ?)");
    $stmt->bind_param('ii', $userId, $movieId);
    $stmt->execute();
}
redirect_to('watchlist.php');
