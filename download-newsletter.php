<?php

session_start ();
require "includes/init.php";
require ( "includes/helper-functions.php" );

/** enforce user to login, before get access to this page */
if (empty ( $_SESSION['user_id'] ) || ! Authentication::isLoggedIn () || ! Authentication::isAdmin ( $_SESSION['user_id'] ))
{
      Url::redirect ( "login.php" );
}

/* Datenbankanbindung und Seminardatenabfrage */
$conn     = require 'includes/db.php';
$seminars = Seminar::getSeminars ( $conn );

/* Erstellen einer temporären Datei und Schreiben von Inhalten */
$temp_file = tempnam ( sys_get_temp_dir (), 'download_' );
$handle    = fopen ( $temp_file, 'wb' );
fwrite ( $handle, getNewsletterHtml ( $seminars ) );
fclose ( $handle );

/* Header für den Download festlegen */
header ( 'Content-Type: application/octet-stream' );
header ( 'Content-Disposition: attachment; filename="Newsletter_Veranstaltungen_Templates.html"' );
header ( 'Content-Length:' . filesize ( $temp_file ) );

/* Laden Sie die temporäre Datei herunter und bereinigen Sie sie */
fpassthru ( fopen ( $temp_file, 'rb' ) );
unlink ( ( $temp_file ) );