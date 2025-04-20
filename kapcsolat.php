<?php
session_start();
?>
<!DOCTYPE html>
<html data-wf-page="67a1fce3f621fda08ee8ea4e" data-wf-site="65fc333eda750eb38f8b67a0">
<head>
  <meta charset="utf-8">
  <title>Kapcsolat</title>
  <meta content="Kapcsolat" property="og:title">
  <meta content="Kapcsolat" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/first-cb9532.webflow.css" rel="stylesheet" type="text/css">
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-4">
  <div id="luxy" class="smooth-wrapper">
    <section class="section kapcsolat">
      <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="kapcsolat-nav w-nav">
        <div class="nav-container w-container">
          <a href="index.php" class="brand w-nav-brand"><img width="66" loading="lazy" alt="" src="images/Logo.png" class="image"></a>
          <nav role="navigation" class="nav-menu w-clearfix w-nav-menu">
            <a href="chat-bot.php" class="nav-link left first w-nav-link">Chat Bot</a>
            <a href="blog.php" class="nav-link left w-nav-link">Blog</a>
            <a href="kapcsolat.php" aria-current="page" class="nav-link left w-nav-link w--current">Kapcsolat</a>
          </nav>
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="process/logout.php" class="nav-link nav-button dark w-nav-link">Kijelentkezés</a>
          <?php else: ?>
            <a href="log-in.html" class="nav-link nav-button dark w-nav-link">Bejelentkezés</a>
          <?php endif; ?>
          <div class="menu-button w-nav-button">
            <div class="icon w-icon-nav-menu"></div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="div-block-10">
          <h1 class="heading-15">Lépj kapcsolatba velünk</h1>
          <div class="kapcsolat-hero-div"><img src="images/phone.svg" loading="lazy" alt="" class="image-14">
            <a href="tel:+36-70-719-7685" class="link-block-2 w-inline-block">
              <div class="text-block-11">+36-70-719-7685</div>
            </a>
          </div>
          <div class="kapcsolat-hero-div"><img src="images/email.svg" loading="lazy" alt="" class="image-14">
            <a href="mailto:info@teamapp.com" class="link-block-2 w-inline-block">
              <div class="text-block-11">info@teamapp.com</div>
            </a>
          </div>
          <div class="kapcsolat-hero-div"><img src="images/marker-02.svg" loading="lazy" alt="" class="image-14">
            <div class="text-block-11">1010 Sunset Blv.<br>Palo Alto, California</div>
          </div>
        </div>
      </div>
      <img src="images/Mask-group-min.png" loading="lazy" width="779" sizes="(max-width: 479px) 100vw, (max-width: 991px) 58vw, 779px" alt="" srcset="images/Mask-group-min-p-500.png 500w, images/Mask-group-min-p-800.png 800w, images/Mask-group-min-p-1080.png 1080w, images/Mask-group-min.png 1558w" class="kapcsolat-img">
      <img src="images/red-circle-2.svg" loading="lazy" alt="" class="image-16">
      <img src="images/Bg-purple_1.svg" loading="lazy" alt="" class="image-17">
      <img src="images/Bg-yellow-2.svg" loading="lazy" alt="" class="image-18">
      <img src="images/green-square.svg" loading="lazy" alt="" class="image-19">
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
            <a href="kapcsolat.php" aria-current="page" class="link w--current">Kapcsolat</a>
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
              <?php if(isset($_GET['subscribe'])): ?>
                <?php if($_GET['subscribe'] == 'success'): ?>
                  <div class="success-message-copy w-form-done" style="display:block;">
                    <div class="text-block-5">Thank you! You have been subscribed!</div>
                  </div>
                <?php elseif($_GET['subscribe'] == 'exists'): ?>
                  <div class="error-message w-form-fail" style="display:block;">
                    <div>This email is already subscribed.</div>
                  </div>
                <?php elseif($_GET['subscribe'] == 'invalid'): ?>
                  <div class="error-message w-form-fail" style="display:block;">
                    <div>Please enter a valid email address.</div>
                  </div>
                <?php else: ?>
                  <div class="error-message w-form-fail" style="display:block;">
                    <div>Oops! Something went wrong while submitting the form.</div>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
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
