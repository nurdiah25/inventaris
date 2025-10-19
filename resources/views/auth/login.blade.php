<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - Sistem Inventaris Restu Guru</title>

  <!-- SPICA BASE CSS -->
  <link rel="stylesheet" href="{{ asset('spica/template/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('spica/template/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('spica/template/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/RGlogo.webp') }}" />

  <style>
    /* === Warna utama biru tua === */
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

    /* === Card login melayang === */
    .login-card {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 16px;
      padding: 40px 50px;
      width: 400px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* === Logo dan judul === */
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

    /* === Tombol login === */
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

    /* === Checkbox & label === */
    .form-check-input {
      width: 18px;
      height: 18px;
      accent-color: var(--primary-color);
      cursor: pointer;
    }

    .form-check-label {
      color: #5c6570;
    }

    /* === Link === */
    a.text-primary {
      color: var(--primary-color) !important;
      font-weight: 500;
    }

    a.text-primary:hover {
      text-decoration: underline;
    }

    /* === Footer copyright === */
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
  <div class="login-card text-center">
    <div class="brand-logo">
      <img src="{{ asset('images/RGlogo.webp') }}" alt="Logo">
      <h3>Selamat Datang</h3>
      <p>Masuk ke sistem untuk melanjutkan</p>
    </div>

    <!-- FORM LOGIN -->
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div class="form-group text-start">
        <label for="email">Email</label>
        <div class="input-group">
          <span class="input-group-text bg-transparent border-right-0">
            <i class="mdi mdi-account-outline"></i>
          </span>
          <input id="email" type="email" name="email"
            class="form-control border-left-0 @error('email') is-invalid @enderror"
            placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
        </div>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <!-- Password -->
      <div class="form-group text-start mt-3">
        <label for="password">Password</label>
        <div class="input-group">
          <span class="input-group-text bg-transparent border-right-0">
            <i class="mdi mdi-lock-outline"></i>
          </span>
          <input id="password" type="password" name="password"
            class="form-control border-left-0 @error('password') is-invalid @enderror"
            placeholder="Masukkan password" required>
        </div>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <!-- Remember Me + Lupa Password -->
      <div class="d-flex justify-content-between align-items-center my-3">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">Lupa password?</a>
        @endif
      </div>

      <!-- Tombol Login -->
      <div class="mt-4">
        <button type="submit" class="btn btn-primary w-100 btn-lg">LOGIN</button>
      </div>
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
