<?php
session_start();
require_once 'includes/db_connect.php';

$post_id = filter_var($_GET['id'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

try {
    $conn = connectDB();
    $stmt = $conn->prepare("
        SELECT 
            blog_posts.*,
            authors.name as author_name,
            authors.avatar_path as author_avatar,
            authors.bio as author_bio
        FROM blog_posts 
        JOIN authors ON blog_posts.author_id = authors.id 
        WHERE blog_posts.id = :id
    ");
    $stmt->bindParam(':id', $post_id);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        header("Location: blog.php");
        exit();
    }
} catch(PDOException $e) {
    header("Location: blog.php");
    exit();
}
?>
<!DOCTYPE html>
<html data-wf-page="66d02fb4f2a7b52a72435c93" data-wf-site="65fc333eda750eb38f8b67a0">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($post['title']); ?> - Team App</title>
  <meta content="<?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 160)); ?>" name="description">
  <meta content="<?php echo htmlspecialchars($post['title']); ?> - Team App" property="og:title">
  <meta content="<?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 160)); ?>" property="og:description">
  <meta content="<?php echo htmlspecialchars($post['thumbnail_path']); ?>" property="og:image">
  <meta content="<?php echo htmlspecialchars($post['title']); ?> - Team App" property="twitter:title">
  <meta content="<?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 160)); ?>" property="twitter:description">
  <meta content="<?php echo htmlspecialchars($post['thumbnail_path']); ?>" property="twitter:image">
  <meta property="og:type" content="article">
  <meta content="summary_large_image" name="twitter:card">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/first-cb9532.webflow.css" rel="stylesheet" type="text/css">
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-3">
  <div id="luxy" class="smooth-wrapper">
    <section class="section white-section">
      <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
        <div class="nav-container w-container">
          <a href="index.php" class="brand w-nav-brand"><img src="images/Logo.png" loading="lazy" width="66" alt="" class="image"></a>
          <nav role="navigation" class="nav-menu w-clearfix w-nav-menu">
            <a href="chat-bot.php" class="nav-link left first w-nav-link">Chat Bot</a>
            <a href="blog.php" class="nav-link left w-nav-link">Blog</a>
            <a href="kapcsolat.php" class="nav-link left w-nav-link">Kapcsolat</a>
          </nav>
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="process/logout.php" class="nav-link nav-button w-nav-link">Kijelentkezés</a>
          <?php else: ?>
            <a href="log-in.html" class="nav-link nav-button w-nav-link">Bejelentkezés</a>
          <?php endif; ?>
          <div class="menu-button w-nav-button">
            <div class="icon w-icon-nav-menu"></div>
          </div>
        </div>
      </div>
      <div class="blog-container top-margin">
        <h1 class="heading-10"><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="author-and-date">
          <div class="avatar-img" style="background-image: url('<?php echo htmlspecialchars($post['author_avatar']); ?>')"></div>
          <div class="author-name"><?php echo htmlspecialchars($post['author_name']); ?></div>
          <div class="divider">|</div>
          <div class="author-name"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></div>
        </div>
      </div>
      <div class="blog-container _900-wide">
        <div class="main-img" style="background-image: url('<?php echo htmlspecialchars($post['thumbnail_path']); ?>')"></div>
      </div>
      <div class="blog-container">
        <div class="rich-text w-richtext">
          <?php echo $post['content']; ?>
        </div>
        <div class="author-blocck">
          <div class="avatar-img-copy" style="background-image: url('<?php echo htmlspecialchars($post['author_avatar']); ?>')"></div>
          <div>
            <div class="text-block-7">WRITTEN BY</div>
            <div class="text-block-8"><?php echo htmlspecialchars($post['author_name']); ?></div>
            <div class="text-block-6"><?php echo htmlspecialchars($post['author_bio']); ?></div>
          </div>
        </div>
      </div>
      <img src="images/red-ccircle.svg" loading="lazy" alt="" class="redc1">
      <img src="images/Bg-yellow.svg" loading="lazy" alt="" class="yelows1">
      <img src="images/green-square.svg" loading="lazy" alt="" height="Auto" class="greens1">
      <img src="images/Bg-purple-2.svg" loading="lazy" alt="" class="purplec1">
    </section>
    <section class="section footer">
      <div class="nav-container">
        <div class="flexbox-2 footer">
          <div class="footer-column first">
            <a href="index.php" class="w-inline-block"><img width="66" loading="lazy" alt="" src="images/Logo.png"></a>
            <div class="text-block-4">Minden ami informatika!</div>
          </div>
          <div class="footer-column">
            <h3>Cég</h3>
            <a href="kapcsolat.php" class="link">Kapcsolat</a>
            <a href="blog.php" class="link">Blog</a>
          </div>
          <div class="footer-column">
            <h3>Funkciók</h3>
            <a href="chat-bot.php" class="link">Chat Bot</a>
            <a href="log-in.html" class="link">IOS &amp; Android<br></a>
          </div>
          <div class="footer-column">
            <h3>Kapcsolat</h3>
            <a href="mailto:info@teamapp.com" class="link">info@teamapp.com</a>
            <a href="tel:+36-70-719-7685" class="link">+36-70-719-7685</a>
            <a href="#" class="link">1010 Sunset Blv.Palo Alto, California</a>
          </div>
          <div class="footer-column last">
            <h3>Maradj Napra Kész!</h3>
            <div class="sub-text">Iratkozz fel a hírlevelünkre!</div>
            <div class="form-block w-form">
              <form action="process/subscribe.php" method="post" class="form-copy">
                <input class="text-field-copy w-input" maxlength="256" name="email" placeholder="Email" type="email" required="">
                <input type="submit" class="arrow-button w-button" value="b">
              </form>
            </div>
          </div>
        </div>
        <div class="text-block-3">© Copyright NextIt Inc.</div>
      </div>
    </section>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js" type="text/javascript"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <script src="https://min30327.github.io/luxy.js/dist/js/luxy.js"></script>
  <script charset="utf-8">
    var isMobile = /iPhone|iPad|Android/i.test(navigator.userAgent);
    if (!isMobile) {
      luxy.init({
        wrapper: '#luxy',
        wrapperSpeed: 0.065,
      });
    }
  </script>
</body>
</html>
