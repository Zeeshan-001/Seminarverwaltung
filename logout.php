<?php
session_start ();
require ( "includes/init.php" );

Authentication::logout ();
Url::redirect ( "main.php" );