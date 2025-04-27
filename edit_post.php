<?php
require_once 'includes/admin_check.php';
require_once 'includes/db_connect.php';

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$conn = connectDB();

// Blog poszt lekérése
$stmt = $conn->prepare("
    SELECT blog_posts.*, authors.name as author_name 
    FROM blog_posts 
    JOIN authors ON blog_posts.author_id = authors.id 
    WHERE blog_posts.id = :id
");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header('Location: admin.php');
    exit();
}

// Szerzők lekérése
$stmt = $conn->prepare("SELECT * FROM authors");
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Blog Post Szerkesztése - Admin Panel</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/webflow.css">
    <link rel="stylesheet" href="css/first-cb9532.webflow.css">
    <!-- TinyMCE -->
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
        .current-image {
            margin: 10px 0;
        }
        .current-image img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="admin-container">
        <h1>Blog Post Szerkesztése</h1>

        <div class="admin-form">
            <form action="process/update_post.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">

                <label for="title">Cím:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

                <label for="author">Szerző:</label>
                <select id="author" name="author_id" required>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?php echo htmlspecialchars($author['id']); ?>"
                                <?php echo ($author['id'] == $post['author_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($author['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="thumbnail">Új thumbnail kép (csak ha változtatni szeretnéd):</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*">

                <div class="current-image">
                    <p>Jelenlegi kép:</p>
                    <img src="<?php echo htmlspecialchars($post['thumbnail_path']); ?>" alt="Current thumbnail">
                </div>

                <label for="content">Tartalom:</label>
                <textarea id="content" name="content"><?php echo htmlspecialchars($post['content']); ?></textarea>

                <button type="submit">Mentés</button>
                <a href="admin.php" style="margin-left: 10px; text-decoration: none;">Mégse</a>
            </form>
        </div>
    </div>
</body>
</html>
