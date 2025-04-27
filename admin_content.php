<?php
defined('ADMIN_PAGE') or die('Direct access not permitted');

// Felhasználói statisztikák
$userStats = $conn->query("
    SELECT 
        COUNT(*) as total_users,
        COUNT(CASE WHEN admin = 1 THEN 1 END) as admin_users,
        COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 END) as new_users_30d
    FROM users
")->fetch(PDO::FETCH_ASSOC);

// Blog statisztikák
$blogStats = $conn->query("
    SELECT 
        COUNT(*) as total_posts,
        COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 END) as new_posts_30d
    FROM blog_posts
")->fetch(PDO::FETCH_ASSOC);

// Feliratkozói statisztikák
$subscriberStats = $conn->query("
    SELECT COUNT(*) as total_subscribers
    FROM newsletter_subscribers
")->fetch(PDO::FETCH_ASSOC);
?>

<div class="admin-header">
    <div>
        <h1>Admin Panel</h1>
        <h2>Üdvözöljük az irányítópulton!</h2>
    </div>
    <div class="header-actions">
        <span class="server-time"><?php echo date('Y-m-d H:i'); ?></span>
    </div>
</div>

<!-- Statisztikai kártyák -->
<div class="stats-container">
    <div class="stat-cards">
        <div class="stat-card">
            <h3><i class="fas fa-users"></i> Felhasználók</h3>
            <p>Összes: <span><?php echo $userStats['total_users']; ?></span></p>
            <p>Admin: <span><?php echo $userStats['admin_users']; ?></span></p>
            <p>Új (30 nap): <span><?php echo $userStats['new_users_30d']; ?></span></p>
        </div>
        <div class="stat-card">
            <h3><i class="fas fa-file-alt"></i> Blog Posztok</h3>
            <p>Összes: <span><?php echo $blogStats['total_posts']; ?></span></p>
            <p>Új (30 nap): <span><?php echo $blogStats['new_posts_30d']; ?></span></p>
        </div>
        <div class="stat-card">
            <h3><i class="fas fa-envelope"></i> Feliratkozók</h3>
            <p>Összes: <span><?php echo $subscriberStats['total_subscribers']; ?></span></p>
        </div>
    </div>
</div>

<!-- Gyors műveletek -->
<div class="quick-actions">
    <button onclick="location.href='#felhasznalok'" class="action-btn">
        <i class="fas fa-users"></i> Felhasználók
    </button>
    <button onclick="location.href='#blogok'" class="action-btn">
        <i class="fas fa-blog"></i> Blog
    </button>
    <button onclick="location.href='#feliratkozok'" class="action-btn">
        <i class="fas fa-envelope"></i> Feliratkozók
    </button>
</div>

<!-- Blog kezelés -->
<div id="blogok" class="section-header">
    <h2><i class="fas fa-blog"></i> Blog Kezelés</h2>
    <button onclick="toggleForm()" class="edit-btn">
        <i class="fas fa-plus"></i> Új Blog Post
    </button>
</div>

<!-- Blog posztok listája -->
<table class="admin-table">
    <thead>
        <tr>
            <th>Cím</th>
            <th>Szerző</th>
            <th>Thumbnail</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo htmlspecialchars($post['title']); ?></td>
            <td><?php echo htmlspecialchars($post['author_name']); ?></td>
            <td>
                <img src="<?php echo htmlspecialchars($post['thumbnail_path']); ?>" 
                     alt="Thumbnail" class="preview-image">
            </td>
            <td class="action-buttons">
                <button onclick="editPost(<?php echo $post['id']; ?>)" class="edit-btn">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="deletePost(<?php echo $post['id']; ?>)" class="delete-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Felhasználók kezelése -->
<div id="felhasznalok" class="section-header">
    <h2><i class="fas fa-users"></i> Felhasználók</h2>
</div>
<table class="admin-table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Regisztráció</th>
            <th>Státusz</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
            <td>
                <span class="status-badge <?php echo $user['admin'] ? 'admin' : 'user'; ?>">
                    <?php echo $user['admin'] ? 'Admin' : 'Felhasználó'; ?>
                </span>
            </td>
            <td class="action-buttons">
                <button onclick="toggleAdminStatus(<?php echo $user['id']; ?>)" class="edit-btn">
                    <i class="fas <?php echo $user['admin'] ? 'fa-user-minus' : 'fa-user-plus'; ?>"></i>
                </button>
                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                <button onclick="deleteUser(<?php echo $user['id']; ?>)" class="delete-btn">
                    <i class="fas fa-user-times"></i>
                </button>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Feliratkozók kezelése -->
<div id="feliratkozok" class="section-header">
    <h2><i class="fas fa-envelope"></i> Feliratkozók</h2>
</div>
<table class="admin-table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Feliratkozás</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subscribers as $sub): ?>
        <tr>
            <td><?php echo htmlspecialchars($sub['email']); ?></td>
            <td><?php echo date('Y-m-d', strtotime($sub['created_at'])); ?></td>
            <td class="action-buttons">
                <button onclick="deleteSubscriber(<?php echo $sub['id']; ?>)" class="delete-btn">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
