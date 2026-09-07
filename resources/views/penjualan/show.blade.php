@extends('layouts.app')

@section('title', 'Bukti Transaksi')

@section('content')
<div class="container py-4">

    {{-- Judul & Status Bukti --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold mb-1" style="color: #4b3b43;">
                Bukti Transaksi #{{ $penjualan->id }}
            </h1>
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold">
                <i class="bi bi-check-circle-fill me-1"></i> Transaksi Sah / Valid
            </span>
        </div>
        <div>
            <a href="{{ route('penjualan.index') }}" 
               class="btn px-4 py-2 rounded-3 fw-semibold shadow-sm" 
               style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                Kembali
            </a>
        </div>
    </div>

    {{-- ================= INFORMASI TRANSAKSI ================= --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 overflow-hidden">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3 pb-2 border-bottom text-dark">Detail Ringkasan</h5>
            
            <div class="row g-3 align-items-center">
                {{-- Kasir --}}
                <div class="col-md-3 col-6">
                    <small class="text-muted d-block mb-1">Kasir</small>
                    <span class="fw-bold text-dark fs-6">{{ $penjualan->user->name ?? '-' }}</span>
                </div>

                {{-- Waktu --}}
                <div class="col-md-3 col-6">
                    <small class="text-muted d-block mb-1">Tanggal & Waktu</small>
                    <span class="fw-bold text-dark fs-6">
                        {{ $penjualan->created_at ? $penjualan->created_at->format('d M Y, H:i') : '-' }}
                    </span>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="col-md-2 col-6">
                    <small class="text-muted d-block mb-1">Metode Pembayaran</small>
                    <span class="badge px-3 py-2 rounded-2 fw-bold" style="background-color: #F3E8E8; color: #E87A5D; border: 1px solid #E87A5D;">
                        {{ strtoupper($penjualan->metode_pembayaran ?? 'CASH') }}
                    </span>
                </div>

                {{-- Status --}}
                <div class="col-md-2 col-6">
                    <small class="text-muted d-block mb-1">Status Transaksi</small>
                    <span class="badge px-3 py-2 rounded-2 fw-bold text-white" style="background-color: #E87A5D;">
                        {{ strtoupper($penjualan->status ?? 'COMPLETED') }}
                    </span>
                </div>

                {{-- Total --}}
                <div class="col-md-2 col-12 text-md-end">
                    <small class="text-muted d-block mb-1">Total Pembayaran</small>
                    <span class="fs-5 fw-bold" style="color: #E87A5D;">
                        Rp {{ number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= TABEL ITEM PRODUK ================= --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3 pb-2 border-bottom text-dark">Rincian Item</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="border-bottom text-muted small">
                            <th scope="col" style="width: 40%;">Produk</th>
                            <th scope="col" class="text-center" style="width: 20%;">Harga Satuan</th>
                            <th scope="col" class="text-center" style="width: 15%;">Qty</th>
                            <th scope="col" class="text-end" style="width: 25%;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualan->itemPenjualan as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if(optional($item->produk)->foto)
                                            <img src="{{ asset('storage/' . $item->produk->foto) }}"
                                                 alt="{{ $item->produk->nama }}"
                                                 class="rounded shadow-sm"
                                                 style="width:40px; height:40px; object-fit:cover;">
                                        @else
                                            <div class="rounded bg-light border d-flex align-items-center justify-content-center text-muted"
                                                 style="width:40px; height:40px; font-size:10px;">
                                                No Img
                                            </div>
                                        @endif
                                        <span class="fw-medium text-dark">
                                            {{ $item->produk->nama ?? 'Produk telah dihapus' }}
                                        </span>
                                    </div>
                                </td>

                                <td class="text-center text-muted">
                                    Rp {{ number_format($item->harga_satuan ?? $item->produk->harga_jual ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="text-center fw-bold">
                                    {{ $item->kuantitas }}
                                </td>

                                <td class="text-end fw-bold" style="color: #E87A5D;">
                                    Rp {{ number_format($item->subtotal ?? ($item->kuantitas * ($item->harga_satuan ?? 0)), 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Tidak ada item pada transaksi ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="border-top">
                            <td colspan="3" class="text-end fw-bold fs-5 pt-3">Total Akhir</td>
                            <td class="text-end fw-bold fs-4 pt-3" style="color: #E87A5D;">
                                Rp {{ number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection