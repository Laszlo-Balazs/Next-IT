<?php
session_start();
require_once 'includes/db_connect.php';

// Get blog posts from database
try {
    $conn = connectDB();
    $stmt = $conn->prepare("
        SELECT 
            blog_posts.*,
            authors.name as author_name,
            authors.avatar_path as author_avatar
        FROM blog_posts 
        JOIN authors ON blog_posts.author_id = authors.id 
        ORDER BY created_at DESC
    ");
    $stmt->execute();
    $blog_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $blog_posts = [];
}
?>
<!DOCTYPE html>
<html data-wf-page="66d0863e2f7a299f0c7def50" data-wf-site="65fc333eda750eb38f8b67a0">
<head>
  <meta charset="utf-8">
  <title>Blog - Team App</title>
  <meta content="Our latest web design tips, tricks, insights, and resources, hot off the presses." name="description">
  <meta content="Blog - Team App" property="og:title">
  <meta content="Our latest web design tips, tricks, insights, and resources, hot off the presses." property="og:description">
  <meta content="https://cdn.prod.website-files.com/65fc333eda750eb38f8b67a0/66a10e1bb977a323e0f58de8_Group%2019.jpg" property="og:image">
  <meta content="Blog - Team App" property="twitter:title">
  <meta content="Our latest web design tips, tricks, insights, and resources, hot off the presses." property="twitter:description">
  <meta content="https://cdn.prod.website-files.com/65fc333eda750eb38f8b67a0/66a10e1bb977a323e0f58de8_Group%2019.jpg" property="twitter:image">
  <meta property="og:type" content="website">
  <meta content="summary_large_image" name="twitter:card">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/first-cb9532.webflow.css" rel="stylesheet" type="text/css">
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-2">
  <div id="luxy" class="smooth-wrapper">
    <section class="section blog-section">
      <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
        <div class="nav-container w-container">
          <a href="index.php" class="brand w-nav-brand"><img src="images/Logo.png" loading="lazy" width="66" alt="" class="image"></a>
          <nav role="navigation" class="nav-menu w-clearfix w-nav-menu">
            <a href="chat-bot.php" class="nav-link left first w-nav-link">Chat Bot</a>
            <a href="blog.php" aria-current="page" class="nav-link left w-nav-link w--current">Blog</a>
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
      <div class="nav-container">
        <h1 class="heading-9">Blog</h1>
        <p class="paragraph-5">Our latest web design tips, tricks, insights, and resources, hot off the presses.</p>
        <div class="block-grid">
          <div class="w-dyn-list">
            <?php if (!empty($blog_posts)): ?>
            <div role="list" class="collection-list w-dyn-items w-row">
              <?php foreach($blog_posts as $post): ?>
              <div role="listitem" class="collection-item w-dyn-item w-col w-col-4">
                <a href="detail_blog.php?id=<?php echo htmlspecialchars($post['id']); ?>" class="blog-card w-inline-block">
                  <div class="thumbnail" style="background-image: url('<?php echo htmlspecialchars($post['thumbnail_path']); ?>')"></div>
                  <div class="card-content">
                    <div>
                      <h2 class="heading-4"><?php echo htmlspecialchars($post['title']); ?></h2>
                      <p class="caption"><?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 150)) . '...'; ?></p>
                    </div>
                    <div class="author-and-date blog-hp">
                      <div class="avatar-img blog-page" style="background-image: url('<?php echo htmlspecialchars($post['author_avatar']); ?>')"></div>
                      <div class="author-name blog-hp"><?php echo htmlspecialchars($post['author_name']); ?></div>
                      <div class="divider blog-hp">|</div>
                      <div class="author-name blog-hp"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></div>
                    </div>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="w-dyn-empty">
              <div>No items found.</div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <img src="images/Bg-purple-2.svg" loading="lazy" alt="" class="purplecblog">
      <img src="images/red-ccircle.svg" loading="lazy" alt="" class="redcblog">
      <img src="images/Bg-yellow.svg" loading="lazy" alt="" class="yellowsblog">
      <img src="images/green-square.svg" loading="lazy" alt="" height="Auto" class="greensblog">
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
            <a href="blog.php" aria-current="page" class="link w--current">Blog</a>
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
