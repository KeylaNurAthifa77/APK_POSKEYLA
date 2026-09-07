@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')
<div class="container py-4">

    {{-- Alert Error --}}
    @if (session('errors'))
        <div class="alert alert-danger mb-3">
            {{ session('errors') }}
        </div>
    @endif

    {{-- Card Container Pembungkus --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-4">

            {{-- Judul Halaman --}}
            <h1 class="h2 fw-bold mb-3" style="color: #4b3b43;">Halaman Penjualan</h1>

            {{-- Tombol Create (Warna Cream Gelap) --}}
            <div class="mb-3">
                <a href="{{ route('penjualan.create') }}" class="btn fw-semibold" style="background-color: #eadbc8; color: #4b3b43; border: 1px solid #d6c5b0;">
                    + Tambah Penjualan
                </a>
            </div>

            {{-- Form Search --}}
            <form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ request()->search }}"
                           class="form-control"
                           placeholder="Cari penjualan berdasarkan kasir!">

                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>

            {{-- Tabel Data Penjualan --}}
            <div class="table-responsive">
                <table class="table align-middle custom-compact-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4%;">#</th>
                            <th scope="col" style="width: 18%;">Tanggal Transaksi</th>
                            <th scope="col" style="width: 22%;">Kasir</th>
                            <th scope="col" style="width: 18%;">Total Pembayaran</th>
                            <th scope="col" style="width: 15%;">Metode Pembayaran</th>
                            <th scope="col" style="width: 11%;">Status</th>
                            <th scope="col" style="width: 12%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <th scope="row">{{ $sales->firstItem() + $loop->index }}</th>
                            <td>{{ $sale->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $sale->user->name ?? '-' }}</td>
                            <td>Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                            <td>{{ $sale->metode_pembayaran }}</td>
                            <td>{{ $sale->status }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-1">
                                    
                                    {{-- Kondisi 1: Jika status COMPLETED, tampilkan HANYA tombol Detail --}}
                                    @if(strtoupper($sale->status) === 'COMPLETED')
                                        <a href="{{ route('penjualan.show', $sale) }}" 
                                           class="btn btn-action-sm fw-semibold text-white" 
                                           style="background-color: #84a98c; border-color: #84a98c;">
                                            Detail
                                        </a>

                                    {{-- Kondisi 2: Jika status OPEN, tampilkan HANYA Edit & Hapus --}}
                                    @else
                                        @can('view', $sale)
                                            <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-action-sm btn-warning fw-semibold text-dark">
                                                Lanjutkan
                                            </a>
                                        @endcan

                                        @if(auth()->user()->can('view', $sale) && auth()->user()->can('delete', $sale))
                                            <span class="text-muted small">|</span>
                                        @endif

                                        @can('delete', $sale)
                                            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-action-sm btn-danger fw-semibold"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">Data Tidak Ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-end">
                {{ $sales->links() }}
            </div>

        </div>
    </div>

</div>

{{-- Styling Khusus Ukuran Kompak --}}
<style>
    .custom-compact-table {
        font-size: 0.815rem; /* Ukuran font ~13px */
    }

    .custom-compact-table th,
    .custom-compact-table td {
        padding: 0.5rem 0.4rem !important; /* Jarak antar baris & kolom lebih rapat */
        white-space: nowrap;
    }

    .btn-action-sm {
        font-size: 0.72rem !important; /* Ukuran teks tombol aksi */
        padding: 0.15rem 0.45rem !important; /* Padding ringkas */
        line-height: 1.2;
        border-radius: 4px;
    }
</style>
@endsection