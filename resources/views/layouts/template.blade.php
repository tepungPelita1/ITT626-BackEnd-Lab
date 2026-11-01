<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Timetable</title>

  <!-- Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Bootstrap 4 base (grid, forms, utilities) -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- App design system -->
  <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
  <script>
    (function () {
      try {
        var saved = localStorage.getItem('theme');
        var dark = saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (dark) document.documentElement.classList.add('dark');
      } catch (e) {}
    })();
  </script>
  @stack('styles')
</head>
<body>
<div class="shell" id="appShell">

  <!-- Sidebar -->
  <aside class="side">
    <div class="side-head">
      <a href="{{ route('home') }}" class="side-logo">Timetable</a>
      <button type="button" class="side-toggle" onclick="toggleSidebar()" aria-label="Close menu">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <a href="{{ route('timetables.create') }}" class="btn">
      <i class="fas fa-plus"></i> New timetable
    </a>

    <nav class="nav">
      <span class="nav-group">Menu</span>
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt icon icon-ink"></i> Dashboard
      </a>
      <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
        <i class="fas fa-users icon icon-pink"></i> Students
      </a>
      <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
        <i class="fas fa-book-open icon icon-orange"></i> Subjects
      </a>
      <a href="{{ route('halls.index') }}" class="{{ request()->routeIs('halls.*') ? 'active' : '' }}">
        <i class="fas fa-door-open icon icon-green"></i> Halls
      </a>
      <a href="{{ route('groups.index') }}" class="{{ request()->routeIs('groups.*') ? 'active' : '' }}">
        <i class="fas fa-layer-group icon icon-yellow"></i> Groups
      </a>
      <a href="{{ route('days.index') }}" class="{{ request()->routeIs('days.*') ? 'active' : '' }}">
        <i class="fas fa-calendar-day icon icon-blue"></i> Days
      </a>
      <a href="{{ route('timetables.index') }}" class="{{ request()->routeIs('timetables.*') ? 'active' : '' }}">
        <i class="fas fa-clock icon icon-lav"></i> Timetables
      </a>
      <a href="{{ route('forms') }}" class="{{ request()->routeIs('forms') ? 'active' : '' }}">
        <i class="fas fa-edit icon icon-ink"></i> Forms
      </a>
    </nav>

    <div class="side-foot">
      <div class="side-user">
        <div class="avatar">{{ auth()->user()->initials() }}</div>
        <div class="who">
          <strong>{{ auth()->user()->name }}</strong>
          <span>Administrator</span>
        </div>
      </div>

      <button type="button" class="btn theme-toggle" onclick="toggleTheme()" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
        <span class="theme-label">Dark mode</span>
      </button>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn ghost" style="width: 100%;">
          <i class="fas fa-sign-out-alt"></i> Log out
        </button>
      </form>
    </div>
  </aside>

  <!-- Main -->
  <main class="main">
    <button type="button" class="side-toggle-float" onclick="toggleSidebar()" aria-label="Open menu">
      <i class="fas fa-bars"></i>
    </button>
    <div class="wrap">
      @yield('content')
    </div>
  </main>
</div>

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
<script>
  function toggleTheme() {
    var html = document.documentElement;
    var dark = html.classList.toggle('dark');
    try { localStorage.setItem('theme', dark ? 'dark' : 'light'); } catch (e) {}
    syncTheme();
  }
  function syncTheme() {
    var dark = document.documentElement.classList.contains('dark');
    var icon = document.querySelector('.theme-toggle i');
    var label = document.querySelector('.theme-label');
    if (icon) icon.className = dark ? 'fas fa-sun' : 'fas fa-moon';
    if (label) label.textContent = dark ? 'Light mode' : 'Dark mode';
  }
  syncTheme();

  function toggleSidebar() {
    var shell = document.getElementById('appShell');
    if (shell) shell.classList.toggle('is-collapsed');
  }

  // Loading state: disable submit + spinner to prevent double submit.
  document.querySelectorAll('form').forEach(function (form) {
    form.addEventListener('submit', function () {
      var btn = form.querySelector('button[type="submit"]');
      if (!btn || btn.dataset.noSpinner !== undefined) return;
      btn.classList.add('is-loading');
      btn.disabled = true;
      var spinner = document.createElement('i');
      spinner.className = 'spinner';
      btn.insertBefore(spinner, btn.firstChild);
    });
  });
</script>
</body>
</html>
