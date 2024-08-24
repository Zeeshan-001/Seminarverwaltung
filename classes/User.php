<?php

class User
{
      public $user_id;
      public $user_first_name;
      public $user_last_name;
      public $user_email_address;
      public $user_password;
      public $reset_token_hash;
      public $reset_token_expires_at;

      public function createUser( $conn )
      {
            $userCreated   = false;
            $password_hash = password_hash ( $this->user_password, PASSWORD_DEFAULT );

            $sql = "INSERT INTO seminar_user_accounts(user_first_name, user_last_name, user_email_address, user_password ) 
                        VALUES(:user_first_name, :user_last_name, :user_email_address, :user_password)";

            $stmt = $conn->prepare ( $sql );
            $stmt->bindValue ( ':user_first_name', $this->user_first_name, PDO::PARAM_STR );
            $stmt->bindValue ( ':user_last_name', $this->user_last_name, PDO::PARAM_STR );
            $stmt->bindValue ( ':user_email_address', $this->user_email_address, PDO::PARAM_STR );
            $stmt->bindValue ( ':user_password', $password_hash, PDO::PARAM_STR );

            try
            {
                  if ($stmt->execute ())
                  {
                        $this->user_id = $conn->lastInsertId ();
                        $userCreated   = true;
                  }
            }
            catch ( PDOException $e )
            {
                  if ($e->getCode () == '23000')
                  {
                        echo ( "Dieser Benutzer ist bereits registriert" );
                  } else
                  {
                        error_log ( "Registrierung Fehlgeschlagen" . $e->getMessage () );
                  }
                  exit;
            }
            return $userCreated;
      }

      public static function authenticate( $conn, $email, $password )
      {
            $userFound = false;

            $sql  = "SELECT * FROM seminar_user_accounts WHERE user_email_address = :user_email_address";
            $stmt = $conn->prepare ( $sql );
            $stmt->bindValue ( ':user_email_address', $email, PDO::PARAM_STR );
            $stmt->setFetchMode ( PDO::FETCH_CLASS, 'User' );
            $stmt->execute ();

            if ($user = $stmt->fetch ())
            {
                  if (password_verify ( $password, $user->user_password ))
                  {
                        $userFound           = true;
                        $_SESSION["user_id"] = $user->user_id;
                  }
            }
            return $userFound;
      }

      public static function verifyResetToken( $conn, $token )
      {
            $token_hash = hash ( 'sha256', $token );

            $sql = "SELECT * FROM seminar_user_accounts 
                              WHERE reset_token_hash = :reset_token_hash";

            $stmt = $conn->prepare ( $sql );
            $stmt->bindValue ( ':reset_token_hash', $token_hash );
            $stmt->execute ();
            return $stmt->fetchAll ( PDO::FETCH_ASSOC );
      }

      public static function updatePassword( $conn, $password, $id )
      {
            $password_hash = password_hash ( $password, PASSWORD_DEFAULT );

            $sql = "UPDATE seminar_user_accounts SET user_password = :user_password, 
                  reset_token_hash = NULL, reset_token_expires_at = NULL WHERE user_id = :user_id";

            $stmt = $conn->prepare ( $sql );
            $stmt->bindValue ( ':user_password', $password_hash );
            $stmt->bindValue ( ':user_id', $id );
            return $stmt->execute ();
      }

      public static function setToken( $conn, $email, $token )
      {
            $token_hash = hash ( "sha256", $token );

            /********* Expiry set for 30 min ********/
            $token_expiry = date ( "Y-m-d H:i:s", time () + 60 * 30 );

            $sql = "UPDATE seminar_user_accounts 
            SET reset_token_hash = :tokenHash, reset_token_expires_at = :tokenExpiry 
            WHERE  user_email_address = :user_email_address";

            $stmt = $conn->prepare ( $sql );
            $stmt->bindValue ( ':tokenHash', $token_hash );
            $stmt->bindValue ( ':tokenExpiry', $token_expiry );
            $stmt->bindValue ( ':user_email_address', $email );
            $stmt->execute ();
            return $stmt->rowCount () > 0;
      }
}