<?php

function getHourMinsSec( $time, $type )
{
      $valid_format = array( 'H', 'i', 's' );
      if (! in_array ( $type, $valid_format ))
      {
            return "Invalid format provided: " . implode ( ', ', $valid_format );
      }

      $time_obj = new DateTime( $time );
      return $time_obj->format ( $type );

}

function DateFormat( $date_string )
{
      $formatter = new IntlDateFormatter( 'de_DE', IntlDateFormatter::FULL, IntlDateFormatter::NONE );
      $date      = new DateTime( $date_string );
      $full_date = $formatter->format ( $date );
      return $full_date . ",";
}

function getDatesForNextSixWeeks()
{
      $start_date = date ( 'Y-m-d' );
      $end_date   = date ( 'Y-m-d', strtotime ( '+6 weeks', strtotime ( $start_date ) ) );
      return $end_date;
}

function getNewsletterHtml( $seminars )
{
      $file_content = "";

      foreach ($seminars as $seminar)

            /**  Dates Filtering (Start and End) */
            if ($seminar["seminar_date_from"] > date ( 'Y-m-d' ) && $seminar["seminar_date_from"] < getDatesForNextSixWeeks ())
            {
                  $seminat_content = "<p align=left>";
                  $seminat_content .= "<font size=4><font color=#000000><font face=Calibri><strong>";
                  $seminat_content .= "<font color=#d96c00>" . $seminar["seminar_art"] . " </font>";
                  $seminat_content .= "<font color=#000000>" . DateFormat ( $seminar["seminar_date_from"] ) . " (" . $seminar["seminar_location"] . ")</font>";
                  $seminat_content .= "<font size=4><font color=#000000><br><font face=Calibri><strong>";
                  $seminat_content .= "<strong><a href=" . $seminar["seminar_link"] . ">" . $seminar["seminar_title"];
                  $seminat_content .= "</a></strong><br></font></p>";

                  $file_content .= $seminat_content;
            }
      return $file_content;
}