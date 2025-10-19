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
        /* styling tambahan untuk tombol logout di dropdown */
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- === JS SPICA === -->
    <script src="{{ asset('spica/template/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('spica/template/js/off-canvas.js') }}"></script>
    <script src="{{ asset('spica/template/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('spica/template/js/misc.js') }}"></script>
    <script src="{{ asset('spica/template/js/template.js') }}"></script>

    <!-- === jQuery untuk Global Search === -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#navbarSearch').on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                const keyword = $(this).val().trim().toLowerCase();
                if (keyword === '') return;

                const currentPath = window.location.pathname;

                // Pemetaan halaman dan ID tabel/div utama
                const pageMap = {
                    '/dashboard': '#dashboardContainer',
                    '/banjarbaru/barang': '#tableBarang',
                    '/banjarbaru/stok': '#tableStok',
                    '/banjarbaru/riwayat': '#tableRiwayat',
                    '/martapura/barang': '#tableBarang',
                    '/martapura/stok': '#tableStok',
                    '/martapura/riwayat': '#tableRiwayat',
                    '/lianganggang/barang': '#tableBarang',
                    '/lianganggang/stok': '#tableStok',
                    '/lianganggang/riwayat': '#tableRiwayat',
                    '/gudangpusat/barang': '#tableBarang',
                    '/gudangpusat/stok': '#tableStok',
                    '/gudangpusat/pengiriman': '#tablePengiriman'
                };

                let targetTable = null;
                Object.keys(pageMap).forEach(path => {
                    if (currentPath.includes(path)) targetTable = pageMap[path];
                });

                if (targetTable) {
                    cariData(keyword, targetTable);
                } else {
                    window.location.href = currentPath + '?search=' + encodeURIComponent(keyword);
                }
            }
        });

        // Auto search jika ada parameter ?search=
        const params = new URLSearchParams(window.location.search);
        if (params.has('search')) {
            const keyword = params.get('search').toLowerCase();
            const currentPath = window.location.pathname;

            const pageMap = {
                '/dashboard': '#dashboardContainer',
                '/banjarbaru/barang': '#tableBarang',
                '/banjarbaru/stok': '#tableStok',
                '/banjarbaru/riwayat': '#tableRiwayat',
                '/martapura/barang': '#tableBarang',
                '/martapura/stok': '#tableStok',
                '/martapura/riwayat': '#tableRiwayat',
                '/lianganggang/barang': '#tableBarang',
                '/lianganggang/stok': '#tableStok',
                '/lianganggang/riwayat': '#tableRiwayat',
                '/gudangpusat/barang': '#tableBarang',
                '/gudangpusat/stok': '#tableStok',
                '/gudangpusat/pengiriman': '#tablePengiriman'
            };

            Object.keys(pageMap).forEach(path => {
                if (currentPath.includes(path)) cariData(keyword, pageMap[path]);
            });
        }

        // Fungsi pencarian universal
        function cariData(keyword, selector) {
            let ditemukan = false;
            $(selector + ' *').each(function () {
                const text = $(this).text().toLowerCase();
                if (text.includes(keyword)) {
                    $(this).css('background', '#fff3cd');
                    $('html, body').animate({ scrollTop: $(this).offset().top - 100 }, 600);
                    ditemukan = true;
                    return false;
                } else {
                    $(this).css('background', '');
                }
            });
            if (!ditemukan) alert('Data dengan kata "' + keyword + '" tidak ditemukan di halaman ini.');
        }
    });
    </script>
</body>
</html>
