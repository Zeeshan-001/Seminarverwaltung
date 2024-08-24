<?php

class Authentication
{
      /*
       * Überprüft, ob der Benutzer angemeldet ist
       */
      public static function isLoggedin()
      {
            return isset ( $_SESSION['is_logged_in'] ) && $_SESSION['is_logged_in'];
      }

      /*
       * Erstellt eine Sitzungs-ID und
       * eine Sitzungsvariable für den angemeldeten Benutzer
       */
      public static function login()
      {
            session_regenerate_id ( true );
            $_SESSION["is_logged_in"] = true;
      }

      /*
       * Dadurch wird das Sitzungscookie effektiv gelöscht und 
       * die Sitzung zum Abmelden des Benutzers zerstört
       */
      public static function logout()
      {
            if (ini_get ( "session.use_cookies" ))
            {
                  $params = session_get_cookie_params ();
                  setcookie (
                        session_name (),
                        "",
                        time () - 42000,
                        $params["path"],
                        $params["domain"],
                        $params["secure"],
                        $params["httponly"],
                  );
            }

            session_destroy ();
      }

      public static function isAdmin( $user_id )
      {
            return isset ( $user_id ) && ( $user_id === 200 );
      }
}