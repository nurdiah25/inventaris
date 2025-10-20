<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris</title>

    <!-- === CSS Spica (Bootstrap 4, tapi kompatibel dgn BS5 JS) === -->
    <link rel="stylesheet" href="{{ asset('spica/template/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('spica/template/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('spica/template/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('spica/template/images/favicon.png') }}" />

    <style>
    body {
        background-color: #f4f4f4;
    }

    .main-panel {
        width: calc(100% - 240px);
        min-height: 100vh;
    }

    .navbar {
        z-index: 1000;
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
        color: #084fbaff;
    }

    /* 🎨 Warna tombol utama */
    .btn-primary {
        background-color: #084fbaff !important;
        border-color: #084fbaff !important;
        color: #fff !important;
        font-weight: 500;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .btn-primary:hover {
        background-color: #084fbaff !important;
        border-color: #084fbaff !important;
        transform: translateY(-1px);
    }

    .btn-primary:active,
    .btn-primary:focus {
        background-color: #084fbaff !important;
        border-color: #084fbaff !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

  /* 📱 RESPONSIVE SIDEBAR FIX */
@media (max-width: 992px) {
  .sidebar,
  .sidebar-offcanvas {
    position: fixed !important;
    top: 0;
    left: -260px;
    width: 250px;
    height: 100vh;
    background: #084fbaff !important; /* 💙 samakan warna dengan versi web */
    z-index: 2000;
    transition: left 0.3s ease;
    box-shadow: 4px 0 12px rgba(0, 0, 0, 0.25);
    overflow-y: auto;
  }

  .sidebar .nav,
  .sidebar-offcanvas .nav {
    background-color: transparent;
  }

  .sidebar .nav-item .nav-link,
  .sidebar-offcanvas .nav-item .nav-link {
    color: #ffffffcc;
  }

  .sidebar .nav-item .nav-link.active,
  .sidebar-offcanvas .nav-item .nav-link.active {
    color: #fff !important;
    background-color: rgba(255,255,255,0.15);
  }

  .sidebar-category p {
    color: #ffffffcc !important;
  }

  .sidebar.active,
  .sidebar-offcanvas.active {
    left: 0;
  }

  .page-body-wrapper::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    z-index: 1999;
  }

  .page-body-wrapper.sidebar-open::before {
    opacity: 1;
    pointer-events: all;
  }

  .main-panel {
    width: 100%;
  }
}

    </style>
</head>

<body>
    <div class="container-scroller">
        {{-- === NAVBAR === --}}
        @include('partials.navbar')

        <div class="container-fluid page-body-wrapper">
            {{-- === SIDEBAR === --}}
            @include('partials.sidebar')

            {{-- === KONTEN UTAMA === --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                {{-- === FOOTER === --}}
                @include('partials.footer')
            </div>
        </div>
    </div>

    <!-- === LIBRARY JS === -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- === JS SPICA === -->
    <script src="{{ asset('spica/template/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('spica/template/js/off-canvas.js') }}"></script>
    <script src="{{ asset('spica/template/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('spica/template/js/misc.js') }}"></script>
    <script src="{{ asset('spica/template/js/template.js') }}"></script>

    <!-- === 🔍 Global Search === -->
    <script>
    $(document).ready(function () {
      $('#navbarSearch').on('keypress', function (e) {
        if (e.which === 13) {
          e.preventDefault();
          const keyword = $(this).val().trim().toLowerCase();
          if (keyword === '') return;
          cariDataOtomatis(keyword);
        }
      });

      const params = new URLSearchParams(window.location.search);
      if (params.has('search')) {
        cariDataOtomatis(params.get('search').toLowerCase());
      }

      function cariDataOtomatis(keyword) {
        const $tables = $('table:visible');
        if ($tables.length === 0) {
          alert('Tidak ada tabel data di halaman ini.');
          return;
        }

        let ditemukan = false;
        $tables.each(function () {
          const $table = $(this);
          const $rows = $table.find('tbody tr');
          let cocok = [];

          $rows.each(function () {
            const $row = $(this);
            const rowText = $row.text().toLowerCase();
            if (rowText.includes(keyword)) {
              cocok.push($row);
              ditemukan = true;
            }
          });

          if (cocok.length > 0) {
            const $tbody = $table.find('tbody');
            $rows.css('background', '');
            for (const $row of cocok.reverse()) $tbody.prepend($row);
            cocok.forEach($row => {
              $row.css('background', '#fff3cd');
              setTimeout(() => $row.css('background', ''), 2000);
            });
            $('html, body').animate({ scrollTop: cocok[0].offset().top - 100 }, 600);
          }
        });

        if (!ditemukan) alert('Data dengan kata "' + keyword + '" tidak ditemukan di halaman ini.');
      }
    });
    </script>

    <!-- === 🧠 Sidebar Toggle Fix === -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.querySelector('.sidebar') || document.querySelector('.sidebar-offcanvas');
      const toggleBtn = document.getElementById('sidebarToggle');
      const pageWrapper = document.querySelector('.page-body-wrapper');

      if (!sidebar || !toggleBtn) return;

      toggleBtn.addEventListener('click', function() {
        if (window.innerWidth <= 992) {
          sidebar.classList.toggle('active');
          pageWrapper.classList.toggle('sidebar-open');
        } else {
          document.body.classList.toggle('sidebar-icon-only');
        }
      });

      document.addEventListener('click', function(e) {
        if (window.innerWidth <= 992) {
          const isClickInsideSidebar = sidebar.contains(e.target);
          const isClickOnToggle = toggleBtn.contains(e.target);
          if (!isClickInsideSidebar && !isClickOnToggle) {
            sidebar.classList.remove('active');
            pageWrapper.classList.remove('sidebar-open');
          }
        }
      });

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth <= 992) {
          sidebar.classList.remove('active');
          pageWrapper.classList.remove('sidebar-open');
        }
      });
    });
    </script>

</body>
</html>
