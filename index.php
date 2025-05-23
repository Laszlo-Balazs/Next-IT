<?php
session_start();
?>
<!DOCTYPE html>
<html data-wf-page="65fc333eda750eb38f8b67b2" data-wf-site="65fc333eda750eb38f8b67a0">
<head>
  <meta charset="utf-8">
  <title>NextIt - IT továbtanulás</title>
  <meta content="IT továbbtanulás" name="description">
  <meta content="NextIt - IT továbtanulás" property="og:title">
  <meta content="IT továbbtanulás" property="og:description">
  <meta content="https://cdn.prod.website-files.com/65fc333eda750eb38f8b67a0/66a10e1bb977a323e0f58de8_Group%2019.jpg" property="og:image">
  <meta content="NextIt - IT továbtanulás" property="twitter:title">
  <meta content="IT továbbtanulás" property="twitter:description">
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
<body class="body">
  <div id="luxy" class="smooth-wrapper">
    <section class="hero-section">
      <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
        <div class="nav-container w-container">
          <a href="index.php" aria-current="page" class="brand w-nav-brand w--current"><img src="images/Logo.png" loading="lazy" width="66" alt="" class="image"></a>
          <nav role="navigation" class="nav-menu w-clearfix w-nav-menu">
            <a href="chat-bot.php" class="nav-link left first w-nav-link">Chat Bot</a>
            <a href="blog.php" class="nav-link left w-nav-link">Blog</a>
            <a href="kapcsolat.php" class="nav-link left w-nav-link">Kapcsolat</a>
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
              <a href="admin.php" class="nav-link left w-nav-link">Admin Panel</a>
            <?php endif; ?>
          </nav>
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="process/logout.php" class="nav-link nav-button w-nav-link">Kijelentkezés</a>
          <?php else: ?>
            <a href="login.php" class="nav-link nav-button w-nav-link">Bejelentkezés</a>
          <?php endif; ?>
          <div class="menu-button w-nav-button">
            <div class="icon w-icon-nav-menu"></div>
          </div>
        </div>
      </div>
      <div data-w-id="76831e5d-420a-e915-2af3-99f11f8eb081" class="container">
        <div class="flexbox first w-clearfix">
          <div class="hero-mockup w-clearfix"><img src="images/Phone-Screen-HS.png" loading="lazy" width="297" sizes="(max-width: 479px) 100vw, (max-width: 767px) 58vw, (max-width: 991px) 297px, 26vw" alt="" srcset="images/Phone-Screen-HS-p-500.png 500w, images/Phone-Screen-HS.png 594w" class="image-9"></div>
          <div class="hero-content">
            <h1 class="white">Fedezd fel az IT világát!</h1>
            <p class="paragraph">Beszélgess a chatbotunkkal, és ismerd meg, milyen lehetőségek rejlenek az informatikában! </p>
            <a href="chat-bot.php" class="button w-button">Kezdjük</a>
            <a href="blog.php" class="button-alter hero-alter-btn w-button">Blog</a>
          </div>
        </div>
      </div>
      <div class="div-block-6"><img src="images/hero-pic-min-1.png" loading="lazy" width="498" height="Auto" alt="" srcset="images/hero-pic-min-1-p-500.png 500w, images/hero-pic-min-1-p-800.png 800w, images/hero-pic-min-1.png 996w" sizes="(max-width: 991px) 100vw, 498px" class="hero-image"></div>
      <img src="images/Bg-yellow.svg" loading="lazy" alt="" class="yelows1">
      <img src="images/green-square.svg" loading="lazy" alt="" height="Auto" class="greens1">
      <img src="images/red-ccircle.svg" loading="lazy" alt="" class="redc1">
      <img src="images/Bg-purple.svg" loading="lazy" alt="" class="purplec1">
    </section>
    <section class="section">
      <div class="container margin">
        <div class="div-block-5">
          <h1 class="heading-5">Segítünk megtalálni a számodra ideális informatikai képzést és karriert.</h1>
        </div>
        <div class="flexbox top-middle">
          <div class="numbers">
            <div data-w-id="65c50d1b-7460-5e72-16b7-5064793dad60" style="opacity:0">
              <div class="number">01</div>
            </div>
            <div class="div-block">
              <h2 class="heading-6">Kérdések</h2>
              <p class="paragraph-2">Tedd fel bátran a kérdéseidet, és útmutatást adunk, hogy megtaláld a számodra legjobb tanulási és karrierlehetőségeket!</p>
            </div>
          </div>
          <div class="numbers">
            <div data-w-id="5b90f5ef-c19b-809f-8dc9-3ce306987211" style="opacity:0">
              <div class="number">02</div>
            </div>
            <div class="div-block">
              <h6 class="heading-6">Találatok</h6>
              <p class="paragraph-2">Találd meg a hozzád illő utat az erősségeid, érdeklődési köröd és személyiséged alapján.</p>
            </div>
          </div>
          <div class="numbers">
            <div data-w-id="3d73cfdd-cad9-7d39-29a3-7b48b791cbe1" style="opacity:0">
              <div class="number">03</div>
            </div>
            <div class="div-block">
              <h1 class="heading-6">Felmérés</h1>
              <p class="paragraph-2">Ismerd meg egyedi erősségeidet – gondold át eddigi tapasztalataidat és céljaidat!</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section alter">
      <div class="container margin">
        <div class="flexbox">
          <div class="div-block-7">
            <h2 class="heading-7">Kapj azonnali válaszokat!</h2>
            <div class="txt-box">Chatbotunk mindig készen áll arra, hogy válaszoljon kérdéseidre a továbbtanulásról, képzésekről és informatikai karrierlehetőségekről. Találd meg a számodra legjobb utat egyszerűen és gyorsan!</div>
          </div>
          <img class="image-10" src="images/Phone.png" width="324" alt="" style="opacity:0" sizes="(max-width: 479px) 100vw, 324px" data-w-id="960c41a3-c7bd-45ee-a895-b108134cc2be" loading="lazy" srcset="images/Phone-p-500.png 500w, images/Phone.png 648w">
          <div class="div-block-8">
            <h2 class="heading-7">Személyre szabott javaslatok!</h2>
            <div class="txt-box">Chatbotunk segít megtalálni a neked legmegfelelőbb informatikai irányt. Kérdéseidre azonnal választ kapsz, legyen szó továbbtanulásról, képzésekről vagy karrierlehetőségekről. Fedezd fel a lehetőségeket gyorsan és egyszerűen!</div>
          </div>
        </div>
      </div>
      <img src="images/qreen-square-2.svg" loading="lazy" alt="" class="greens2">
      <img src="images/Bg-yellow-2.svg" loading="lazy" alt="" class="yelows2">
    </section>
    <section class="section">
      <div class="container margin-3">
        <div class="flexbox space-between">
          <div class="image-column">
            <img src="images/photo-1-min.jpg" loading="lazy" width="565" sizes="(max-width: 479px) 88vw, (max-width: 767px) 400px, (max-width: 991px) 565px, 36vw" alt="" srcset="images/photo-1-min-p-500.jpg 500w, images/photo-1-min-p-800.jpg 800w, images/photo-1-min-p-1080.jpg 1080w, images/photo-1-min.jpg 1130w" class="image-4">
            <img class="event-card" src="images/Messages.png" width="290" alt="" style="opacity:0" sizes="(max-width: 479px) 39vw, (max-width: 767px) 180px, (max-width: 991px) 254.25px, 18vw" data-w-id="48585378-65e9-8f5d-3668-e980b0004d0f" loading="lazy" srcset="images/Messages-p-500.png 500w, images/Messages.png 580w">
            <img src="images/Bg-purple-2.svg" loading="lazy" alt="" class="purplec2">
          </div>
          <div class="div-block">
            <h1 class="heading-8">Mi a neked megfelelő út?</h1>
            <p class="text-block-10">Fedezd fel az informatika világát egyszerűen és könnyedén. Nincs szükség bonyolult magyarázatokra vagy hosszú böngészésre. Chatbotunk segít megtalálni a számodra legjobb irányt, hogy magabiztosan léphess a jövőd felé.</p>
            <a href="chat-bot.php" class="link-block w-inline-block">
              <div class="link-2">Tudj meg többet</div>
              <img src="images/arrow_right_alt_24px.png" loading="lazy" width="24" alt="" class="image-2">
            </a>
          </div>
        </div>
      </div>
      <img src="images/red-circle-2.svg" loading="lazy" alt="" class="redc2">
    </section>
    <section class="section">
      <div class="container margin-2">
        <div class="flexbox reverse">
          <div class="div-block">
            <h1 class="heading-8">Mi a kedvenc tantárgyad?</h1>
            <p class="text-block-10">Bármelyik tantárgy is áll közel hozzád, chatbotunk segít felfedezni, hogyan kapcsolódhat az informatika világához. Találd meg, melyik IT terület illik hozzád a legjobban, és indulj el a számodra legizgalmasabb úton!</p>
            <a href="chat-bot.php" class="link-block w-inline-block">
              <div class="link-2">Tudj meg többet</div>
              <img src="images/arrow_right_alt_24px.png" loading="lazy" width="24" alt="" class="image-2">
            </a>
          </div>
          <div class="image-column reverse">
            <img src="images/photo-2-min.jpg" loading="lazy" width="565" sizes="(max-width: 479px) 88vw, (max-width: 767px) 400px, (max-width: 991px) 565px, 36vw" alt="" srcset="images/photo-2-min-p-500.jpg 500w, images/photo-2-min-p-800.jpg 800w, images/photo-2-min-p-1080.jpg 1080w, images/photo-2-min.jpg 1130w" class="image-4">
            <img class="calendar-card" src="images/Messages_1.png" width="290" alt="" style="opacity:0" sizes="(max-width: 479px) 39vw, (max-width: 767px) 180px, (max-width: 991px) 254.25px, 18vw" data-w-id="a7ab36e3-cd33-addf-49c3-3b24dfcce6dd" loading="lazy" srcset="images/Messages_1-p-500.png 500w, images/Messages_1.png 580w">
            <img src="images/green-square-2.svg" loading="lazy" alt="" class="greens3">
          </div>
        </div>
      </div>
      <img src="images/Bg-yellow-2.svg" loading="lazy" alt="" class="yellows3">
    </section>
    <section class="section overflow-hidden testimonial-section alter">
      <div class="w-layout-blockcontainer nav-container w-container">
        <h1 class="heading-8 center">Mit mondanak az emberek a ChatBot-ról?</h1>
        <div data-delay="4000" data-animation="slide" class="testimonial-slider w-slider" data-autoplay="true" data-easing="ease" data-hide-arrows="true" data-disable-swipe="false" data-autoplay-limit="0" data-nav-spacing="3" data-duration="500" data-infinite="true">
          <div class="mask w-slider-mask">
            <div class="slide w-slide">
              <div class="testimonial-card"><img src="images/stars.svg" loading="lazy" alt="" class="image-5">
                <p class="paragraph-3">Nagyon elégedett vagyok a chatbot segítségével! Könnyen eligazított az IT továbbtanulási lehetőségek között, és hasznos tippeket kaptam a kezdéshez.</p>
                <div class="div-block-2 w-clearfix"><img src="images/avatar.png" loading="lazy" width="50" alt="" class="image-6">
                  <div class="text-block">Nagy Éva</div>
                  <div class="text-block-2">COO at Slack</div>
                </div>
              </div>
            </div>
            <div class="slide w-slide">
              <div class="testimonial-card"><img src="images/stars.svg" loading="lazy" alt="" class="image-5">
                <p class="paragraph-3">Szuper élmény volt a beszélgetés! Gyorsan és érthetően válaszolt a kérdéseimre, és segített megtalálni a számomra legmegfelelőbb képzést.</p>
                <div class="div-block-2 w-clearfix"><img src="images/avatar2-min.png" loading="lazy" width="50" alt="" class="image-6">
                  <div class="text-block">Horváth Anna</div>
                  <div class="text-block-2">Content Writer at Uber</div>
                </div>
              </div>
            </div>
            <div class="slide w-slide">
              <div class="testimonial-card"><img src="images/stars.svg" loading="lazy" alt="" class="image-5">
                <p class="paragraph-3">Imádtam a személyre szabott válaszokat! A chatbot nemcsak általános tanácsokat adott, hanem figyelembe vette az érdeklődési körömet is.</p>
                <div class="div-block-2 w-clearfix"><img src="images/Ellipse-min.png" loading="lazy" width="50" alt="" class="image-6">
                  <div class="text-block">Kiss Tamás</div>
                  <div class="text-block-2">CTO at Loom</div>
                </div>
              </div>
            </div>
            <div class="slide w-slide">
              <div class="testimonial-card"><img src="images/stars.svg" loading="lazy" alt="" class="image-5">
                <p class="paragraph-3">Nagyon informatív és barátságos beszélgetés volt. Most már sokkal magabiztosabb vagyok az IT karrierem megtervezésében.</p>
                <div class="div-block-2 w-clearfix"><img src="images/Ellipse2-min.png" loading="lazy" width="50" alt="" class="image-6">
                  <div class="text-block">Szabó Péter</div>
                  <div class="text-block-2">CTO at Coca-Cola</div>
                </div>
              </div>
            </div>
            <div class="slide w-slide">
              <div class="testimonial-card"><img src="images/stars.svg" loading="lazy" alt="" class="image-5">
                <p class="paragraph-3">A chatbot remek információforrás! Több opciót is bemutatott, amit nem is gondoltam volna, és segített a döntéshozatalban.</p>
                <div class="div-block-2 w-clearfix"><img src="images/avatar.png" loading="lazy" width="50" alt="" class="image-6">
                  <div class="text-block">Kovács Júlia</div>
                  <div class="text-block-2">IT Trainee</div>
                </div>
              </div>
            </div>
          </div>
          <div class="arrow left w-slider-arrow-left"><img src="images/slider-arrow-left.svg" loading="lazy" alt=""></div>
          <div class="arrow w-slider-arrow-right"><img src="images/slider-arrow.svg" loading="lazy" alt="" class="image-11"></div>
          <div class="slide-nav w-slider-nav w-round w-num"></div>
        </div>
      </div>
      <img src="images/purple-circle-3.svg" loading="lazy" alt="" class="purplec3">
    </section>
    <section class="section footer">
      <div class="nav-container">
        <div class="flexbox-2 footer">
          <div class="footer-column first">
            <a href="index.php" aria-current="page" class="w-inline-block w--current"><img width="66" loading="lazy" alt="" src="images/Logo.png"></a>
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
            <a href="login.php" class="link">IOS &amp; Android<br></a>
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
