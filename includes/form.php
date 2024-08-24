<div class="form_container">
      <form method="post">
            <h2>Seminarregistrierung</h2>

            <div>
                  <label for="title">Titel der Veranstaltung:</label>
                  <input type="text" name="seminar_title" id="title" placeholder="Titel der Veranstaltung" required>
            </div>

            <div>
                  <label for="link">Link zur Seminarseite:</label>
                  <input type="text" name="seminar_link" id="link" placeholder="Link zur Seminarseite" required>
            </div>

            <div>
                  <label for="description">Beschreibung:</label>
                  <textarea type="text" name="seminar_description" id="description" placeholder="Beschreibung"
                        required></textarea>
            </div>

            <div>
                  <label for="location">Ort:</label>
                  <input type="text" name="seminar_location" id="location" placeholder="Ort des Seminars" required>
            </div>

            <div>
                  <label for="targetAudience">Zielgruppe:</label>
                  <input type="text" name="seminar_audience" id="targetAudience" placeholder="Zielgruppe" required>
            </div>

            <div>
                  <label for="art">Art des Seminars:</label>
                  <Select id="art" name="seminar_art">
                        <option value="Präsenz-Seminar">Präsenz-Seminar</option>
                        <option value="Online-Seminar">Online-Seminar</option>
                        <option value="Hybrid-Seminar">Hybrid-Seminar</option>
                  </Select>
            </div>

            <div class="date">
                  <div>
                        <label for="dateFrom">Datum von:</label>
                        <input type="date" name="seminar_date_from" id="dateFrom" required>
                  </div>

                  <div>
                        <label for="dateUntil">Datum bis:</label>
                        <input type="date" name="seminar_date_until" id="dateUntil" required>
                  </div>
            </div>

            <div class="time">
                  <div>
                        <label for="timeFrom">Uhrzeit von</label>
                        <input type="time" name="seminar_time_from" id="timeFrom" required>
                  </div>

                  <div>
                        <label for="timeUntil">Uhrzeit bis:</label>
                        <input type="time" name="seminar_time_until" id="timeUntil" required>
                  </div>
            </div>

            <input type="submit" value="Senden" class="btn">
      </form>
</div>