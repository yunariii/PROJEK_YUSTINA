<?php
$host = 'localhost';
$port = '5433';
$dbname = 'web1';
$user = 'postgres';
$password = 'qwerty';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}


?>