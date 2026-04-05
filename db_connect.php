<?php
// db_connect.php
// Put this file in the project root (same folder as your other php files)

$host = "127.0.0.1";
$db   = "g1";
$user = "root";
$pass = "#Sifat10919"; // your MySQL password
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // In dev you can show error; in production log instead.
    die("Database connection failed: " . $e->getMessage());
}
