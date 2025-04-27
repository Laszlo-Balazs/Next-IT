<?php
require_once '../includes/admin_check.php';
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../admin.php");
    exit();
}

$title = trim($_POST['title']);
$content = $_POST['content'];
$author_id = $_POST['author_id'];

// Kép feltöltés kezelése
$target_dir = "../images/";
$file_extension = strtolower(pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION));
$new_filename = uniqid() . '.' . $file_extension;
$target_file = $target_dir . $new_filename;
$uploadOk = 1;

// Ellenőrzés, hogy valóban kép-e
if(isset($_FILES["thumbnail"])) {
    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
    if($check === false) {
        header("Location: ../admin.php?error=not_image");
        exit();
    }
}

// Fájl feltöltése
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
        try {
            $conn = connectDB();
            
            $thumbnail_path = "images/" . $new_filename;
            
            $stmt = $conn->prepare("
                INSERT INTO blog_posts (title, content, thumbnail_path, author_id) 
                VALUES (:title, :content, :thumbnail_path, :author_id)
            ");
            
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':thumbnail_path', $thumbnail_path);
            $stmt->bindParam(':author_id', $author_id);
            
            $stmt->execute();
            
            header("Location: ../admin.php?success=1");
            exit();
        } catch(PDOException $e) {
            // Töröljük a feltöltött képet, ha az adatbázis művelet nem sikerült
            unlink($target_file);
            header("Location: ../admin.php?error=db_error");
            exit();
        }
    } else {
        header("Location: ../admin.php?error=upload_failed");
        exit();
    }
}

header("Location: ../admin.php?error=unknown");
exit();
?>
