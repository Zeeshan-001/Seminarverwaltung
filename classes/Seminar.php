<?php
class Seminar
{
      public $seminar_id;
      public $seminar_title;
      public $seminar_link;
      public $seminar_description;
      public $seminar_location;
      public $seminar_audience;
      public $seminar_art;
      public $seminar_date_from;
      public $seminar_date_until;
      public $seminar_time_from;
      public $seminar_time_until;
      public $seminar_user_id;

      public static function getSeminars( $conn )
      {
            $sql    = "SELECT * FROM registered_seminars ORDER BY seminar_date_from";
            $result = $conn->query ( $sql );
            return $result->fetchAll ( PDO::FETCH_ASSOC );
      }

      public function createSeminar( $conn )
      {

            $sql = "INSERT INTO registered_seminars(seminar_title, seminar_link, seminar_description,  
                        seminar_location, seminar_audience, seminar_art, seminar_date_from, 
                        seminar_date_until, seminar_time_from, seminar_time_until, seminar_user_id)

                        VALUES(:seminar_title, :seminar_link, :seminar_description,  
                        :seminar_location, :seminar_audience, :seminar_art, :seminar_date_from, 
                        :seminar_date_until, :seminar_time_from, :seminar_time_until, :seminar_user_id)";

            $stmt = $conn->prepare ( $sql );

            $stmt->bindValue ( ':seminar_title', $this->seminar_title, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_link', $this->seminar_link, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_description', $this->seminar_description, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_location', $this->seminar_location, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_audience', $this->seminar_audience, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_art', $this->seminar_art, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_date_from', $this->seminar_date_from, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_date_until', $this->seminar_date_until, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_time_from', $this->seminar_time_from, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_time_until', $this->seminar_time_until, PDO::PARAM_STR );
            $stmt->bindValue ( ':seminar_user_id', $this->seminar_user_id, PDO::PARAM_STR );

            if ($stmt->execute ())
            {
                  $this->seminar_id = $conn->lastInsertId ();
                  return true;
            } else
            {
                  return false;
            }
      }
}