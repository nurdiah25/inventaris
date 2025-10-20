<style>
  /* === Styling khusus logo & teks navbar === */
  .brand-wrapper {
    display: flex;
    align-items: center;
    gap: 0;
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

  @media (max-width: 992px) {
    .navbar-brand-wrapper h4 {
      display: none;
    }
  }

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

  .nav-profile img {
    transition: transform 0.2s ease;
  }

  .nav-profile img:hover {
    transform: scale(1.05);
  }

  /* 🌄 Background Navbar pakai gambar */
  .navbar {
    background: url('{{ asset('images/cetakanimasi.jpg') }}') no-repeat center center;
    background-size: cover;
    color: #fff;
    position: relative;
    z-index: 10;
    border-bottom: 2px solid rgba(255,255,255,0.3);
    overflow: visible !important;
  }

  /* 🔳 Overlay gelap */
  .navbar::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: 1;
    pointer-events: none;
  }

  .navbar > * {
    position: relative;
    z-index: 100;
  }

  /* FIX: dropdown muncul di atas overlay */
  .navbar .dropdown-menu {
    z-index: 99999 !important;
    position: absolute !important;
    top: 100%;
    margin-top: 0.5rem;
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    animation: fadeSlide .2s ease forwards;
  }

  @keyframes fadeSlide {
    from {
      opacity: 0;
      transform: translateY(0);
    }
    to {
      opacity: 1;
      transform: translateY(10px);
    }
  }

  /* ✅ Tombol sidebar */
  .sidebar-toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 26px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.2s ease;
  }

  .sidebar-toggle-btn:hover {
    transform: scale(1.1);
  }

  /* Desktop: tombol di kiri */
  .navbar-left-btn {
    order: 0;
  }

  /* Mobile: pindahkan tombol ke kanan */
  @media (max-width: 992px) {
    .navbar-left-btn {
      order: 2;
      margin-left: auto;
    }
  }

  /* Bagian Search & Profile */
  .navbar-menu-wrapper.navbar-search-wrapper {
    position: relative;
    z-index: 3;
    flex: 1;
    justify-content: flex-end;
    padding-right: 1rem;
  }

  .nav-search .input-group {
    width: 220px;
    max-width: 100%;
  }

  .nav-search .form-control {
    border-radius: 20px;
    padding: 0.4rem 1rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
  }

  .nav-search .form-control:focus {
    box-shadow: 0 0 0 2px rgba(13,110,253,0.25);
  }

  .nav-profile.dropdown {
    position: relative;
    will-change: transform;
    transform: translateZ(0);
  }

  /* Kalender mini */
  #mini-calendar {
    width: 100%;
    font-size: 14px;
    text-align: center;
  }

  #mini-calendar div {
    user-select: none;
  }

  #mini-calendar small {
    width: 14.28%;
    text-align: center;
  }

  #mini-calendar table {
    width: 100%;
  }

  #mini-calendar th {
    font-weight: bold;
    color: #0d6efd;
    padding-bottom: 5px;
  }

  #mini-calendar td {
    width: 14.28%;
    padding: 6px 0;
  }

  #mini-calendar .today {
    background-color: #0d6efd;
    color: white;
    border-radius: 50%;
    font-weight: bold;
  }

  #realtime-clock {
    color: #fff;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
  }
</style>

<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

    <!-- Tombol Sidebar (1 tombol, adaptif posisi) -->
<!-- Tombol Sidebar (hanya satu, adaptif kiri/kanan) -->
<button class="sidebar-toggle-btn navbar-left-btn" 
        id="sidebarToggle"
        type="button">
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
        <h4 id="realtime-clock" class="mb-0 font-weight-bold d-none d-xl-block text-white"></h4>
      </li>

      <li class="nav-item dropdown me-1">
        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
           id="calendarDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-calendar mx-0"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list p-3"
             aria-labelledby="calendarDropdown" style="width: 280px;">
          <p class="mb-2 font-weight-bold text-center">Kalender</p>
          <div id="mini-calendar"></div>
        </div>
      </li>

      <li class="nav-item dropdown me-2">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
           id="notificationDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email-open mx-0"></i>
          <span class="count bg-danger" id="notif-count">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
             aria-labelledby="notificationDropdown" id="notif-list">
          <div class="d-flex justify-content-between align-items-center px-3 pt-2">
            <p class="mb-0 font-weight-normal dropdown-header">Notifikasi</p>
            <button class="btn btn-sm btn-outline-primary" id="mark-read-btn">Tandai Dibaca</button>
          </div>
          <div id="notif-items" class="mt-2"></div>
        </div>
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

    <!-- 👤 Profile dan Logout -->
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" data-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('images/profilelogo.jpg') }}" alt="Profile Logo"
               class="rounded-circle" style="width:40px; height:40px; object-fit:cover; border:2px solid #fff; margin-right:8px;">
          <span class="nav-profile-name text-dark fw-bold">{{ Auth::user()->name ?? 'User' }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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

<!-- === SCRIPT SECTION === -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const clockEl = document.getElementById('realtime-clock');
  const dayNames = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
  const monthNames = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

  function updateClock() {
    const now = new Date();
    const utc = now.getTime() + now.getTimezoneOffset() * 60000;
    const wita = new Date(utc + (8 * 60 * 60 * 1000));
    const hari = dayNames[wita.getDay()];
    const tanggal = wita.getDate().toString().padStart(2, '0');
    const bulan = monthNames[wita.getMonth()];
    const tahun = wita.getFullYear();
    const jam = wita.getHours().toString().padStart(2, '0');
    const menit = wita.getMinutes().toString().padStart(2, '0');
    const detik = wita.getSeconds().toString().padStart(2, '0');
    if (clockEl) {
      clockEl.innerHTML = `${hari}, ${tanggal} ${bulan} ${tahun} — ${jam}:${menit}:${detik} WITA`;
    }
  }

  updateClock();
  setInterval(updateClock, 1000);

  const calendar = document.getElementById("mini-calendar");
  function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();

    let table = "<table>";
    table += `<thead><tr><th colspan='7'>${monthNames[month]} ${year}</th></tr>`;
    table += "<tr><th>M</th><th>S</th><th>S</th><th>R</th><th>K</th><th>J</th><th>S</th></tr></thead><tbody><tr>";

    let dayOfWeek = firstDay.getDay();
    if (dayOfWeek === 0) dayOfWeek = 7;
    for (let i = 1; i < dayOfWeek; i++) table += "<td></td>";

    for (let d = 1; d <= daysInMonth; d++) {
      const today = new Date();
      const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();
      table += `<td class="${isToday ? "today" : ""}">${d}</td>`;
      if ((d + dayOfWeek - 1) % 7 === 0) table += "</tr><tr>";
    }

    table += "</tr></tbody></table>";
    calendar.innerHTML = table;
  }

  renderCalendar(new Date());
});
</script>
