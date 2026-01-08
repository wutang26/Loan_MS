 <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('layout') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Tukashira</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('layout') }}" class="active">Home<br></a></li>
          <li><a href="{{ route('about_external') }}">About</a></li>
          <li><a href="{{route('course_external')}}">Courses</a></li>
          <li><a href="{{ route('trainer_external') }}">Trainers</a></li>
          <li><a href="{{ route('event')}}">Events</a></li>
          <li><a href="{{ route('pricing')}}">Pricing</a></li>
          <li class="dropdown"><a href="#"><span>Accounts</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Choose One!</a></li>
              <li class="dropdown"><a href="#"><span>Account Registration</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Login</a></li>
                  <li><a href="#">Register</a></li>
                </ul>
              </li>
              <li><a href="#">Login</a></li>
              <li><a href="#">Register</a></li>
            </ul>
          </li>
          <li><a href="{{ route('contact')}}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('course')}}">Get Started</a>

    </div>
  </header>