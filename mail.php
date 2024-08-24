<?php
use PHPMailer\PHPMailer\PHPMailer;

require "vendor/autoload.php";

$mail = new PHPMailer( true );

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP ();
$mail->SMTPAuth = true;

/** Persönliche Angaben */
$mail->Host       = "smtp.gmail.com";
$mail->Port       = 587;
$mail->Username   = "user-email";
$mail->Password   = "Password";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

$mail->isHTML ( true );
return $mail;