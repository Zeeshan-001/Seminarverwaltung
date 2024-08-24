<?php
session_start ();
require "includes/init.php";
require ( "includes/header.php" );
?>

<div class="main">

      <h1>Verlag Homöopathie + Symbol <span>Seminarkalender</span></h1>

      <div class="actions_btns">

            <?php if (Authentication::isLoggedin ()): ?>
            <a href="register-seminar.php" class="btn btn_add">
                  &plus; Seminar hinzufügen
            </a>
            <?php endif; ?>

            <?php if (Authentication::isLoggedin () && Authentication::isAdmin ( $_SESSION["user_id"] )): ?>
            <a href="download-newsletter.php" class="btn btn_download">
                  &#11123; HTML-Code herunterladen
            </a>
            <?php endif; ?>

            <?php if (Authentication::isLoggedin () && Authentication::isAdmin ( $_SESSION["user_id"] )): ?>
            <a href="register-user.php" class="btn btn_signup">
                  &plus; Benutzer registrieren
            </a>
            <?php endif; ?>

      </div>

      <?php require ( "includes/seminar.php" ) ?>

</div>

<?php require ( "includes/footer.php" ) ?>