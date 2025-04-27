<?php
require_once 'includes/auth_check.php';
?>
<!DOCTYPE html>
<html data-wf-page="67a3aaa4a95859783108ea3d" data-wf-site="65fc333eda750eb38f8b67a0">
<head>
  <meta charset="utf-8">
  <title>Chat Bot</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/first-cb9532.webflow.css" rel="stylesheet" type="text/css">
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-3" style="overflow: visible">
  <div id="luxy">
    <?php include 'includes/navbar.php'; ?>
    <section class="section alter">
      <img src="images/Bg-purple_1.svg" loading="lazy" alt="" class="yelows1">
      <img src="images/red-ccircle.svg" loading="lazy" alt="" class="redc1">
      <img src="images/purple-circle-3.svg" loading="lazy" alt="" class="purplec1">
      <img src="images/green-square.svg" loading="lazy" alt="" class="greens1">
      <div class="container">
        <div class="chat-container">
          <div class="chat-header">
            <h2>NextIT Assistant</h2>
            <p>A te személyes IT karriertanácsadód</p>
          </div>
          <div class="example-questions">
            <button class="question-button" data-question="Milyen informatikai képzések vannak Magyarországon?">Milyen informatikai képzések vannak Magyarországon?</button>
            <button class="question-button" data-question="Mit csinál egy Frontend fejlesztő?">Mit csinál egy Frontend fejlesztő?</button>
            <button class="question-button" data-question="Milyen programozási nyelvvel érdemes kezdeni?">Milyen programozási nyelvvel érdemes kezdeni?</button>
          </div>
          <div class="chat-messages" id="chat-messages">
            <!-- Üzenetek helye -->
          </div>
          <div class="chat-input">
            <textarea id="user-input" placeholder="Tegyél fel kérdést az IT karrierlehetőségekről..." rows="3"></textarea>
            <button id="send-button">Küldés</button>
          </div>
        </div>
      </div>
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
              <form id="email-form" name="email-form" data-name="Email Form" method="get" class="form-copy">
                <input class="text-field-copy w-input" maxlength="256" name="email-2" data-name="Email 2" placeholder="Email" type="email" id="email-2" required="">
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
  <script src="js/chatbot.js" type="text/javascript"></script>
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
  <script>
    window.addEventListener('load', function() {
      setTimeout(function() {
        const questionButtons = document.querySelectorAll('.question-button');
        questionButtons.forEach(button => {
          button.onclick = function(e) {
            e.preventDefault();
            const question = this.getAttribute('data-question');
            if (question) {
              const input = document.getElementById('user-input');
              input.value = question;
              sendMessage();
            }
          };
        });
      }, 1000);
    });
  </script>
</body>
</html>
