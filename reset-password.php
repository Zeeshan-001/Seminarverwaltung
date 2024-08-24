<?php

require ( 'includes/init.php' );
require ( 'includes/header.php' );

$conn  = require 'includes/db.php';
$token = $_GET['token'];

if (User::verifyResetToken ( $conn, $token ))
{
      [ $user ] = User::verifyResetToken ( $conn, $token );

      if ($user)
      {
            if (strtotime ( $user["reset_token_expires_at"] ) <= time ())
            {
                  die ( "Fehler! Die gültigkeit des Tokens ist abgelaufen. 
      	             Bitte fordern Sie einen neuen Token an." );
            }
      }
} else
{
      die ( "Fehler! Benutzer nicht gefunden" );
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
      $password_new     = $_POST["password_new"];
      $password_confirm = $_POST['password_confirm'];

      $minLength = 8;

      if (strlen ( $password_new ) < $minLength)
      {
            $error = "Das Password muss mindestens " . $minLength . " Zeichen lang sein.";
      } else
      {
            if ($password_new === $password_confirm)
            {
                  if (User::updatePassword ( $conn, $password_new, $user['user_id'] ))
                  {
                        $info = "Passwort erfolgreich geändert!";
                  } else
                  {
                        $error = "Das Passwort konnte nicht geändert werden.";
                  }
            } else
            {
                  $error = "Die eingegebenen Passwörter stimmen nicht überein.";
            }
      }
}
?>

<div class="form_container">

      <form method="post">

            <?php if (! empty ( $error )): ?>
            <div class="error"> <?= $error ?> </div>
            <?php endif ?>

            <?php if (! empty ( $info )): ?>
            <div class="info"> <?= $info ?> </div>
            <?php else: ?>

            <h2>Bitte geben Sie Ihr neues Passwort ein.</h2>

            <label for="password">Neues Passwort:*</label>
            <input type="password" name="password_new" id="password" placeholder="">

            <label for="password_confirm">Passwort Bestätigen:*</label>
            <input type="password" name="password_confirm" id="password_confirm">

            <button class="btn">Passwort ändern</button>

            <?php endif; ?>

      </form>
</div>

<?php require ( "includes/footer.php" ); ?>