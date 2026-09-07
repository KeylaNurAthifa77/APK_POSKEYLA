@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            {{-- Alert Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card dashboard-card border-0 p-4">
                <div class="text-center mb-4">
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-white mb-3 shadow" 
                         style="width: 90px; height: 90px; background: linear-gradient(135deg, #e83e8c, #ffd7e5); font-size: 40px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-1" style="color: #4b3b43;">Pengaturan Profil</h4>
                    <p class="text-muted small">Kelola informasi akun Anda di sini</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold small" style="color: #5c424c;">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" name="name" class="form-control bg-light border-0 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small" style="color: #5c424c;">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" name="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4" style="border-color: #f7dbe6;">

                    <h6 class="fw-bold mb-3" style="color: #4b3b43;">Ubah Password (Opsional)</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small" style="color: #5c424c;">Password Baru</label>
                        <input type="password" name="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin diubah">
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small" style="color: #5c424c;">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control bg-light border-0" placeholder="Ulangi password baru">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn text-white fw-bold py-2 rounded-3 shadow-sm" style="background-color: #e83e8c;">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection