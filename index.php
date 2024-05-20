<?php
require 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <title>PRAKERIN</title>
</head>
<body>
<div class="navbar">
        <a href="edit_profile.php">Edit Profil</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="info">
    <h1>Welcome to the Home Page</h1>
    <p>Hello, <?php echo htmlspecialchars($user['username']); ?>!</p>
    </div>
</body>
</html>
