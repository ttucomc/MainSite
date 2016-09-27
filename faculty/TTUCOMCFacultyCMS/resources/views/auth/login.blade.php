@extends('layouts.master')

@section('content')

  <h3>User would login using eRaider account</h3>

  <form role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="mdl-card mdl-shadow--6dp">
      <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
        <h2 class="mdl-card__title-text">eRaider Login</h2>
      </div>
      <div class="mdl-card__supporting-text">


        <div class="mdl-textfield mdl-js-textfield">
          <input class="mdl-textfield__input" type="text" id="username" />
          <label class="mdl-textfield__label" for="username">Username</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
          <input class="mdl-textfield__input" type="password" id="userpass" />
          <label class="mdl-textfield__label" for="userpass">Password</label>
        </div>

      </div>
      <div class="mdl-card__actions mdl-card--border">
        <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
          Log in
        </button>
      </div>
    </div>
    
  </form>

@endsection
