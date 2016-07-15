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

    require '../../includes/phpmailer/PHPMailerAutoload.php';

    /*---Variables-------------------------------------*/
    $college = 'College of Media & Communication';
    $subject = 'Faculty/Staff Bio Form';

    if(isset($_POST["f_form"])) {
      // If the faculty form is submitted
      $name = $_POST['f_name'];
      $email = $_POST['f_email'];
      $title = $_POST['f_title'];
      $dept = $_POST['f_dept'];
      $room = $_POST['f_room'];
      $hours = $_POST['f_hours'];
      $degree1 = $_POST['f_degree1'];
      $degree2 = $_POST['f_degree2'];
      $degree3 = $_POST['f_degree3'];
      $bio = $_POST['f_bio'];
      $courses = $_POST['f_courses'];
      $publications = $_POST['f_publications'];
      $awards = $_POST['f_awards'];
    } elseif (isset($_POST["s_form"])) {
      // If the staff form is submitted
      $name = $_POST['s_name'];
      $email = $_POST['s_email'];
      $title = $_POST['s_title'];
      $dept = $_POST['s_dept'];
      $room = $_POST['s_room'];
      $hours = $_POST['s_hours'];
      $degree1 = $_POST['s_degree1'];
      $degree2 = $_POST['s_degree2'];
      $degree3 = $_POST['s_degree3'];
      $bio = $_POST['s_bio'];
      $duties = $_POST['s_duties'];
      $training = $_POST['s_training'];
      $awards = $_POST['s_awards'];
    }

    /* a boundary string */
    $randomVal = md5(time());
    $mimeBoundary = "==Multipart_Boundary_x{$randomVal}x";

    /*---Email to Webmaster-------------------------------------*/
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed;\r\n";
    $headers .= " boundary=\"{$mimeBoundary}\"";

    $to = "kuhrt.cowan@ttu.edu";

    // Message
    $msg = '<html><body>';
    $msg .= '<table width="100%" cellpadding="10">';
    $msg .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>" . (isset($_POST["f_form"]) ? "Faculty" : "Staff")  . " Bio Form</h1></td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td colspan='2'><h2>Name: " . $name . "</h2></td></tr>";
    $msg .= "<tr><td><strong>Title:</strong></td><td>" . $title . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Department:</strong></td><td>" . $dept . "</td></tr>";
    $msg .= "<tr><td><strong>Room Number:</strong></td><td>" . $room . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Hours:</strong></td><td>" . $hours . "</td></tr>";
    $msg .= "<tr><td><strong>Degrees:</strong></td><td>" . $degree1 . ($degree2 != "" ? "<br />$degree2" : "") . ($degree3 != "" ? "<br />$degree3" : "") . "</td></tr>";
    $msg .= "<tr style='background: #EEEEEE;'><td><strong>Bio:</strong></td><td>" . $bio . "</td></tr>";
    if(isset($_POST["f_form"])) {
      $msg .= "<tr><td><strong>Courses:</strong></td><td>" . $courses . "</td></tr>";
      $msg .= "<tr style='background: #EEEEEE;'><td><strong>Publications:</strong></td><td>" . $publications . "</td></tr>";
    } elseif (isset($_POST["s_form"])) {
      $msg .= "<tr><td><strong>Duties:</strong></td><td>" . $duties . "</td></tr>";
      $msg .= "<tr style='background: #EEEEEE;'><td><strong>Training:</strong></td><td>" . $training . "</td></tr>";
    }
    $msg .= "<tr><td><strong>Awards:</strong></td><td>" . $awards . "</td></tr>";
    $msg .= "</table>";
    $msg .= "</body></html>";


    $mail = new PHPMailer;

    $mail->SMTPDebug = 3;

    $mail->isSMTP();
    $mail->Host = 'https://smtp.ttu.edu';
    $mail->SMTPAuth = true;
    $mail->Username = 'kuhrt.cowan@ttu.edu';
    $mail->Password = 'L1nd$3y12c';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 25;

    $mail->setFrom($email, $name);
    $mail->addAddress('kuhrt.cowan@ttu.edu', 'Kuhrt Cowan');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $msg;

    if(isset($_POST["f_form"])) {
      $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['f_cv']['name'][$ct]));
      $filename = $_FILES['f_cv']['name'][$ct];
      if (move_uploaded_file($_FILES['f_cv']['tmp_name'][$ct], $uploadfile)) {
        $mail->addAttachment($uploadfile, $filename);
      } else {
        $msg .= 'Failed to move file to ' . $uploadfile;
      }
    }

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }



    // Attachment
    /* Multipart Boundary above message */
    // $msg = "This is a multi-part message in MIME format.\n\n" .
    // "--{$mimeBoundary}\n" .
    // "Content-Type: text/html; charset=ISO-8859-1\r\n" .
    // "Content-Transfer-Encoding: 7bit\n\n" .
    // $msg . "\n\n";
    //
    // if(isset($_POST["f_form"])) {
    //   /* GET File Variables */
    //   $tmpName = $_FILES['f_cv']['tmp_name'];
    //   $fileType = $_FILES['f_cv']['type'];
    //   $fileName = $_FILES['f_cv']['name'];
    //
    //   /* Reading file ('rb' = read binary)  */
    //   $file = fopen($tmpName,'rb');
    //   $data = fread($file,filesize($tmpName));
    //   fclose($file);
    //
    //   /* Encoding file data */
    //   $data = chunk_split(base64_encode($data));
    //
    //   /* Adding attchment-file to message*/
    //   $msg .= "--{$mimeBoundary}\n" .
    //   "Content-Type: {$fileType};\n" .
    //   " name=\"{$fileName}\"\n" .
    //   "Content-Transfer-Encoding: base64\n\n" .
    //   "Content-Disposition: attachment; filename=\"{$fileName}\"\r\n" .
    //   $data . "\n\n" .
    //   "--{$mimeBoundary}--\n";
    // }

    // Send Message
    // mail($to, $subject, $msg, $headers);

  ?>

  <h2>Thank You</h2>
  <p>
    We have recieved your form! If you have any questions or need anything else, please contact <a href="mailto:kuhrt.cowan@ttu.edu" class="mail">Kuhrt Cowan</a>.
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

          <label for="f_bio">Short Bio/Experience:</label>
          <textarea name="f_bio" id="f_bio"></textarea>

          <label for="f_courses">Current Courses Taught:</label>
          <textarea name="f_courses" id="f_courses"></textarea>

          <label for="f_publications">Publications/Research: (<em>No more than 4. A full list can be on attached CV.</em>)</label>
          <textarea name="f_publications" id="f_publications"></textarea>

          <label for="f_awards">Awards/Honors:</label>
          <textarea name="f_awards" id="f_awards"></textarea>

          <label for="f_cv">Full CV:</label>
          <input type="file" name="f_cv" id="f_cv" />
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

      $('form :submit').click(function() {
        // Fading form
        $('form').fadeTo('fast', 0.4);
        // Showing loader next to button
        $('.form-loader').fadeTo('fast', 1);
        // Changing text in button
        $('form :submit').attr('value', 'Loading...');
      });

    </script>

  <?php endif; ?>

</body>
</html>
