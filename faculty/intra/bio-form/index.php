<!DOCTYPE html>
<html>
<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <style>

    #faculty-bio,
    #staff-bio {
      display: none;
    }

  </style>

</head>
<body>
  <h1>Faculty &amp; Staff Bio Form</h1>
  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST"):

    /*---Variables-------------------------------------*/
    $college = 'College of Media & Communication';
    $subject = 'Faculty/Staff Bio Form';

    if(isset($_POST["f_name"])) {
      // If the faculty form is submitted
      $name = strip_tags(trim($_POST['f_name']));
      $email = filter_var($_POST['f_email'], FILTER_SANITIZE_EMAIL);
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo("$email is not a valid email address");
        die();
      }
      $title = strip_tags(trim($_POST['f_title']));
      $dept = strip_tags(trim($_POST['f_dept']));
      $room = strip_tags(trim($_POST['f_room']));
      $hours = strip_tags(trim($_POST['f_hours']));
      $degree1 = strip_tags(trim($_POST['f_degree1']));
      $degree2 = strip_tags(trim($_POST['f_degree2']));
      $degree3 = strip_tags(trim($_POST['f_degree3']));
      $social = strip_tags(trim($_POST['f_social']));
      $bio = htmlentities(trim($_POST['f_bio']));
      $courses = htmlentities(trim($_POST['f_courses']));
      $publications = htmlentities(trim($_POST['f_publications']));
      $awards = htmlentities(trim($_POST['f_awards']));
    } elseif (isset($_POST["s_name"])) {
      // If the staff form is submitted
      $name = strip_tags(trim($_POST['s_name']));
      $email = filter_var($_POST['s_email'], FILTER_SANITIZE_EMAIL);
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo("$email is not a valid email address");
        die();
      }
      $title = strip_tags(trim($_POST['s_title']));
      $dept = strip_tags(trim($_POST['s_dept']));
      $room = strip_tags(trim($_POST['s_room']));
      $hours = strip_tags(trim($_POST['s_hours']));
      $degree1 = strip_tags(trim($_POST['s_degree1']));
      $degree2 = strip_tags(trim($_POST['s_degree2']));
      $degree3 = strip_tags(trim($_POST['s_degree3']));
      $social = strip_tags(trim($_POST['s_social']));
      $bio = htmlentities(trim($_POST['s_bio']));
      $duties = htmlentities(trim($_POST['s_duties']));
      $training = htmlentities(trim($_POST['s_training']));
      $awards = htmlentities(trim($_POST['s_awards']));
    }

    /*---Email to Webmaster-------------------------------------*/
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $to = "kuhrt.cowan@ttu.edu";

    // Message
    $msg = '<html><body>';
    $msg .= '<table width="100%" cellpadding="10">';
    $msg .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . (isset($_POST["f_name"]) ? "Faculty" : "Staff")  . " Bio Form</h1></td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td colspan='2'><h2>Name: " . $name . "</h2></td></tr>";
    $msg .= "<tr><td><strong>Title:</strong></td><td>" . $title . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Department:</strong></td><td>" . $dept . "</td></tr>";
    $msg .= "<tr><td><strong>Room Number:</strong></td><td>" . $room . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Hours:</strong></td><td>" . $hours . "</td></tr>";
    $msg .= "<tr><td><strong>Degrees:</strong></td><td>" . $degree1 . ($degree2 != "" ? "<br />$degree2" : "") . ($degree3 != "" ? "<br />$degree3" : "") . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Bio:</strong></td><td>" . $bio . "</td></tr>";
    if(isset($_POST["f_name"])) {
      $msg .= "<tr><td><strong>Courses:</strong></td><td>" . $courses . "</td></tr>";
      $msg .= "<tr style='background: #EEEEEE;'><td><strong>Publications:</strong></td><td>" . nl2br($publications) . "</td></tr>";
    } elseif (isset($_POST["s_name"])) {
      $msg .= "<tr><td><strong>Duties:</strong></td><td>" . $duties . "</td></tr>";
      $msg .= "<tr style='background: #EEEEEE;'><td><strong>Training:</strong></td><td>" . nl2br($training) . "</td></tr>";
    }
    $msg .= "<tr><td><strong>Awards:</strong></td><td>" . $awards . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Social Media:</strong></td><td>" . nl2br($social) . "</td></tr>";
    $msg .= "</table>";
    $msg .= "</body></html>";

    // Send Message
    mail($to, $subject, $msg, $headers);

  ?>

  <h2>Thank You</h2>
  <p>
    We have received your form! If you have any questions or need anything else, please contact <a href="mailto:kuhrt.cowan@ttu.edu" class="mail">Kuhrt Cowan</a>.
  </p>

  <?php else: ?>
    <h2>Please Select if you're faculty or staff</h2>
    <form id="fs-select" name="fs-select">
      <select id="fs-selection" name="fs-selection" value="fs-selection">
        <option>
          -- Please Select --
        </option>
        <option value="faculty">
          Faculty
        </option>
        <option value="staff">
          Staff
        </option>
      </select>
    </form>

    <p>
      If you have any questions about your page or this form, contact <a href="mailto:kuhrt.cowan@ttu.edu" class="mail">Kuhrt Cowan</a>.
    </p>

    <section id="forms">

      <form id="faculty-bio" method="post" class="ldpforms">
        <fieldset>
          <legend>
            Faculty
          </legend>

          <label for="f_name">Name:</label>
          <input type="text" id="f_name" name="f_name" required="required" />

          <label for="f_email">Email: (<em>Will not appear on page.</em>)</label>
          <input type="text" id="f_email" name="f_email" required="required" />

          <label for="f_title">Title:</label>
          <input type="text" id="f_title" name="f_title" required="required" />

          <label for="f_dept">Department:</label>
          <input type="text" id="f_dept" name="f_dept" required="required" />

          <label for="f_room">Room Number:</label>
          <input type="text" id="f_room" name="f_room" required="required" />

          <label for="f_hours">Office Hours:</label>
          <input type="text" id="f_hours" name="f_hours" required="required" />

          <label for="f_degree1">Degree and Institution:</label>
          <input type="text" id="f_degree1" name="f_degree1" required="required" />

          <label for="f_degree2">Degree and Institution: (<em>optional</em>)</label>
          <input type="text" id="f_degree2" name="f_degree2" />

          <label for="f_degree3">Degree and Institution: (<em>optional</em>)</label>
          <input type="text" id="f_degree3" name="f_degree3" />

          <label for="f_social">Social Media: (<em>optional</em>)</label>
          <textarea name="f_social" id="f_social"></textarea>

          <label for="f_bio">Short Bio/Experience:</label>
          <textarea name="f_bio" id="f_bio"></textarea>

          <label for="f_courses">Current Courses Taught:</label>
          <textarea name="f_courses" id="f_courses"></textarea>

          <label for="f_publications">Publications/Research: (<em>No more than 4. A full list can be on attached CV.</em>)</label>
          <textarea name="f_publications" id="f_publications"></textarea>

          <label for="f_awards">Awards/Honors:</label>
          <textarea name="f_awards" id="f_awards"></textarea>

          <p>
            When you have a full CV ready to add to your page, please email it to <a href="mailto:kuhrt.cowan@ttu.edu" class="mail">Kuhrt Cowan</a>.
          </p>

          <br />
          <input type="submit" name="f_form" value="Submit" class="button">
          <div class="form-loader"></div>
        </fieldset>
      </form>

      <form id="staff-bio" method="post" class="ldpforms">
        <fieldset>
          <legend>
            Staff
          </legend>

          <label for="s_name">Name:</label>
          <input type="text" id="s_name" name="s_name" required="required" />

          <label for="s_email">Email: (<em>Will not appear on page.</em>)</label>
          <input type="text" id="s_email" name="s_email" required="required" />

          <label for="s_title">Title:</label>
          <input type="text" id="s_title" name="s_title" required="required" />

          <label for="s_dept">Department:</label>
          <input type="text" id="s_dept" name="s_dept" required="required" />

          <label for="s_room">Room Number: (<em>optional</em>)</label>
          <input type="text" id="s_room" name="s_room" />

          <label for="s_hours">Office Hours: (<em>optional</em>)</label>
          <input type="text" id="s_hours" name="s_hours" />

          <label for="s_degree1">Degree and Institution: (<em>optional</em>)</label>
          <input type="text" id="s_degree1" name="s_degree1" />

          <label for="s_degree2">Degree and Institution: (<em>optional</em>)</label>
          <input type="text" id="s_degree2" name="s_degree2" />

          <label for="s_degree3">Degree and Institution: (<em>optional</em>)</label>
          <input type="text" id="s_degree3" name="s_degree3" />

          <label for="s_social">Social Media: (<em>optional</em>)</label>
          <textarea name="s_social" id="s_social"></textarea>

          <label for="s_bio">Short Bio/Experience: (<em>optional</em>)</label>
          <textarea name="s_bio" id="s_bio"></textarea>

          <label for="s_courses">Job Duties: (<em>optional</em>)</label>
          <textarea name="s_courses" id="s_duties"></textarea>

          <label for="s_publications">Specialized Training: (<em>optional</em>)</label>
          <textarea name="s_publications" id="s_training"></textarea>

          <label for="s_awards">Awards/Honors: (<em>optional</em>)</label>
          <textarea name="s_awards" id="s_awards"></textarea>

          <br />
          <input type="submit" name="s_form" value="Submit" class="button">
          <div class="form-loader"></div>
        </fieldset>
      </form>

    </section>

    <script>

      $("#fs-selection").change(function() {
        var value = $("#fs-selection option:selected").val();

        if (value == "faculty") {
          $("#staff-bio").slideUp();
          $("#faculty-bio").slideDown();
        } else if (value == "staff") {
          $("#faculty-bio").slideUp();
          $("#staff-bio").slideDown();
        } else {
          $("#faculty-bio").slideUp();
          $("#staff-bio").slideUp();
        }
      });

      // When the submit button is clicked
      $('form :submit').click(function () {

        var form = $(this).closest('form');
        // Making sure all require fields are filled
        var isValid = true;
        $('input[required="required"]').each(function() {
          if ( $(this).val() === '' )
          isValid = false;
        });

        // If required fields are filled
        if (isValid) {
          // Fading form
          form.fadeTo('fast', 0.4);
          // Showing loader next to button
          form.find('.form-loader').fadeTo('fast', 1);
          // Changing text in button
          $(this).attr('value', 'Loading...');
        }
      });

    </script>

  <?php endif; ?>

</body>
</html>
