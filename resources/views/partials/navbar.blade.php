<style>
  /* === Styling khusus logo & teks navbar === */
  .brand-wrapper {
    display: flex;
    align-items: center;
    gap: 0px; /* jarak antara logo dan teks */
  }

  .navbar-logo {
    height: 85px;
    border-radius: 3px;
  }

  .navbar-brand-wrapper h4 {
    color: #fff;
    font-weight: 600;
    margin: 0;
  }

  /* Sembunyikan teks di layar kecil */
  @media (max-width: 992px) {
    .navbar-brand-wrapper h4 {
      display: none;
    }
  }

  /* Gaya tombol logout biar nyatu dengan dropdown */
  form.logout-form button {
    border: none;
    background: none;
    color: #212529;
    width: 100%;
    text-align: left;
    padding: 8px 16px;
  }

  form.logout-form button:hover {
    background-color: #f2f2f2;
    color: #0d6efd;
  }
</style>

<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

    <!-- Tombol Sidebar -->
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>

    <!-- Logo + Nama Brand -->
    <div class="navbar-brand-wrapper brand-wrapper">
      <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/RGlogo.webp') }}" alt="Logo Restu Guru" class="navbar-logo">
      </a>
      <h3 class="font-weight-bold mb-2 d-none d-md-block">Restu Guru Promosindo</h3>
    </div>

    <!-- Bagian kanan (tanggal + ikon) -->
    <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
      <li class="nav-item">
        <h4 class="mb-0 font-weight-bold d-none d-xl-block">
          {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </h4>
      </li>

      <!-- Messages -->
      <li class="nav-item dropdown me-1">
        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
           id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-calendar mx-0"></i>
          <span class="count bg-info">2</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="{{ asset('images/faces/face4.jpg') }}" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content flex-grow">
              <h6 class="preview-subject ellipsis font-weight-normal">David Grey</h6>
              <p class="font-weight-light small-text text-muted mb-0">The meeting is cancelled</p>
            </div>
          </a>
        </div>
      </li>

      <!-- Notifications -->
      <li class="nav-item dropdown me-2">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
           id="notificationDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email-open mx-0"></i>
          <span class="count bg-danger">1</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
             aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="mdi mdi-information mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted">Just now</p>
            </div>
          </a>
        </div>
      </li>

      <!-- Tombol menu mobile -->
      <li class="nav-item d-lg-none">
        <button class="navbar-toggler navbar-toggler-right align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </li>
    </ul>
  </div>

  <!-- Bagian Search & Profile -->
  <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <input type="text" id="navbarSearch" class="form-control" placeholder="Search Here..." aria-label="search">
        </div>
      </li>
    </ul>

    <!-- Profile dan Logout -->
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('images/faces/face5.jpg') }}" alt="profile"/>
          <span class="nav-profile-name">{{ Auth::user()->name ?? 'User' }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <!-- <a class="dropdown-item"><i class="mdi mdi-settings text-primary"></i> Settings</a> -->

          <!-- Tombol Logout -->
          <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="dropdown-item">
              <i class="mdi mdi-logout text-primary"></i> Logout
            </button>
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
