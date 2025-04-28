<?php
require_once '../includes/admin_check.php';
require_once '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['user_id']) || !isset($_POST['action'])) {
    header('Location: admin.php');
    exit();
}

$conn = connectDB();
$user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
$action = $_POST['action'];

try {
    if ($action === 'toggle_admin') {
        // Ne engedje a saját admin jogát elvenni
        if ($user_id == $_SESSION['user_id']) {
            $_SESSION['error'] = 'Nem veheted el a saját admin jogodat!';
            header('Location: admin.php');
            exit();
        }

        $stmt = $conn->prepare("
            UPDATE users 
            SET admin = NOT admin 
            WHERE id = :id
        ");
        $stmt->execute(['id' => $user_id]);
        
        $_SESSION['success'] = 'Admin státusz sikeresen módosítva!';
    } 
    elseif ($action === 'delete') {
        // Ne engedje törölni saját magát
        if ($user_id == $_SESSION['user_id']) {
            $_SESSION['error'] = 'Nem törölheted a saját fiókodat!';
            header('Location: admin.php');
            exit();
        }

        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        
        $_SESSION['success'] = 'Felhasználó sikeresen törölve!';
    }
} catch(PDOException $e) {
    $_SESSION['error'] = 'Hiba történt a művelet során!';
}

header('Location: admin.php');
exit();
