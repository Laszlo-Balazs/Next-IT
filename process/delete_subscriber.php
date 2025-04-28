<?php
require_once '../includes/admin_check.php';
require_once '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['subscriber_id'])) {
    header('Location: admin.php');
    exit();
}

$conn = connectDB();
$subscriber_id = filter_var($_POST['subscriber_id'], FILTER_SANITIZE_NUMBER_INT);

try {
    $stmt = $conn->prepare("DELETE FROM newsletter_subscribers WHERE id = :id");
    $stmt->execute(['id' => $subscriber_id]);
    
    $_SESSION['success'] = 'Feliratkozó sikeresen törölve!';
} catch(PDOException $e) {
    $_SESSION['error'] = 'Hiba történt a törlés során!';
}

header('Location: admin.php');
exit();
