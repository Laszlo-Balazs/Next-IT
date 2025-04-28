<?php
session_start();

if(isset($_SESSION['user_id'])) {
    header("Location: chat-bot.php");
    exit();
}
?>
<!DOCTYPE html>
<html data-wf-page="67adf7ae411db9ecf3a17ead" data-wf-site="65fc333eda750eb38f8b67a0">
<head>
  <meta charset="utf-8">
  <title>Registration</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/first-cb9532.webflow.css" rel="stylesheet" type="text/css">
  <link href="images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body-5">
  <section class="logreg-section">
    <div class="logreg-card">
      <div class="left-div">
        <h6 class="heading-20">REGISZTRÁCIÓ</h6>
        <div class="reg-form w-form">
          <form action="process/register.php" method="post" class="reg-div">
            <input class="logreg-txtf w-input" maxlength="256" name="email" placeholder="E-mail" type="email" required>
            <input class="logreg-txtf w-input" maxlength="256" name="password" placeholder="Jelszó" type="password" required>
            <input type="submit" class="reg w-button" value="Regisztráció">
          </form>
          <?php if(isset($_GET['error'])): ?>
            <?php if($_GET['error'] == '1'): ?>
              <div class="w-form-fail" style="display: block;">
                <div>Ez az email cím már regisztrálva van.</div>
              </div>
            <?php else: ?>
              <div class="w-form-fail" style="display: block;">
                <div>Hiba történt a regisztráció során. Kérjük próbálja újra.</div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <div class="div-block-11">
          <div class="reg-txt">Van már fiókod? </div>
          <a href="login.php" class="login-link">Jelentkezz be!</a>
        </div>
        <div class="div-block-11">
          <a href="index.html" class="reg-link">Vissza a kezdőlapra!</a>
        </div>
      </div>
      <div class="righ-div">
        <img src="images/logreg.png" loading="lazy" width="328" alt="" class="image-20">
      </div>
      <img src="images/logreg-Bg-yellow.svg" loading="lazy" alt="" class="image-22">
      <img src="images/logreg-red-ccircle.svg" loading="lazy" alt="" class="image-24">
    </div>
    <div class="atlatszo-hatter">
      <img src="images/logreg-Bg-purple.svg" loading="lazy" alt="" class="image-21">
      <img src="images/log-reg-Rectangle-7.svg" loading="lazy" alt="" class="image-23">
    </div>
  </section>
</body>
</html>
