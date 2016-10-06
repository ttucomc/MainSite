<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>COMC TTU Faculty CMS</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>

    <body>

      <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
          <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">TTU COMC Faculty CMS</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
              @if (Auth::check())
                <a class="mdl-navigation__link"
                  href="{{ url('/home') }}">
                  Home
                </a>
                <a class="mdl-navigation__link"
                  href="{{ url('/admin-create-faculty') }}">
                  Create Faculty Member
                </a>
                <a class="mdl-navigation__link"
                  href="{{ url('/logout') }}">
                  Logout
                </a>
              @endif
            </nav>
          </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
          <span class="mdl-layout-title"><small>TTU COMC Faculty CMS</small></span>
          <nav class="mdl-navigation">
            @if (Auth::check())
              <a class="mdl-navigation__link"
                href="{{ url('/home') }}">
                Home
              </a>
              <a class="mdl-navigation__link"
                href="{{ url('/admin-create-faculty') }}">
                Create Faculty Member
              </a>
              <a class="mdl-navigation__link"
                href="{{ url('/logout') }}">
                Logout
              </a>
            @endif
          </nav>
        </div>

        <main class="mdl-layout__content">
          <div class="page-content">

            @yield('content')

          </div>
        </main>

        <footer>

        </footer>

      </div>

      <script type="text/javascript" src="{{ asset('js/all.js') }}"></script>

    </body>

</html>
