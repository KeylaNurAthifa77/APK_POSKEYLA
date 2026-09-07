@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container py-4">

    {{-- Card Container Pembungkus --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-body p-4">

            <h1 class="h2 fw-bold mb-4" style="color: #4b3b43;">Edit User</h1>

            {{-- Form Edit User --}}
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Input Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-medium text-secondary">Nama</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium text-secondary">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" 
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Password (Opsional) --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium text-secondary">Password <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Masukkan password baru...">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Select Role (Hanya 2 Option) --}}
                <div class="mb-4">
                    <label for="role_id" class="form-label fw-medium text-secondary">Role</label>
                    <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                        <option value="1" {{ (old('role_id', $user->role_id) == 1 || strtolower($user->role->name ?? '') === 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ (old('role_id', $user->role_id) == 2 || strtolower($user->role->name ?? '') === 'kasir') ? 'selected' : '' }}>Kasir</option>
                    </select>
                    @error('role_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Akses (Simpan & Kembali) --}}
                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #E87A5D; border: none;">
                        Simpan
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn px-4 py-2 rounded-3 fw-semibold" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection