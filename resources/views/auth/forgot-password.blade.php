<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lupa Password - Sistem Inventaris Restu Guru</title>

  <!-- SPICA BASE CSS -->
  <link rel="stylesheet" href="{{ asset('spica/template/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('spica/template/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('spica/template/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/RGlogo.webp') }}" />

  <style>
    :root {
      --primary-color: #041941;
    }

    /* === Background penuh === */
    body {
      background: url('{{ asset('images/cetakanimasi.jpg') }}') center center/cover no-repeat fixed;
      height: 100vh;
      margin: 0;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Poppins", sans-serif;
    }

    /* === Overlay lembut === */
    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.35);
      backdrop-filter: blur(3px);
      z-index: 0;
    }

    /* === Card utama === */
    .forgot-card {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 16px;
      padding: 40px 50px;
      width: 420px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      text-align: center;
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === Logo & heading === */
    .brand-logo img {
      width: 70px;
      margin-bottom: 10px;
    }

    .brand-logo h3 {
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 5px;
    }

    .brand-logo p {
      color: #5c6570;
      font-size: 0.95rem;
    }

    h4 {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 10px;
    }

    p.text-muted {
      color: #5c6570 !important;
      font-size: 0.95rem;
    }

    /* === Input & ikon === */
    .input-group-text i {
      font-size: 20px;
      color: var(--primary-color);
    }

    .form-control {
      border-radius: 8px !important;
      border-color: #cbd3e1;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.1rem rgba(4, 25, 65, 0.25);
    }

    label {
      color: var(--primary-color);
      font-weight: 500;
    }

    /* === Tombol kirim === */
    .btn-primary {
      background-color: var(--primary-color);
      border: none;
      border-radius: 8px;
      padding: 12px;
      transition: 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #05245d;
      transform: translateY(-2px);
    }

    /* === Link balik login === */
    .back-link {
      display: inline-block;
      margin-top: 15px;
      color: var(--primary-color);
      text-decoration: none;
      transition: 0.3s;
      font-weight: 500;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    footer {
      position: absolute;
      bottom: 15px;
      width: 100%;
      text-align: center;
      color: #ffffff;
      font-size: 0.9rem;
      z-index: 1;
      text-shadow: 0 1px 3px rgba(0,0,0,0.6);
    }
  </style>
</head>

<body>
  <div class="forgot-card">
    <div class="brand-logo">
      <img src="{{ asset('images/RGlogo.webp') }}" alt="Logo">
    </div>

    <h4>Atur Ulang Password</h4>
    <p class="text-muted mb-4">
      Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.
    </p>

    <!-- STATUS BERHASIL -->
    @if (session('status'))
      <div class="alert alert-success text-center">{{ session('status') }}</div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="form-group text-start">
        <label for="email" class="fw-semibold">Email</label>
        <div class="input-group">
          <span class="input-group-text bg-transparent border-right-0">
            <i class="mdi mdi-email-outline"></i>
          </span>
          <input id="email" type="email" name="email"
                 class="form-control border-left-0 @error('email') is-invalid @enderror"
                 placeholder="Masukkan email Anda"
                 value="{{ old('email') }}" required autofocus>
        </div>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100 btn-lg">KIRIM LINK RESET PASSWORD</button>
      </div>

      <a href="{{ route('login') }}" class="back-link">
        <i class="mdi mdi-arrow-left"></i> Kembali ke Login
      </a>
    </form>
  </div>

  <footer>
    Copyright &copy; {{ date('Y') }} Restu Guru Promosindo. All rights reserved.
  </footer>

  <!-- JS -->
  <script src="{{ asset('spica/template/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('spica/template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('spica/template/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('spica/template/js/template.js') }}"></script>
</body>
</html>
