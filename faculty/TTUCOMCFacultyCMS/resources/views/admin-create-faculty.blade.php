@extends('layouts.master')

@section('content')

  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">

      <h3>Create Faculty Member</h3>

      <form role="form" method="POST" action="{{ url('create-faculty') }}">
        {{ csrf_field() }}

        <div class="flex-form-fields">

          <section class="top-form-fields">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="first_name">First Name</label>
              <input class="mdl-textfield__input" type="text" id="first_name" name="first_name" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="last_name">Last Name</label>
              <input class="mdl-textfield__input" type="text" id="last_name" name="last_name" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="email">Email</label>
              <input class="mdl-textfield__input" type="email" id="email" name="email" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="phone_number">Phone Number</label>
              <input class="mdl-textfield__input" type="tel" id="phone_number" name="phone_number" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="office_number">Office Number</label>
              <input class="mdl-textfield__input" type="text" id="office_number" name="office_number" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="office_hours">Office Hours</label>
              <input class="mdl-textfield__input" type="text" id="office_hours" name="office_hours" value="" />
            </div>
          <section class="top-form-fields">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="department">Department</label>
              <input class="mdl-textfield__input" type="text" id="department" name="department" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="title">Title</label>
              <input class="mdl-textfield__input" type="text" id="title" name="title" value="" />
            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <label class="mdl-textfield__label" for="research">Research</label>
              <input class="mdl-textfield__input" type="text" id="research" name="research" value="" />
            </div>

        </div>

        <br>

        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="button">Create</button>

      </form>

    </div>
  </div>

@endsection
