<?php
require_once '../includes/admin_check.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../admin.php");
    exit();
}

$post_id = $_POST['post_id'];
$title = trim($_POST['title']);
$content = $_POST['content'];
$author_id = $_POST['author_id'];

try {
    $conn = connectDB();
    
    // Ha új kép lett feltöltve
    if(isset($_FILES["thumbnail"]) && $_FILES["thumbnail"]["error"] == 0) {
        // Régi kép útvonalának lekérése
        $stmt = $conn->prepare("SELECT thumbnail_path FROM blog_posts WHERE id = :id");
        $stmt->bindParam(':id', $post_id);
        $stmt->execute();
        $old_post = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Új kép feltöltése
        $target_dir = "../images/";
        $file_extension = strtolower(pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        // Ellenőrzés, hogy valóban kép-e
        $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
        if($check === false) {
            header("Location: ../edit_post.php?id=" . $post_id . "&error=not_image");
            exit();
        }
        
        // Új kép feltöltése
        if(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
            $thumbnail_path = "images/" . $new_filename;
            
            // Adatbázis frissítése új képpel
            $stmt = $conn->prepare("
                UPDATE blog_posts 
                SET title = :title, 
                    content = :content, 
                    author_id = :author_id,
                    thumbnail_path = :thumbnail_path
                WHERE id = :id
            ");
            
            $stmt->bindParam(':thumbnail_path', $thumbnail_path);
            
            // Régi kép törlése
            if($old_post && file_exists("../" . $old_post['thumbnail_path'])) {
                unlink("../" . $old_post['thumbnail_path']);
            }
        } else {
            header("Location: ../edit_post.php?id=" . $post_id . "&error=upload_failed");
            exit();
        }
    } else {
        // Frissítés kép nélkül
        $stmt = $conn->prepare("
            UPDATE blog_posts 
            SET title = :title, 
                content = :content, 
                author_id = :author_id
            WHERE id = :id
        ");
    }
    
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':author_id', $author_id);
    $stmt->bindParam(':id', $post_id);
    
    $stmt->execute();
    
    header("Location: ../admin.php?success=1");
    exit();
    
} catch(PDOException $e) {
    // Ha új kép volt feltöltve és hiba történt, töröljük az új képet
    if(isset($target_file) && file_exists($target_file)) {
        unlink($target_file);
    }
    header("Location: ../edit_post.php?id=" . $post_id . "&error=db_error");
    exit();
}
?>
