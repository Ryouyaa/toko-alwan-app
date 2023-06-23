<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="/">
        <img src="/images/logo.png" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="/">
        <img src="/images/favicon.png" alt="logo" />
      </a>
    </div>
  </div>


  <div class="navbar-menu-wrapper d-flex align-items-top" id="profile">
    <ul class="navbar-nav ms-auto">
      @auth
      <p class="mb-0">{{ auth()->user()->name }}</p>
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="/images/faces/anon.jpg" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-xs rounded-circle" src="/images/faces/anon.jpg" alt="Profile image">
            <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
            <p class="fw-light text-muted mb-0">{{ auth()->user()->nomor_hp }}</p>
          </div>
          <a href="/profil" class="dropdown-item"><i
              class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>My Profile</a>
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="dropdown-item"><i
                class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Logout</button>
          </form>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a href="/login" class="btn btn-primary btn-rounded btn-sm">Login</a>
      </li>
      @endauth
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>