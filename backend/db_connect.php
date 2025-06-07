<?php
$host = 'localhost';
$dbname = 'student_portal';
$username = 'root'; // Par défaut sur XAMPP
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée: " . $e->getMessage());
}
?>