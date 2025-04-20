<?php
session_start();
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    try {
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header("Location: ../chat-bot.php");
                exit();
            }
        }
        header("Location: ../login.php?error=1");
        exit();
    } catch(PDOException $e) {
        header("Location: ../login.php?error=2");
        exit();
    }
}
?>
