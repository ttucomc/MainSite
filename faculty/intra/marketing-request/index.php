<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://api.trello.com/1/client.js?key=800f66b96d0d0e3d0f41da10eb18a075"></script>

  <style>

  #project-request,
  #event-request {
    display: none;
  }

  </style>
</head>
<body>
  <h1>Marketing Request Form</h1>
  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST"):

    if(isset($_POST["p_form"])) {
      /*---Variables-------------------------------------*/
      $college = 'College of Media & Communication';
      $to = "clara.mckenney@ttu.edu, kuhrt.cowan@ttu.edu, hannah.woodfin@ttu.edu";
      $subject = 'Project Request Form';
      $name = strip_tags(trim($_POST['p_contact_name']));
      $email = filter_var($_POST['p_email'], FILTER_SANITIZE_EMAIL);
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo("$email is not a valid email address");
        die();
      }
      $dept = strip_tags(trim($_POST['p_department']));
      $phone = strip_tags(trim($_POST['p_phone']));
      $jobType = $_POST['job_type'];
      $courseTitle = strip_tags(trim($_POST['course_title']));
      $courseNumber = strip_tags(trim($_POST['course_number']));
      $courseSection = strip_tags(trim($_POST['course_section']));
      $courseTime = strip_tags(trim($_POST['course_daytime']));
      $professor = strip_tags(trim($_POST['course_professor']));
      $deadline = $_POST['p_deadline'];
      $details = htmlentities(trim($_POST['p_details']));

      /*---Email to Marketing-------------------------------------*/
      $headers = "From: " . $name . " <" . $email . ">\r\n";
      $headers .= "Reply-To: " . $email . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      // Message
      $msg = '<html><body>';
      $msg .= '<table width="100%" cellpadding="10">';
      $msg .= "<tr style='background: #CC0000; color: #FFFFFF'><td colspan='2'><h1 style='color: #FFFFFF;'>Project Request Form</h1></td></tr>";
      $msg .= "<tr style='background: #EEEEEE;'><td colspan='2'><h2>" . $jobType . " Request</h2></td></tr>";
      $msg .= "<tr><td><strong>Requester:</strong></td><td>" . $name . "</td></tr>";
      $msg .= "<tr style='background: #EEEEEE;'><td><strong>Department:</strong></td><td>" . $dept . "</td></tr>";
      $msg .= "<tr><td><strong>Phone Number:</strong></td><td>" . $phone . "</td></tr>";
      if ($jobType == 'Course Flier') {
        $msg .= "<tr style='background: #EEEEEE;'><td><strong>Course Title:</strong></td><td>" . $courseTitle . "</td></tr>";
        $msg .= "<tr><td><strong>Course Number - Section:</strong></td><td>" . $courseNumber . " - " . $courseSection . "</td></tr>";
        $msg .= "<tr style='background: #EEEEEE;'><td><strong>Course Day & Time:</strong></td><td>" . $courseTime . "</td></tr>";
        $msg .= "<tr><td><strong>Course Professor:</strong></td><td>" . $professor . "</td></tr>";
      }
      $msg .= "<tr style='background: #EEEEEE;'><td><strong>Due Date:</strong></td><td>" . $deadline . "</td></tr>";
      $msg .= "<tr><td><strong>Project Details:</strong></td><td>" . nl2br($details) . "</td></tr>";
      $msg .= "</table>";
      $msg .= "</body></html>";

      // Send Message
      mail($to, $subject, $msg, $headers);


      /*---Email to Trello-------------------------------------*/
      if ($jobType != "Story Ideas") {

        // Headers
        $trello_headers = "From: Project Request <comc@ttu.edu>\r\n";
        $trello_headers .= "Reply-To: comc@ttu.edu\r\n";
        $trello_headers .= "MIME-Version: 1.0\r\n";
    		$trello_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Adding members to card based on job request, this goes in email's subject line
        if ($jobType == "Web") {
          $trello_members = "@kuhrtcowan";
        } elseif ($jobType == "Photo/Video Opportunity") {
          $trello_members = "@claram @hannahwoodfin";
        } else {
          $trello_members = "@claram";
        }

        // To and subject
        $trello_to = "comcprojectrequests+wpcsyrouxyf8fbmu97he@boards.trello.com";
        $trello_subject = $jobType . " Request " . $trello_members;

        // Message (This is in Markdown syntax)
        $trello_msg = '<html><body>';
        $trello_msg .= "#" . $name . "<br>";
        $trello_msg .= "##". $dept . "<br>";
        $trello_msg .= "###" . $email . " | " . $phone . "<br><br>";
        $trello_msg .= "---<br /><br />";
        if ($jobType == "Course Flier") {
          $trello_msg .= "##Course Flier Info<br><br>";
          $trello_msg .= "- Course Title: " . $courseTitle . "<br>";
          $trello_msg .= "- Course Title: " . $courseNumber . " - " . $courseSection . "<br>";
          $trello_msg .= "- Course Day & Time: " . $courseTime . "<br>";
          $trello_msg .= "- Course Professor: " . $professor . "<br><br>";
        }
        $trello_msg .= "###_Due Date: " . $deadline . "_<br><br>";
        $trello_msg .= nl2br($details);
        $trello_msg .= '</body></html>';

        // Send Message
        mail($trello_to, $trello_subject, $trello_msg, $trello_headers);

      }


    } elseif (isset($_POST["e_form"])) {

      /*---Variables-------------------------------------*/

      $college = 'College of Media & Communication';
      $to = "todd.chambers@ttu.edu, clara.mckenney@ttu.edu, taryn.meixner@ttu.edu, kuhrt.cowan@ttu.edu";
      $subject = 'Sponsorship Request Form';
      $name = strip_tags(trim($_POST['e_contact_name']));
      $email = strip_tags(trim($_POST['e_mail']));
      $phone = strip_tags(trim($_POST['e_phone']));
      $responsible = strip_tags($_POST['responsible']);
      $orgName = strip_tags(trim($_POST['org_name']));
      $orgType = strip_tags(trim($_POST['org_type']));
      $request = nl2br(implode(', ', $_POST['request_option']));
      $funds = strip_tags(trim($_POST['funds']));
      $fundsDesc = strip_tags(trim($_POST['funds_desc']));
      $eventName = strip_tags(trim($_POST['event_name']));
      $collegeWide = strip_tags(trim($_POST['college_wide']));
      $eventStart = strip_tags($_POST['event_start']);
      $eventEnd = strip_tags($_POST['event_end']);
      $time1 = stripslashes($_POST['time_start']);
  		$time2 = stripslashes($_POST['time_end']);
      $attendees = strip_tags(trim($_POST['attendees']));
      $location = strip_tags(trim($_POST['location']));
      $roomNumber = strip_tags(trim($_POST['room_number']));
      $eventDesc = strip_tags(trim($_POST['event_desc']));
      $benefits = strip_tags(trim($_POST['benefits']));
      $risks = strip_tags(trim($_POST['risks']));


      /*---Email to Marketing Dept.-------------------------------------*/

  		$headers = "From: " . $name . " <" . $email . ">\r\n";
  		$headers .= "Reply-To: ". $email . "\r\n";
  		$headers .= "MIME-Version: 1.0\r\n";
  		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  		$message = '<html><body>';
  		$message .= '<table width="100%" cellpadding="10">';
  		$message .= "<tr style='background: #CC0000; color: #FFFFFF'><td><strong>Sender's Name:</strong> </td><td>" . $name . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
  		$message .= "<tr><td><strong>This Person Assumes Responsibility of the Event:</strong> </td><td>" . $responsible . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Organization Name:</strong> </td><td>" . $orgName . "</td></tr>";
  		$message .= "<tr><td><strong>Organization Type:</strong> </td><td>" . $orgType . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Phone:</strong> </td><td>" . $phone . "</td></tr>";
  		$message .= "<tr><td><strong>Type of Request</strong> </td><td>" . $request . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Estimated Funds:</strong> </td><td>" . $funds . "</td></tr>";
  		$message .= "<tr><td><strong>How Funds will be Used:</strong> </td><td>" . nl2br($fundsDesc) . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Event Name:</strong> </td><td>" . $eventName . "</td></tr>";
  		$message .= "<tr><td><strong>College Wide?:</strong> </td><td>" . $collegeWide . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Event Start:</strong> </td><td>" . $eventStart . " </td></tr>";
  		$message .= "<tr><td><strong>Event End:</strong> </td><td>" . $eventEnd . " </td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Event Time Start:</strong> </td><td>" . date('h:i:s a' , strtotime($time1)). " </td></tr>";
  		$message .= "<tr><td><strong>Event Time End:</strong> </td><td>" . date('h:i:s a' , strtotime($time2)). " </td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Number of Attendees:</strong> </td><td>" . $attendees . "</td></tr>";
  		$message .= "<tr><td><strong>Location:</strong> </td><td>" . $location . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Room Number or Name:</strong> </td><td>" . $roomNumber . "</td></tr>";
  		$message .= "<tr><td><strong>Description of Event:</strong> </td><td>" . nl2br($eventDesc) . "</td></tr>";
  		$message .= "<tr style='background: #EEEEEE;'><td><strong>Potential Benefits to College:</strong> </td><td>" . nl2br($benefits) . "</td></tr>";
  		$message .= "<tr><td><strong>Potential Risks to College:</strong> </td><td>" . nl2br($risks) . "</td></tr>";
  		$message .= "</table>";
  		$message .= "</body></html>";

  		mail ($to, $subject, $message, $headers);


      /*---Email to Applicant-------------------------------------*/

  		$conf_headers = "From: " . $college . " <comc@ttu.edu>\r\n";
  		$conf_headers .= "Reply-To: clara.mckenney@ttu.edu\r\n";
  		$conf_headers .= "MIME-Version: 1.0\r\n";
  		$conf_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  		$conf_to = $email;
  		$conf_subject = "Sponsorship Request Confirmation";

  		$conf_message = '<html><body>';
  		$conf_message .= '<div width="100%" style="background: #CC0000; padding:15px;">';
  		$conf_message .= "<h3 style='text-align:center; color: #FFFFFF; font-size: 32;'>Thank you for your submission " . $name . "!</h3>";
  		$conf_message .= '</div>';
  		$conf_message .= '<div width="100%">';
  		$conf_message .= "<p align=center>We will get back to you as soon as possible with an answer as to whether or not <strong>" . $eventName . "</strong> has been approved for sponsorship from the College of Media &amp; Communication</p>";
  		$conf_message .= "<p align=center>To check in on your request please email <a href='mailto:clara.mckenney@ttu.edu'> Clara McKenney</a>.";
  		$conf_message .= '</div>';
  		$conf_message .= '</body></html>';

  		mail ($conf_to, $conf_subject, $conf_message, $conf_headers);


    }

  ?>

  <h2>Thank You!</h2>
  <p>
    We have received your request! If you have any questions or need anything else, please contact <a href="mailto:clara.mckenney@ttu.edu" class="mail">Clara McKenney</a>.
  </p>

  <?php if (isset($_POST["e_form"])): ?>
    <p>Submission of this application does not guarantee approval of a sponsorship request. Your application will be reviewed by the sponsorship committee as soon as possible. Please contact <a href='mailto:clara.mckenney@ttu.edu'>Clara McKenney</a> if you have any questions on your sponsorship request, or would like to check on the status of the request.</p>
  <?php endif; ?>

  <?php else: ?>

  <h2>Please select if you have a project request or an event request.</h2>
  <form id="type-request" name="type-request">
    <select id="type-selection" name="type-selection">
      <option>
        -- Please Select --
      </option>
      <option value="project">
        Project Request
      </option>
      <option value="event">
        Event Request
      </option>
    </select>
  </form>

  <section id="forms">

    <p>
      It is very helpful for us to have all information at least three weeks ahead of your project's deadline. Some projects will carry more clout and may put other projects on hold. We reserve the right to refuse a project if we do not have time to complete it with optimal quality. Contact <a href="mailto:clara.mckenney@ttu.edu" class="mail">Clara McKenney</a> if you have any questions.
    </p>

    <form id="project-request" method="post" class="ldpforms">
      <fieldset>
        <legend>
          Contact Information
        </legend>

        <label for="p_contact_name">Name:</label>
        <input type="text" id="p_contact_name" name="p_contact_name" required="required" />

        <label for="p_department">Department:</label>
        <input type="text" id="p_department" name="p_department" required="required" />

        <label for="p_email">Email:</label>
        <input type="text" id="p_email" name="p_email" required="required" />

        <label for="p_phone">Phone Number:</label>
        <input type="text" id="p_phone" name="p_phone" required="required" />
      </fieldset>
      <fieldset>
        <legend>
          Job Information
        </legend>
        <select id="job_type" name="job_type">
          <option>
            -- Please Select --
          </option>
          <option value="Marketing Materials">
            Marketing Materials
          </option>
          <option value="Event Materials">
            Event Materials
          </option>
          <option value="Announcements">
            Announcements
          </option>
          <option value="Story Ideas">
            Story Ideas
          </option>
          <option value="Course Flier">
            Course Flier
          </option>
          <option value="Photo/Video Opportunity">
            Photo/Video Opportunity
          </option>
          <option value="Graphic Design">
            Graphic Design
          </option>
          <option value="Web">
            Web
          </option>
          <option value="Unspecified">
            Unspecified
          </option>
        </select>

        <div class="flier">
          <label for="course_title">Course Title:</label>
          <input type="text" id="course_title" name="course_title" />

          <label for="course_number">Course Number:</label>
          <input type="text" id="course_number" name="course_number" />

          <label for="course_section">Course Section:</label>
          <input type="text" id="course_section" name="course_section" />

          <label for="course_daytime">Course Day &amp; Time:</label>
          <input type="text" id="course_daytime" name="course_daytime" />

          <label for="course_professor">Professor:</label>
          <input type="text" id="course_professor" name="course_professor" />
        </div>

        <label for="p_deadline">Due Date:</label>
        <input type="date" id="p_deadline" name="p_deadline" min="2016-01-01" required="required"/>

        <label for="p_details">Project Details:</label>
        <textarea name="p_details" id="p_details" required="required"></textarea>
      </fieldset>

      <input type="submit" name="p_form" value="Submit" class="button">
      <div class="form-loader"></div>
    </form>

    <form id="event-request" class="ldpforms" method="post">
      <fieldset>
        <legend>Contact Information</legend>
        <label for="e_contact_name">Name:</label>
        <input id="e_contact_name" type="text" required="required" name="e_contact_name" />

        <label for="responsible">The person above assumes responsibility and will review all content for the event. </label>
        <input id="responsible" type="checkbox" required="required" value="Yes" name="responsible" /> Yes

        <label for="e_mail">Email Address:</label>
        <input id="e_mail" type="email" maxlength="60" required="required" size="60" name="e_mail" />

        <label for="e_phone">Phone Number:</label>
        <p>
          (format: xxx-xxx-xxxx)
        </p>
        <input id="e_phone" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" required="required" name="e_phone" />

        <label for="org_name">CoMC Department, Student Organization or External Organization Name</label>
        <p>Non-TTU/external organizations will have to pay $50.00 an hour to reserve one of CoMC's rooms/spaces.</p>
        <input id="org_name" type="text" maxlength="45" required="required" size="40" name="org_name" />
        <br />

        <input id="ttu_org" type="radio" required="required" value="TTU Organization" name="org_type" />
        <label style="display: inline-block;" for="ttu_org">TTU Organization (CoMC Organization, Student Organization, etc...)</label>
        <br />
        <input id="non_ttu_org" type="radio" value="Non-TTU Organization" name="org_type" />
        <label style="display: inline-block;" for="non_ttu_org">Non-TTU Organization</label>
      </fieldset>

      <fieldset>
        <legend>Event Details</legend>

        <label for="event_name">Event Name:</label>
        <input id="event_name" type="text" maxlength="45" required="required" size="40" name="event_name" />

        <label for="event_start">Event Date Start:</label>
        <input id="event_start" type="date" min="2015-03-26" required="required" name="event_start" /> &nbsp;&nbsp;to &nbsp;&nbsp;
        <input type="date" min="2015-03-26" required="required" name="event_end" />

        <label for="time_start">Time of Event:</label>
        <input id="time_start" type="time" required="required" step="900" name="time_start" /> &nbsp;&nbsp;to &nbsp;&nbsp;
        <input type="time" required="required" name="time_end" />

        <label for="attendees">Expected Number of Attendees:</label>
        <input id="attendees" type="number" max="1000" min="0" required="required" step="10" name="attendees" />

        <label for="college_wide">Open Attendance or Limited to Department/Organization?</label>
        <input id="college_wide" type="radio" required="required" value="Open to Department" name="college_wide" />Open
        <br /> <br />
        <input type="radio" required="required" value="Limited to Department/Organization" name="college_wide" />Limited

        <label for="location">Building/Location:</label>
        <input id="location" type="text" maxlength="40" required="required" size="40" name="location" />

        <label for="room_number">Room Number/Name:</label>
        <p>Non-TTU/external organizations will have to pay $50.00 an hour to reserve one of CoMC's rooms/spaces.</p>
        <input id="room_number" type="text" maxlength="40" required="required" size="40" name="room_number" />

        <label for="event_desc">Please provide a short description of the event and its purpose(s):</label>
        <p>(250 characters maximum):</p>
        <textarea id="event_desc" maxlength="250" name="event_desc" required="required" rows="6" cols="60"></textarea>

        <label for="request_option">Sponsorship Request Options:</label>
        <p>(More than one choice allowed)</p>
        <input id="request_option" type="checkbox" value="Use of COMC Building Space" name="request_option[]" />Use of CoMC building space.
        <br />
        <input id="request_option" type="checkbox" value="COMC Name or Logo" name="request_option[]" />CoMC name or logo.
        <br />
        <input id="request_option" type="checkbox" value="Need COMC, department, or other college entity logo" name="request_option[]" />Need CoMC, department, or other college entity logo.
        <br />
        <input id="request_option" type="checkbox" value="Funding from the COMC" name="request_option[]" />Funding from CoMC.
        <br />
        <input id="request_option" type="checkbox" value="Photographs" name="request_option[]" />Photography
        <br />
        <input id="request_option" type="checkbox" value="Video" name="request_option[]" />Video
        <br />
        <input id="request_option" type="checkbox" value="Food and/or Beverages" name="request_option[]" />Food, beverages, and/or catering of any kind.
        <br />
        <input id="request_option" type="checkbox" value="Help creating flyers and promotional materials" name="request_option[]" />Help creating flyers and promotional materials
        <br />
        <input id="request_option" type="checkbox" value="Event coordination" name="request_option[]" />Event coordinator

        <label for="funds">Estimated Funds Requested:</label>
        <select id="funds" name="funds">
          <option disabled="disabled" selected="selected">Please Select...</option>
          <option value="None">None</option>
          <option value="Less than $250">Less than $250</option>
          <option value="$200 - $500">$200 - $500</option>
          <option value="$500 - $1000">$500 - $1000</option>
          <option value="$1000-$1500">$1000-$1500</option>
          <option value="More than $1500">More than $1500</option>
        </select>

        <label for="funds_desc">Please provide a short description of how the funds will be used.</label>
        <p>If no funds are requested, please insert "N/A" <br />(250 characters maximum):</p>
        <textarea id="funds_desc" maxlength="250" name="funds_desc" required="required" rows="6" cols="60"></textarea>

        <label for="benefits">What are the benefits for the College of Media &amp; Communication and/or its students?</label>
        <p>(250 characters maximum):</p>
        <textarea id="benefits" maxlength="250" name="benefits" required="required" rows="6" cols="60"></textarea>

        <label for="risks">What are some potential risks and liabilities?</label>
        <p>(250 characters maximum):</p>
        <textarea id="risks" maxlength="250" name="risks" required="required" rows="6" cols="60"></textarea>
      </fieldset>

      <input name="e_form" type="submit" value="Submit" class="button" />
      <div class="form-loader"></div>
    </form>

  </section>

  <?php endif; ?>

  <script>

  $(document).ready(function() {


    $("#type-selection").change(function() {
      var value = $("#type-selection option:selected").val();

      if (value == "project") {
        $("#event-request").slideUp();
        $("#project-request").slideDown();
      } else if (value == "event") {
        $("#project-request").slideUp();
        $("#event-request").slideDown();
      } else {
        $("#project-request").slideUp();
        $("#event-request").slideUp();
      }
    });



    // If error and back button is pressed, form needs to show same fields
    $('#job_type').find('option:selected').each(function() {
      if($(this).attr('value') == "Course Flier") {
          $('.flier').show(10);
        } else {
          $('.flier').hide(10);
        }
    });

    // If Course Flyer is selected, show specific fields
    $('#job_type').change(function() {
      // Getting value of <select> in form
      $(this).find('option:selected').each(function() {
        // If that value is = to Course Flier
        if($(this).attr('value') == "Course Flier") {
          // Show the correct fields for the course flier
          $('.flier').show(10);
        // Vice versa from above
        } else {
          $('.flier').hide(10);
        }
      });
    });
  });
  </script>
</body>
</html>
