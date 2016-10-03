<!DOCTYPE html>
<html>

  <head>
    <style media="screen">
      .email-content {
        display: flex;
      }
    </style>
  </head>

  <body>

    <h3>User: {{ $first_name }} {{ $last_name }} is requesting to change the following info</h3>

    <div class="email-content">

      <section>
        <h4>Currently in DB:</h4>
        <p>
          Department: {{ $departmentDB }}
        </p>
        <p>
          Phone number: {{ $phone_numberDB }}
        </p>
        <p>
          Office number: {{ $office_numberDB }}
        </p>
        <p>
          Office hours: {{ $office_hoursDB }}
        </p>
        <p>
          Research: {{ $researchDB }}
        </p>
      </section>

      <section>
        <h4>Proposed Changes:</h4>
        <p>
          Department: {{ $request->department }}
        </p>
        <p>
          Phone number: {{ $request->phone_number }}
        </p>
        <p>
          Office number: {{ $request->office_number }}
        </p>
        <p>
          Office hours: {{ $request->office_hours }}
        </p>
        <p>
          Research: {{ $request->research }}
        </p>
      </section>

    </div>

    <a href="#">Click here</a> verify and make changes in DB.

    <a href="#">Deny</a> changes and reply with a comment.

  </body>

</html>
