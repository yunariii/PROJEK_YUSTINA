<?php
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, pw, email) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $email])) {
            $message = "Registrasi berhasil. <a href='login.php'>Login di sini</a>"; 
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23505) { // Kode kesalahan pelanggaran unik di PostgreSQL.
            $message = "Kesalahan: Username sudah ada. Silakan pilih username lain."; 
        } else {
            $message = "Kesalahan: " . $e->getMessage(); // Pesan kesalahan umum.
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <title>Login</title>
</head>
<body>
    <div class="info"><h4>| Register</h4></div>
    <div class="page">
    <form method="post" class="regis-form">
    <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <button type="submit">REGISTER</button>
    </form>
    </div>
    <div class="inf">
        <?php 
        if (!empty($message)) {
            echo $message;
        }
        ?>
    </div>
</body>
</html>
