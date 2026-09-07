@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container py-4">

    {{-- Card Container Pembungkus --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-4">

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Judul Halaman Users --}}
            <h1 class="h2 fw-bold mb-3" style="color: #4b3b43;">Halaman Users</h1>

            {{-- Tombol Tambah User dengan Ikon Plus --}}
            <div class="mb-3">
                <a href="{{ route('admin.users.create') }}" class="btn fw-semibold" style="background-color: #eadbc8; color: #4b3b43; border: 1px solid #d6c5b0;">
                    <i class="bi bi-plus-lg me-1"></i> Tambah User
                </a>
            </div>

            {{-- Form Search --}}
            <form action="{{ route('admin.users') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari nama user...">

                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>

            {{-- Tabel Data Users --}}
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name ?? $user->role }}</td>

                            <td>
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning me-1">
                                    Edit Akun
                                </a>

                                {{-- Form & Tombol Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-end">
                {{ $users->links() }}
            </div>

        </div>
    </div>

</div>
@endsection