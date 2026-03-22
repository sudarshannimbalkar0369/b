<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'movieverse';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$mysqli->query("CREATE DATABASE IF NOT EXISTS `$DB_NAME` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$mysqli->select_db($DB_NAME);

$schema = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(120) NOT NULL,
        username VARCHAR(80) NOT NULL UNIQUE,
        email VARCHAR(150) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin','user') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB",

    "CREATE TABLE IF NOT EXISTS movies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        category VARCHAR(80) NOT NULL,
        release_year INT DEFAULT NULL,
        poster_url VARCHAR(500) DEFAULT NULL,
        teaser_url VARCHAR(500) DEFAULT NULL,
        description TEXT,
        created_by INT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB",

    "CREATE TABLE IF NOT EXISTS watchlists (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        movie_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_user_movie (user_id, movie_id),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
    ) ENGINE=InnoDB"
];

foreach ($schema as $sql) {
    if (!$mysqli->query($sql)) {
        die('Schema error: ' . $mysqli->error);
    }
}

// Ensure admin
$adminEmail = 'adi@gmail.com';
$adminPassPlain = '123';
$adminPassHash = password_hash($adminPassPlain, PASSWORD_DEFAULT);
$checkAdmin = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
$checkAdmin->bind_param('s', $adminEmail);
$checkAdmin->execute();
$adminRes = $checkAdmin->get_result();
if ($adminRes->num_rows === 0) {
    $name = 'Admin';
    $username = 'adi_admin';
    $role = 'admin';
    $insertAdmin = $mysqli->prepare("INSERT INTO users(name, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $insertAdmin->bind_param('sssss', $name, $username, $adminEmail, $adminPassHash, $role);
    $insertAdmin->execute();
}

// Seed movies if empty
$countRes = $mysqli->query("SELECT COUNT(*) AS total FROM movies")->fetch_assoc();
if ((int)$countRes['total'] === 0) {
    $seedMovies = [
        ['Nebula Drift', 'Sci-Fi', 2024, 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba', 'https://www.youtube.com/embed/8ugaeA-nMTc', 'A pilot crosses wormholes to save Earth.'],
        ['Crimson Hall', 'Horror', 2023, 'https://images.unsplash.com/photo-1503095396549-807759245b35', 'https://www.youtube.com/embed/V6wWKNij_1M', 'A haunted mansion with a living memory.'],
        ['Midnight Chase', 'Thriller', 2025, 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c', 'https://www.youtube.com/embed/2-_-1nJf8Vg', 'A detective has 24 hours to stop a silent killer.'],
        ['Blue Heart', 'Romantic', 2022, 'https://images.unsplash.com/photo-1524985069026-dd778a71c7b4', 'https://www.youtube.com/embed/5PSNL1qE6VY', 'Two strangers reconnect by chance across cities.'],
        ['Quantum Punch', 'Action', 2024, 'https://images.unsplash.com/photo-1478720568477-152d9b164e26', 'https://www.youtube.com/embed/zSWdZVtXT7E', 'A fighter manipulates time in underground arenas.'],
        ['Laugh Terminal', 'Comedy', 2023, 'https://images.unsplash.com/photo-1536440136628-849c177e76a1', 'https://www.youtube.com/embed/t433PEQGErc', 'Airport chaos unites unlikely friends.'],
        ['Ashes of Dawn', 'Drama', 2025, 'https://images.unsplash.com/photo-1440404653325-ab127d49abc1', 'https://www.youtube.com/embed/6ZfuNTqbHE8', 'A family rebuilds after a citywide blackout.']
    ];

    $stmt = $mysqli->prepare("INSERT INTO movies(title, category, release_year, poster_url, teaser_url, description) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($seedMovies as $m) {
        $stmt->bind_param('ssisss', $m[0], $m[1], $m[2], $m[3], $m[4], $m[5]);
        $stmt->execute();
    }
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
