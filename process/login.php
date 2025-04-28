<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: login.php");
    exit();
}

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
                $_SESSION['admin'] = $user['admin'];
                
                // Debug log
                error_log("Login successful - Session data:");
                error_log("Session ID: " . session_id());
                error_log("User ID: " . $_SESSION['user_id']);
                error_log("Email: " . $_SESSION['email']);
                error_log("Admin: " . $_SESSION['admin']);
                
                header("Location: index.php");
                exit();
            }
        }
        header("Location: login.php?error=1&attempted=1");
        exit();
    } catch(PDOException $e) {
        header("Location: login.php");
        exit();
    }
?>
