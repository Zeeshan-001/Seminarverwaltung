<?php

class DatabaseConn
{
      public function getConn()
      {
            $db_host = "localhost";
            $db_name = "DATABASE-NAME";
            $db_user = "USERNAME";
            $db_pass = "PASSWORD";
            $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';

            try
            {
                  $db = new PDO( $dsn, $db_user, $db_pass );
                  $db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                  return $db;
            }
            catch ( PDOException $exception )
            {
                  echo $exception->getMessage ();
                  exit;
            }
      }
}