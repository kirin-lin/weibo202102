<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Weibo App') - Laravel Course</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Weibo App</a>
        <ul clas="navbar-nav justify-content-end">
          <li class="nav-item"><a class="nav-link" href="/help">HELP</a><li>
          <li class="nav-item"><a class="nav-link" href="/about">ABOUT</a><li>
        </ul>
      </div>
    </nav>

    <div class="container">
      @yield("content")
    </div>
  </body>
</html>
