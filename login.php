<?php
session_start ();
require ( 'includes/init.php' );

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
      $conn = require ( "includes/db.php" );

      if (User::authenticate ( $conn, $_POST["user_email_address"], $_POST["user_password"] ))
      {
            Authentication::login ();
            Url::redirect ( 'main.php' );
      } else
      {
            $error = "Ungültige Anmeldedaten";
      }
}

?>

<?php require ( "includes/header.php" ); ?>

<div class="form_container">

      <form method="post">

            <?php if (! empty ( $error )): ?>
            <div class="error"> <?= $error ?> </div>
            <?php endif ?>

            <h2>E-Mail und Passwort eingeben</h2>

            <div>
                  <label for="email">E-Mail:</label>
                  <input type="email" name="user_email_address" placeholder="webmaster@homsym.de">
            </div>

            <div>
                  <label for="password">Password:</label>
                  <input type="password" name="user_password" placeholder="passwort123...">
            </div>

            <input type="submit" value="Anmelden" class="btn">

            <p>
                  <a href="forgot-password.php" class="link">Passwort zurücksetzen</a>
            </p>

      </form>
</div>

<?php require ( "includes/footer.php" ); ?>