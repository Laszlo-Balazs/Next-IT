<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO users (email, password, admin) VALUES (:email, :password, 0)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
        if($stmt->execute()) {
            header("Location: login.php?success=1");
            exit();
        }
    } catch(PDOException $e) {
        header("Location: registration.php?error=1");
        exit();
    }
}
?>
