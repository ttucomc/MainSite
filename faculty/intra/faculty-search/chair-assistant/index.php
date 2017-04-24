<?php
require('../inc/config.php');
require('../inc/db.php');
require('../inc/database.class.php');

$database = new Database();
$database->query('SELECT * FROM faculty_search_candidates');
$candidates = $database->getAll();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Faculty Search - Chair Assistant</title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            $( function() {
                $("#datepicker").datepicker();
            } );
        </script>
    </head>

    <body>
        <h1>Faculty Search - Chair Assistant</h1>
        <p>Here you can select a candidate and set a public meeting time for a research presentation, teaching presentation and/or a meet and greet.</p>

        <section id="confirmation"></section>

        <form class="ldpforms">
            <fieldset>
                <legend>Candidate Information</legend>

                <label for="candidate">Select a Candidate:</label>
                <?php echo "<select name=\"candidate\" required>"; ?>
                    <?php echo "<option value=\"\">-- Please Select --</option>"; ?>
                    <?php
                    foreach ($candidates as $candidate) {
                        $candidate_name = $candidate['first_name'] . ' ' . $candidate['last_name'];
                        echo "<option data-position-id=\"" . $candidate['position_id'] . "\" value=\"" . $candidate['id'] . "\">" . $candidate_name . "</option>";
                    }
                    ?>
                <?php echo "</select>"; ?>

                <label for="title">Title of the Presentation:</label>
                <input type="text" name="title" required>

                <label for="datetime">Date:</label>
                <input type="text" id="datepicker" name="datetime" required>

                <label for="time">Time:</label>
                <input type="text" name="time" placeholder="Example: 3:00pm" required>

                <label for="location">Location:</label>
                <input type="text" name="location" required>
            </fieldset>
            <button type="submit" class="button">Submit</button>
        </form>

        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
