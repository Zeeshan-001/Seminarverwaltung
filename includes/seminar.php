<?php
require 'includes/init.php';
require ( "includes/helper-functions.php" );

$conn     = require 'includes/db.php';
$seminars = Seminar::getSeminars ( $conn );
?>


<?php if (! $seminars): ?>
<h2>Derzeit Keine Seminare verfügbar</h2>
<?php else: ?>

<table>
      <tbody class="seminars">
            <?php foreach ($seminars as $key => $seminar): ?>
            <tr class="seminar">

                  <td class="seminar_art">
                        <i>
                              <span><?= htmlspecialchars ( $seminar["seminar_art"] ) ?></span>
                        </i>
                  </td>

                  <td class="title">
                        <a href=<?= htmlspecialchars ( $seminar["seminar_link"] ) ?>>
                              <?= htmlspecialchars ( $seminar["seminar_title"] ) ?>
                        </a>
                  </td>

                  <td class="location">
                        <span><?= htmlspecialchars ( $seminar["seminar_location"] ) ?></span>
                  </td>

                  <td class="description">
                        <?= htmlspecialchars ( $seminar["seminar_description"] ) ?>
                  </td>

                  <td class="group">
                        <b>Zielgruppe:</b>
                        <span><?= htmlspecialchars ( $seminar["seminar_audience"] ) ?></span>
                  </td>

                  <td class="termin">
                        <b>Termin:</b>
                        <span>
                              <b>Von</b>
                              <?= htmlspecialchars ( DateFormat ( $seminar["seminar_date_from"] ) ) ?>
                              <?= htmlspecialchars ( getHourMinsSec ( $seminar['seminar_time_from'], 'H' ) . ':' . getHourMinsSec ( $seminar['seminar_time_from'], 'i' ) ) ?>
                              Uhr

                              <b>bis</b>
                              <?= htmlspecialchars ( DateFormat ( $seminar["seminar_date_until"] ) ) ?>
                              <?= htmlspecialchars ( getHourMinsSec ( $seminar['seminar_time_until'], 'H' ) . ':' . getHourMinsSec ( $seminar['seminar_time_until'], 'i' ) ) ?>
                              Uhr
                        </span>
                  </td>

            </tr>
            <?php endforeach ?>
      </tbody>
</table>
<?php endif; ?>