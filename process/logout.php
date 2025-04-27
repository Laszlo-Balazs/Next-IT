<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = isset($_SERVER['HTTP_REFERER']) ? basename(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH)) : '';

// Töröljük a session-t
session_destroy();

// Ha chat-bot oldalról jövünk vagy nincs referer, akkor a login oldalra
if ($current_page == 'chat-bot.php' || empty($current_page)) {
    header("Location: /Next/login.php");
} else {
    // Egyébként maradunk az aktuális oldalon
    header("Location: /Next/" . $current_page);
}
exit();
?>
