<!DOCTYPE html>
<html>
<head>

</head>
<body>
  <h1>Faculty &amp; Staff Bio Form</h1>
  <h2>Please Select if you're faculty or staff</h2>
  <form id="fs-select" name="fs-select">
    <select name="fs-selection" value="fs-selection">
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

  <section id="forms">

    <form id="faculty-bio" method="post" class="ldpforms">
      <fieldset>
        <legend>
          Faculty
        </legend>

        <span>
          <label for="f_name">Name:</label>
          <input type="text" id="f_name" name="f_name" required="required" />
        </span>

        <span>
          <label for="f_title">Title:</label>
          <input type="text" id="f_title" name="f_title" required="required" />
        </span>

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

        <input type="submit" value="Submit" class="button">
      </fieldset>
    </form>

  </section>

</body>
</html>
