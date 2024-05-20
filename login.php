<?php

require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debugging: Cetak username dan password
    var_dump($username, $password);

    // Query SQL dengan nama kolom yang benar
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Debugging: Cetak hasil query
    var_dump($user);

    if ($user && password_verify($password, $user['pw'])) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <title>Login</title>
</head>
<body>
    <div class="info"><h4>| Login</h4></div>
    <div class="page">
    <form method="post" class="log-form">
    <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    </div>
</body>
</html>
