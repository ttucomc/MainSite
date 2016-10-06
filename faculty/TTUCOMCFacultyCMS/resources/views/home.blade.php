@extends('layouts.master')

@section('content')

  {{-- This is where the logged in faculty memeber will see all their related content
        for their page. Here, they can edit their content and submit a request to
          have their changes reviewed. Kuhrt and Justin will then be notified of the
            changes and can approve or deny the request. I am thinking this can be done
              via email with a link to view all changes. --}}

  <div class="user-edit-form">

    <div class="demo-grid-1 mdl-grid">
      <div class="mdl-cell mdl-cell--12-col">

        <h2>Welcome {{ $user->first_name }} {{ $user->last_name }}</h2>

        <p>
          Make your changes below and click 'Submit' when you are finished.
        </p>
        <p>
          <strong>Note:</strong> Your changes are not finalized until an administrator has approved them.
        </p>

        <hr style="border-top: 2px solid black">

        <form role="form" method="POST" action="{{ url('emailAdmin') }}">
          {{ csrf_field() }}
          <div class="flex-form-fields">

            <section class="top-form-fields">

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="email">Email</label>
                <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ $user->email }}" />
              </div>

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="phone_number">Phone Number</label>
                <input class="mdl-textfield__input" type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" />
              </div>

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="office_number">Office Number</label>
                <input class="mdl-textfield__input" type="text" id="office_number" name="office_number" value="{{ $user->office_number }}" />
              </div>

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="office_hours">Office Hours</label>
                <input class="mdl-textfield__input" type="text" id="office_hours" name="office_hours" value="{{ $user->office_hours }}" />
              </div>

            </section>

            <section class="bottom-form-fields">

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="department">Department</label>
                <input class="mdl-textfield__input" type="text" id="department" name="department" value="{{ $user->department }}" />
              </div>

              <br>

              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label class="mdl-textfield__label" for="research">Research</label>
                <textarea
                  class="mdl-textfield__input"
                  rows="8"
                  id="research"
                  name="research"
                  >{{ $user->research }}
                </textarea>
              </div>

            </section>

          </div>

          <br>

          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="button">Submit</button>

        </form>

      </div>
    </div>

  </div>

@endsection
