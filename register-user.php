<?php
session_start ();
require "includes/init.php";

if (empty ( $_SESSION['user_id'] ) || ! Authentication::isLoggedIn () || 
            ! Authentication::isAdmin ( $_SESSION['user_id'] ))
{
      Url::redirect ( "login.php" );
}

require ( "includes/header.php" );

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
      $user = new User();

      $user->user_first_name    = $_POST["user_first_name"];
      $user->user_last_name     = $_POST["user_last_name"];
      $user->user_email_address = $_POST["user_email-address"];
      $user->user_password      = $_POST["user_password"];

      $conn = require ( "includes/db.php" );
      if ($user->createUser ( $conn ))
      {
            $info = "Erfolgreich registriert";
      }
}
?>

<div class="form_container">
      <form method="POST">

            <!-- INFO Message would Display after seccessfull registration-->
            <?php if (! empty ( $info )): ?>
            <div class="info"> <?= $info ?> </div>
            <?php endif ?>

            <h2>Neuen Benutzer anlegen</h2>

            <div>
                  <label for="first_name">Vorname:*</label>
                  <input type="text" id="first_name" name="user_first_name" placeholder="Vorname" required>
            </div>

            <div>
                  <label for="last_name">Nachname:*</label>
                  <input type="text" id="last_name" name="user_last_name" placeholder="Nachname" required>
            </div>

            <div>
                  <label for="email">E-Mail-Adresse:*</label>
                  <input type="email" id="email" name="user_email-address" placeholder="webmaster@homsym.de" required>
            </div>

            <div>
                  <label for="password">Passwort:*</label>
                  <input type="password" id="password" name="user_password" placeholder="Passwort@123.." required>
            </div>

            <input type="submit" value="Senden" class="btn">
      </form>

</div>

<?php require ( "includes/footer.php" ); ?>