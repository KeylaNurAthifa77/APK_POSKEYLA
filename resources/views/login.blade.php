{{-- memanggil file app.blade.php --}}
@extends('layouts.app')

{{-- mengirimkan nilai ke title untuk ditampilkan --}}
@section('title', 'Login POS')

{{-- batas awal isi konten --}}
@section('content')

<style>
  /* Latar belakang lembut dengan gradasi halus */
  body {
    background: linear-gradient(135deg, #fdf6f8 0%, #f7ebee 100%);
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    min-height: 100vh;
  }

  /* Container Kartu Login Minimalis */
  .card-login {
    width: 100%;
    max-width: 400px;
    border: 1px solid rgba(243, 213, 222, 0.6);
    border-radius: 20px;
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 15px 35px rgba(220, 180, 195, 0.15);
  }

  /* Header Kartu yang Bersih & Elegan */
  .card-login .login-header {
    padding: 2.5rem 2rem 1rem 2rem;
    text-align: center;
  }

  .login-title {
    color: #4a333c;
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.5px;
    margin-bottom: 0.25rem;
  }

  .login-subtitle {
    color: #9c7885;
    font-size: 0.875rem;
    font-weight: 400;
  }

  /* Style Form & Input Field */
  .form-label {
    color: #5c424c;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 0.4rem;
  }

  .form-control-custom {
    border: 1.5px solid #f0d8e1;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    color: #4a333c;
    background-color: #faf6f8;
    transition: all 0.25s ease;
  }

  .form-control-custom:focus {
    background-color: #ffffff;
    border-color: #e5a4b9;
    box-shadow: 0 0 0 0.2rem rgba(229, 164, 185, 0.2);
    outline: none;
  }

  .form-control-custom::placeholder {
    color: #c4abb4;
  }

  /* Tombol Soft Pink & Classy */
  .btn-soft-pink {
    background-color: #e89eb4;
    border: none;
    color: #ffffff;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 10px;
    padding: 0.8rem 1rem;
    letter-spacing: 0.3px;
    box-shadow: 0 4px 12px rgba(232, 158, 180, 0.3);
    transition: all 0.25s ease;
  }

  .btn-soft-pink:hover {
    background-color: #df8ca4;
    color: #ffffff;
    box-shadow: 0 6px 16px rgba(232, 158, 180, 0.4);
    transform: translateY(-1px);
  }

  .btn-soft-pink:active {
    transform: translateY(0);
  }
</style>

<div class="card card-login position-absolute top-50 start-50 translate-middle">
  <div class="login-header">
    <div class="login-title">Selamat Datang</div>
    <div class="login-subtitle">Silakan masuk ke akun POS Anda</div>
  </div>

  <div class="card-body p-4 pt-2">
    <form action="{{ route('auth') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="nama@email.com" required>
        @error('email')
          <div class="invalid-feedback small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control form-control-custom @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="••••••••" required>
        @error('password')
          <div class="invalid-feedback small mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-soft-pink w-100">Masuk Aplikasi</button>
    </form>
  </div>
</div>

{{-- batas Akhir isi konten --}}
@endsection