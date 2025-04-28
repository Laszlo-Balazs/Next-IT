<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: index.php");
    exit();
}
?>
