<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('spica/template/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('spica/template/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('spica/template/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-scroller">
        @include('partials.navbar')

        <div class="container-fluid page-body-wrapper d-flex">
            @include('partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('partials.footer')
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('spica/template/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('spica/template/js/off-canvas.js') }}"></script>
    <script src="{{ asset('spica/template/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('spica/template/js/misc.js') }}"></script>
    <script src="{{ asset('spica/template/js/template.js') }}"></script>
</body>
</html>
