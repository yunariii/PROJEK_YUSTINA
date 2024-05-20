<?php
require 'config.php';
session_start();

// Pastikan session username diset
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $newUsername = $_POST['new_username'];

    $stmt = $pdo->prepare("UPDATE users SET email = ?, username = ? WHERE username = ?");
    if ($stmt->execute([$email, $newUsername, $username])) {
        $_SESSION['username'] = $newUsername;
        echo "Profile updated successfully.";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    echo "Error: User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles2.css">
    <title>Edit Profile</title>
</head>
<body>
<div class="log">
    <a href="logout.php">Logout</a>
    </div>
    <p>| Welcome, <?php echo htmlspecialchars($user['username']); ?>!</p>
    <div class="page">
    <form method="post" class="edit-form">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        <label for="text">New Username:</label>
        <input type="text" name="new_username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
        <button type="submit">Update Profile</button>
    </form>
    </div>
</body>
</html>
