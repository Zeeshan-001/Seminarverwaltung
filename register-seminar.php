<?php
session_start ();
require "includes/init.php";

/** Enforce user to login, if user is not logged-in */
if (! Authentication::isLoggedin ())
{
      Url::redirect ( "login.php" );
}

$seminar = new Seminar();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
      $seminar->seminar_title       = $_POST["seminar_title"];
      $seminar->seminar_link        = $_POST["seminar_link"];
      $seminar->seminar_description = $_POST["seminar_description"];
      $seminar->seminar_location    = $_POST["seminar_location"];
      $seminar->seminar_audience    = $_POST["seminar_audience"];
      $seminar->seminar_art         = $_POST["seminar_art"];
      $seminar->seminar_date_from   = $_POST["seminar_date_from"];
      $seminar->seminar_date_until  = $_POST["seminar_date_until"];
      $seminar->seminar_time_from   = $_POST["seminar_time_from"];
      $seminar->seminar_time_until  = $_POST["seminar_time_until"];
      $seminar->seminar_user_id     = $_SESSION["user_id"];

      $conn = require ( "includes/db.php" );

      if ($seminar->createSeminar ( $conn ))
      {
            Url::redirect ( "main.php" );
      }
}
?>

<?php require ( "includes/header.php" ); ?>
<?php require ( "includes/form.php" ); ?>
<?php require ( "includes/footer.php" ); ?>