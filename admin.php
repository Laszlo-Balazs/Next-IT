<?php
require_once 'includes/admin_check.php';
require_once 'includes/db_connect.php';

$conn = connectDB();

// Blog posztok lekérése
$stmt = $conn->prepare("
    SELECT blog_posts.*, authors.name as author_name 
    FROM blog_posts 
    JOIN authors ON blog_posts.author_id = authors.id 
    ORDER BY created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Szerzők lekérése
$stmt = $conn->prepare("SELECT * FROM authors");
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Blog Kezelés</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/webflow.css">
    <link rel="stylesheet" href="css/first-cb9532.webflow.css">
    <!-- TinyMCE hozzáadása -->
    <script src="https://cdn.tiny.cloud/1/6s1aye39z8ehbh3xel76phgspihp1yzmtqdq72sfr36vvl8q/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink link image lists charmap preview',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            height: 400
        });
    </script>
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .admin-table th, .admin-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .admin-table th {
            background-color: #f5f5f5;
        }
        .admin-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .admin-form label {
            display: block;
            margin-bottom: 5px;
        }
        .admin-form input[type="text"], 
        .admin-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .admin-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .admin-form button:hover {
            background-color: #45a049;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #2196F3;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .preview-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

<div class="admin-container">
        <div class="admin-header">
            <h1>Admin Panel</h1>
        </div>

        <!-- Statisztikai kártyák -->
        <div class="stats-container">
            <?php
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

            <div class="stat-cards">
                <div class="stat-card">
                    <h3>Felhasználók</h3>
                    <p>Összes: <?php echo $userStats['total_users']; ?></p>
                    <p>Admin: <?php echo $userStats['admin_users']; ?></p>
                    <p>Új (30 nap): <?php echo $userStats['new_users_30d']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Blog Posztok</h3>
                    <p>Összes: <?php echo $blogStats['total_posts']; ?></p>
                    <p>Új (30 nap): <?php echo $blogStats['new_posts_30d']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Feliratkozók</h3>
                    <p>Összes: <?php echo $subscriberStats['total_subscribers']; ?></p>
                </div>
            </div>
        </div>

        <!-- Gyors műveletek -->
        <div class="quick-actions">
            <button onclick="location.href='#felhasznalok'" class="action-btn">Felhasználók Kezelése</button>
            <button onclick="location.href='#blogok'" class="action-btn">Blog Kezelés</button>
            <button onclick="location.href='#feliratkozok'" class="action-btn">Feliratkozók</button>
            <button onclick="location.href='#beallitasok'" class="action-btn">Rendszerbeállítások</button>
        </div>

        <!-- Értesítések -->
        <div class="section-header">
            <h2>Legutóbbi Események</h2>
        </div>
        <div class="notifications">
            <?php
            // Legutóbbi események lekérése (példa adatok)
            $notifications = [
                ["type" => "user", "text" => "Új felhasználó regisztrált", "time" => "2 perce"],
                ["type" => "blog", "text" => "Új blog bejegyzés készült", "time" => "1 órája"],
                ["type" => "subscriber", "text" => "Új hírlevél feliratkozó", "time" => "3 órája"]
            ];
            ?>
            <?php foreach ($notifications as $notif): ?>
            <div class="notification-item">
                <span class="notif-type"><?php echo $notif['type']; ?></span>
                <span class="notif-text"><?php echo $notif['text']; ?></span>
                <span class="notif-time"><?php echo $notif['time']; ?></span>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Blog kezelés -->
        <div id="blogok" class="section-header">
            <h2>Blog Kezelés</h2>
            <button onclick="toggleForm()" class="edit-btn">Új Blog Post</button>
        </div>

        <!-- Új blog post form -->
        <div id="blogForm" class="admin-form" style="display: none;">
            <h2>Új Blog Post Létrehozása</h2>
            <form action="process/blog_post.php" method="POST" enctype="multipart/form-data">
                <label for="title">Cím:</label>
                <input type="text" id="title" name="title" required>

                <label for="author">Szerző:</label>
                <select id="author" name="author_id" required>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?php echo htmlspecialchars($author['id']); ?>">
                            <?php echo htmlspecialchars($author['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="thumbnail">Thumbnail kép:</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required>

                <label for="content">Tartalom:</label>
                <textarea id="content" name="content"></textarea>

                <button type="submit">Mentés</button>
            </form>
        </div>

        <!-- Felhasználók kezelése -->
        <div id="felhasznalok" class="section-header">
            <h2>Felhasználók Kezelése</h2>
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
                <?php
                $users = $conn->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($users as $user):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
                    <td><?php echo $user['admin'] ? 'Admin' : 'Felhasználó'; ?></td>
                    <td class="action-buttons">
                        <button onclick="toggleAdminStatus(<?php echo $user['id']; ?>)" class="edit-btn">
                            <?php echo $user['admin'] ? 'Admin jog elvétele' : 'Admin jog adása'; ?>
                        </button>
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                        <button onclick="deleteUser(<?php echo $user['id']; ?>)" class="delete-btn">Törlés</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Feliratkozók kezelése -->
        <div id="feliratkozok" class="section-header">
            <h2>Hírlevél Feliratkozók</h2>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Feliratkozás dátuma</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subscribers = $conn->query("SELECT * FROM newsletter_subscribers ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($subscribers as $sub):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($sub['email']); ?></td>
                    <td><?php echo date('Y-m-d', strtotime($sub['created_at'])); ?></td>
                    <td class="action-buttons">
                        <button onclick="deleteSubscriber(<?php echo $sub['id']; ?>)" class="delete-btn">Törlés</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Blog posztok listája -->
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Cím</th>
                    <th>Szerző</th>
                    <th>Thumbnail</th>
                    <th>Létrehozva</th>
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
                    <td><?php echo date('Y-m-d', strtotime($post['created_at'])); ?></td>
                    <td class="action-buttons">
                        <button onclick="editPost(<?php echo $post['id']; ?>)" class="edit-btn">Szerkesztés</button>
                        <button onclick="deletePost(<?php echo $post['id']; ?>)" class="delete-btn">Törlés</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <style>
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }
    .action-btn {
        background: #4CAF50;
        color: white;
        padding: 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s;
    }
    .action-btn:hover {
        background: #45a049;
    }
    .notifications {
        margin-bottom: 30px;
    }
    .notification-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .notif-type {
        background: #e3f2fd;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        text-transform: uppercase;
    }
    .notif-time {
        color: #666;
        font-size: 12px;
        margin-left: auto;
    }
    .stats-container {
        margin-bottom: 40px;
    }
    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .stat-card h3 {
        margin: 0 0 15px 0;
        color: #333;
    }
    .stat-card p {
        margin: 5px 0;
        color: #666;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    </style>

    <script>
        // Blog kezelés
        function toggleForm() {
            const form = document.getElementById('blogForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function editPost(id) {
            window.location.href = 'edit_post.php?id=' + id;
        }

        function deletePost(id) {
            if (confirm('Biztosan törölni szeretnéd ezt a blog posztot?')) {
                window.location.href = 'process/delete_post.php?id=' + id;
            }
        }

        // Felhasználó kezelés
        function toggleAdminStatus(userId) {
            if (confirm('Biztosan módosítod az admin jogosultságot?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'process/update_user.php';
                
                const userIdInput = document.createElement('input');
                userIdInput.type = 'hidden';
                userIdInput.name = 'user_id';
                userIdInput.value = userId;
                
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'toggle_admin';
                
                form.appendChild(userIdInput);
                form.appendChild(actionInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function deleteUser(userId) {
            if (confirm('Biztosan törölni szeretnéd ezt a felhasználót?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'process/update_user.php';
                
                const userIdInput = document.createElement('input');
                userIdInput.type = 'hidden';
                userIdInput.name = 'user_id';
                userIdInput.value = userId;
                
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'delete';
                
                form.appendChild(userIdInput);
                form.appendChild(actionInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Feliratkozó kezelés
        function deleteSubscriber(subscriberId) {
            if (confirm('Biztosan törölni szeretnéd ezt a feliratkozót?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'process/delete_subscriber.php';
                
                const subIdInput = document.createElement('input');
                subIdInput.type = 'hidden';
                subIdInput.name = 'subscriber_id';
                subIdInput.value = subscriberId;
                
                form.appendChild(subIdInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Success/Error üzenetek kezelése
        <?php if (isset($_SESSION['success'])): ?>
            alert('<?php echo $_SESSION['success']; ?>');
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            alert('<?php echo $_SESSION['error']; ?>');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
</body>
</html>
