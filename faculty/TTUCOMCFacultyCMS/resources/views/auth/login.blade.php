@extends('layouts.master')

@section('content')

  <section class="login-form">

    <h3 style="margin-bottom: 1.5em;">User would login using eRaider account</h3>

    <form role="form" method="POST" action="{{ url('/login') }}">
      {{ csrf_field() }}

      <div class="mdl-card mdl-shadow--6dp">
        <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
          <h2 class="mdl-card__title-text">eRaider Login</h2>
        </div>
        <div class="mdl-card__supporting-text">


          <div class="mdl-textfield mdl-js-textfield{{ $errors->has('email') ? ' has-error' : '' }}">
            <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus />
            <label class="mdl-textfield__label" for="email">Email</label>
            @if ($errors->has('email'))
                <span class="help-block" style="font-size: 10px; color: red;">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="mdl-textfield mdl-js-textfield{{ $errors->has('password') ? ' has-error' : '' }}">
            <input class="mdl-textfield__input" type="password" id="password" name="password" required />
            <label class="mdl-textfield__label" for="password">Password</label>
            @if ($errors->has('password'))
                <span class="help-block" style="font-size: 10px; color: red;">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>

        </div>
        <div class="mdl-card__actions mdl-card--border">
          <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
            <span style="color: black;">Log in</span>
          </button>
        </div>
      </div>

    </form>

  </section>

@endsection
