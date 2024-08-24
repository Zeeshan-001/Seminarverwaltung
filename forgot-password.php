<?php
require ( "includes/init.php" );
$conn = require 'includes/db.php';

$token = bin2hex ( random_bytes ( 16 ) );
$link  = "https://homsym.de/qadri_sw6/seminarverwaltung/reset-password.php?token=$token";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
      $email = $_POST["user_email_address"];

      if (User::setToken ( $conn, $email, $token ))
      {
            try
            {
                  $mail = require __DIR__ . "/mail.php";
                  $mail->setFrom ( 'gfachinformatiker@gmail.com', 'homsym.de' );
                  $mail->addAddress ( $email, '' );
                  $mail->Subject = "Password Reset";
                  $mail->Body = "Klicken Sie bitte <a href='$link'>hier</a>, um Ihr Passwort zurückzusetzen.";
                  $mail->send ();
                  $info = "E-Mail an angegebene Adresse versendet. ";
            }
            catch ( Exception $e )
            {
                  $error = "Message could not be sent! Mailer error: {$mail->ErrorInfo}";
            }
      } else
      {
            $error = "E-Mail-Adresse nicht gefunden.";
      }
}

?>

<?php require ( 'includes/header.php' ); ?>

<div class="form_container">

      <form method="post">

            <?php if (! empty ( $error )): ?>
            <p class="error"> <?= $error ?> </p>
            <?php endif ?>

            <?php if (! empty ( $info )): ?>
            <p class="info"> <?= $info ?> </p>
            <?php else: ?>

            <label for="email">Bitte gebe Ihre E-Mail-Adresse ein.</label>
            <input type="text" name="user_email_address" id="email" placeholder="E-Mail-Adresse">
            <input type="submit" value="Senden" class="btn">

            <?php endif ?>

      </form>
</div>

<?php require ( 'includes/footer.php' ); ?>