<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
$is_admin = isset($_SESSION['admin']) && $_SESSION['admin'] == 1;
$is_home = basename($_SERVER['PHP_SELF']) === 'index.php';

// Debug információk
echo "<!-- Debug info: \n";
echo "Session státusz: " . session_status() . "\n";
echo "Session ID: " . session_id() . "\n";
echo "Session tartalom: \n";
foreach ($_SESSION as $key => $value) {
    echo "$key: $value\n";
}
echo "Current page: " . $current_page . "\n";
echo "Is admin változó: " . ($is_admin ? 'true' : 'false') . "\n";
echo "-->";
?>

<div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
    <div class="nav-container w-container">
        <a href="/Next/index.php" class="brand w-nav-brand">
            <img src="/Next/images/Logo.png" loading="lazy" width="66" alt="" class="image">
        </a>
        <nav role="navigation" class="nav-menu w-clearfix w-nav-menu">
            <?php 
            $firstClassAdded = false;
            if (!$is_home): 
                $firstClassAdded = true;
            ?>
                <a href="/Next/index.php" class="nav-link left first w-nav-link">Főoldal</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id']) && $current_page != 'chat-bot.php'): ?>
                <a href="/Next/chat-bot.php" class="nav-link left <?php echo !$firstClassAdded ? 'first' : ''; ?> w-nav-link">Chat Bot</a>
                <?php $firstClassAdded = true; ?>
            <?php endif; ?>
            <?php if ($current_page != 'blog.php'): ?>
                <a href="/Next/blog.php" class="nav-link left <?php echo !$firstClassAdded ? 'first' : ''; ?> w-nav-link">Blog</a>
                <?php $firstClassAdded = true; ?>
            <?php endif; ?>
            <?php if ($current_page != 'kapcsolat.php'): ?>
                <a href="/Next/kapcsolat.php" class="nav-link left <?php echo !$firstClassAdded ? 'first' : ''; ?> w-nav-link">Kapcsolat</a>
                <?php $firstClassAdded = true; ?>
            <?php endif; ?>
            <?php if ($is_admin && $current_page != 'admin.php'): ?>
                <a href="/Next/admin.php" class="nav-link left <?php echo !$firstClassAdded ? 'first' : ''; ?> w-nav-link">Admin Panel</a>
            <?php endif; ?>
        </nav>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="/Next/process/logout.php" class="nav-link nav-button w-nav-link">Kijelentkezés</a>
        <?php else: ?>
            <a href="/Next/login.php" class="nav-link nav-button w-nav-link">Bejelentkezés</a>
        <?php endif; ?>
        <div class="menu-button w-nav-button">
            <div class="icon w-icon-nav-menu"></div>
        </div>
    </div>
</div>
