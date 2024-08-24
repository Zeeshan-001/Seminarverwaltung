<?php require ( 'includes/init.php' ); ?>

<!DOCTYPE html>
<html lang="de">

      <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>HomSym-Seminarverwaltung</title>
            <link rel="stylesheet" href="css/variables.css">
            <link rel="stylesheet" href="css/style.css">
            <!--Link to Google-Fonts-->
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
                  rel="stylesheet">
      </head>

      <body>
            <header class="header">
                  <a href="main.php" class="header_logo">
                        <img src="images/homSym.png" alt="homSym-logo">
                  </a>

                  <nav class="nav_main">
                        <?php if (! Authentication::isLoggedin ()): ?>
                        <a href="login.php" class="btn">Einloggen</a>
                        <?php else: ?>
                        <a href="logout.php" class="btn">Ausloggen</a>
                        <?php endif; ?>
                  </nav>
            </header>