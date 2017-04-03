<?php
require('../inc/config.php');
require('../inc/db.php');
require('../inc/database.class.php');

$database = new Database();
$database->query('SELECT * FROM faculty_search_positions');
$positions = $database->getAll();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Faculty Search Chair</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>Faculty Search Chair</h1>
        <p>Here you can add candidates to an open faculty position.</p>
        <section id="confirmation"></section>
        <form class="ldpforms">
            <fieldset>
                <legend>Candidate Information</legend>

                <label for="position">Position:</label>
                <?php echo "<select name=\"position\" required>"; ?>
                    <?php echo "<option value=\"\">-- Please Select --</option>"; ?>
                    <?php
                    foreach ($positions as $position) {
                        echo "<option data-position-id=\"" . $position['id'] . "\" value=\"" . $position['title'] . "\">" . $position['title'] . "</option>";
                    }
                    ?>
                <?php echo "</select>"; ?>

                <label for="title">Name:</label>
                <input type="text" name="firstName" id="firstName" required>
                <input type="text" name="lastName" id="lastName" required>

                <label for="affiliation">Affiliation:</label>
                <input type="text" name="affiliation" >

                <label for="degree">Degree:</label>
                <input type="text" name="degree" >

                <label for="school">School:</label>
                <input type="text" name="school" >

                <label for="photo">Photo:</label>
                <input type="file" name="photo" id="photo" >

                <label for="cv">CV:</label>
                <input type="file" name="cv" id="cv" >
            </fieldset>
            <button type="submit" class="button">Submit</button>
        </form>

        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
