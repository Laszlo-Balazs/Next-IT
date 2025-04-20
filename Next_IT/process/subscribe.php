<?php
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=invalid");
        exit();
    }
    
    try {
        $conn = connectDB();
        $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        
        if($stmt->execute()) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=success");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=error");
        }
    } catch(PDOException $e) {
        // If duplicate entry (email already subscribed)
        if($e->getCode() == 23000) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=exists");
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?subscribe=error");
        }
    }
    exit();
}

// If not POST request, redirect back
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
