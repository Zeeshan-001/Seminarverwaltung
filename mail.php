<!--Link to SMTP PHP set-up Code-->


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
$mail->Username   = "gfachinformatiker@gmail.com";
$mail->Password   = "ucnocjhgirqdjwla";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

/** HomSym-Server */
//$mail->Host       = "11902.whserv.de";
//$mail->Port       = 587;
//$mail->Username   = "xa016p25";
//$mail->Password   = "Qadri_2310";
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

$mail->isHTML ( true );
return $mail;