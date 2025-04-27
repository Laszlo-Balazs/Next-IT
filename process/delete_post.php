<?php
require_once '../includes/admin_check.php';
require_once '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header('Location: ../admin.php');
    exit();
}

$post_id = $_GET['id'];

try {
    $conn = connectDB();
    
    // Kép útvonalának lekérése törlés előtt
    $stmt = $conn->prepare("SELECT thumbnail_path FROM blog_posts WHERE id = :id");
    $stmt->bindParam(':id', $post_id);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($post) {
        // Blog poszt törlése
        $stmt = $conn->prepare("DELETE FROM blog_posts WHERE id = :id");
        $stmt->bindParam(':id', $post_id);
        
        if ($stmt->execute()) {
            // Kép törlése a szerverről
            if ($post['thumbnail_path'] && file_exists("../" . $post['thumbnail_path'])) {
                unlink("../" . $post['thumbnail_path']);
            }
            header("Location: ../admin.php?success=deleted");
            exit();
        }
    }
    
    header("Location: ../admin.php?error=not_found");
    exit();
    
} catch(PDOException $e) {
    header("Location: ../admin.php?error=db_error");
    exit();
}
?>
