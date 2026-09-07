@extends('layouts.app')

@section('title', 'Produk')

@section('content')
<div class="container py-4">

    {{-- Card Container Pembungkus --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-body p-4">

            {{-- Judul Halaman Produk --}}
            <h1 class="h2 fw-bold mb-3" style="color: #4b3b43;">Halaman Produk</h1>

            {{-- Tombol Tambah Produk --}}
            <div class="mb-3">
                <a href="{{ route('produk.create') }}" class="btn btn-cream fw-semibold">
                    + Tambah Produk
                </a>
            </div>

            {{-- Form Search --}}
            <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari nama produk...">

                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Tabel Data Produk --}}
            <div class="table-responsive">
                <table class="table align-middle border-0 mb-0 w-100" style="font-size: 14px;">
                    <thead>
                        <tr>
                            <th scope="col" style="color: #4b3b43; width: 3%;">#</th>
                            <th scope="col" style="color: #4b3b43; width: 20%;">User</th>
                            <th scope="col" style="color: #4b3b43; width: 8%;">Foto</th>
                            <th scope="col" style="color: #4b3b43; width: 18%;">Nama Produk</th>
                            <th scope="col" style="color: #4b3b43; width: 12%;">Jenis</th> {{-- Tambahan Kolom Jenis --}}
                            <th scope="col" style="color: #4b3b43; width: 12%;">Harga Beli</th>
                            <th scope="col" style="color: #4b3b43; width: 12%;">Harga Jual</th>
                            <th scope="col" style="color: #4b3b43; width: 5%;" class="text-center">Stok</th>
                            <th scope="col" style="color: #4b3b43; width: 10%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        @forelse($products as $product)
                        <tr class="border-0">
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Avatar Inisial --}}
                                    <div class="rounded-circle text-white d-inline-flex align-items-center justify-content-center fw-bold fs-7" 
                                         style="width: 32px; height: 32px; background-color: #d97706; flex-shrink: 0;">
                                        {{ strtoupper(substr($product->user->name ?? 'U', 0, 2)) }}
                                    </div>

                                    <div style="line-height: 1.2;">
                                        <div class="fw-medium text-dark text-truncate" style="max-width: 130px;">
                                            {{ $product->user->name ?? 'Tidak ada user' }}
                                        </div>
                                        <small class="text-muted d-block text-truncate" style="font-size: 10px; max-width: 130px;">
                                            {{ $product->user->email ?? '' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                         class="rounded shadow-sm"
                                         width="40"
                                         height="40"
                                         style="object-fit:cover;"
                                         alt="Foto Produk">
                                @else
                                    <div class="rounded border bg-light d-flex align-items-center justify-content-center text-muted" 
                                         style="width: 40px; height: 40px; font-size: 9px;">
                                        No Img
                                    </div>
                                @endif
                            </td>
                            <td class="fw-medium">{{ $product->nama }}</td>

                            {{-- Menampilkan Data Jenis --}}
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">
                                    {{ $product->jenis->nama_jenis ?? '-' }}
                                </span>
                            </td>

                            <td class="text-nowrap">
                                Rp {{ number_format($product->harga_beli < 1000 ? $product->harga_beli * 1000 : $product->harga_beli, 0, ',', '.') }}
                            </td>
                            <td class="text-nowrap">
                                Rp {{ number_format($product->harga_jual < 1000 ? $product->harga_jual * 1000 : $product->harga_jual, 0, ',', '.') }}
                            </td>

                            <td class="text-center">
                                @if($product->stok > 50)
                                    <span class="badge bg-success px-2 py-1">{{ $product->stok }}</span>
                                @elseif($product->stok > 10)
                                    <span class="badge bg-warning text-dark px-2 py-1">{{ $product->stok }}</span>
                                @else
                                    <span class="badge bg-danger px-2 py-1">{{ $product->stok }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-warning fw-bold text-white px-2 py-1" style="font-size: 12px;">
                                        Edit
                                    </a>

                                    <span class="text-muted mx-1">|</span>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger fw-bold px-2 py-1" style="font-size: 12px;" onclick="return confirm('Yakin ingin menghapus produk?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-0">
                            {{-- Colspan disesuaikan jadi 9 --}}
                            <td colspan="9" class="text-center py-4 text-muted">
                                Belum ada data produk
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-end border-0 pt-0">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>

{{-- Custom Style --}}
<style>
    .btn-cream {
        background-color: #f5e6d3;
        color: #4b3b43;
        border: 1px solid #ebd4b9;
        transition: all 0.2s ease-in-out;
    }
    .btn-cream:hover {
        background-color: #ebd4b9;
        color: #35282e;
    }

    /* Hilangkan border bawaan tabel & beri padding rapat */
    .table > :not(caption) > * > * {
        border-bottom-width: 0 !important;
        padding: 0.6rem 0.4rem !important;
    }
</style>
@endsection