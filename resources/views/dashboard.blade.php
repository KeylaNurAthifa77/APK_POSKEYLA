{{-- -- CSS Tambahan Khusus Halaman Dashboard -- --}}
@push('css')
<style>
    /* Penyesuaian aksen teks coral lembut */
    .text-coral {
        color: #d86c58 !important;
    }

    /* Lingkaran pembungkus ikon ringkasan */
    .icon-shape-soft {
        width: 60px;
        height: 60px;
        background: #fde8e5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Style Banner Hero Visual: Diubah menjadi Putih Bersih */
    .hero-banner {
        background: #ffffff url('{{ asset("images/boutique-interior.jpg") }}') center/cover no-repeat;
        /* Tambahan overlay putih tipis agar gambar latar belakang sedikit tersamarkan jika ada, atau gunakan murni #ffffff */
        background-blend-mode: overlay;
        background-color: #ffffff;
        border-radius: 20px;
        color: #2d2d2d; /* Warna teks utama menjadi gelap agar kontras di atas background putih */
        padding: 40px 30px;
        border: 1px solid #fde8e5;
    }

    /* Penyesuaian warna subteks di dalam hero banner agar terbaca jelas */
    .hero-banner p {
        color: #6c757d !important;
    }

    /* Style Thumbnail Produk */
    .product-img-thumb {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #fde8e5;
    }
</style>
@endpush

{{-- Memanggil file layout utama --}}
@extends('layouts.app')

{{-- Mengirimkan nilai ke title --}}
@section('title', 'Dashboard Ringkasan')

{{-- Isi Konten Halaman --}}
@section('content')
<div class="container">

    {{-- Banner Header Visual --}}
    <div class="hero-banner mb-4 shadow-sm">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-1 text-coral">Maison Fashion Boutique</h1>
                <p class="fs-5 mb-0">
                    {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="badge rounded-pill px-4 py-3 fs-6 bg-light text-coral border shadow-sm">
                    <i class="bi bi-calendar-heart me-2"></i> Hari Ini
                </span>
            </div>
        </div>
    </div>

    {{-- ==========================================
         KARTU RINGKASAN STATISTIK
    ========================================== --}}
    <div class="row g-4 mb-5">

        {{-- Total Penjualan --}}
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Total Penjualan</small>
                        <h3 class="fw-bold mt-2 text-coral mb-0">
                            Rp {{ number_format($ringkasan['total_penjualan'] ?? 0) }}
                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-cash-stack fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jumlah Transaksi --}}
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Jumlah Transaksi</small>
                        <h3 class="fw-bold mt-2 text-coral mb-0">
                            {{ $ringkasan['total_transaksi'] ?? 0 }}
                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-cart-check-fill fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pembayaran Tunai --}}
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Pembayaran Tunai</small>
                        <h3 class="fw-bold mt-2 text-coral mb-0">
                            Rp {{ number_format($ringkasan['total_cash'] ?? 0) }}
                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-wallet2 fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Non Tunai --}}
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100 shadow-sm border-0 rounded-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Non Tunai</small>
                        <h3 class="fw-bold mt-2 text-coral mb-0">
                            Rp {{ number_format($ringkasan['total_non_tunai'] ?? 0) }}
                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-credit-card-2-front-fill fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- =========================
         INVENTORY (STOK & HABIS)
    ========================= --}}
    <div class="row g-4 mb-5">

        {{-- Stok Rendah --}}
        <div class="col-lg-6">
            <div class="dashboard-card h-100 shadow-sm border-0 rounded-4">
                <div class="card-header border-0 py-3 px-4" style="background:#fde8e5; border-radius:18px 18px 0 0;">
                    <h5 class="mb-0 fw-bold text-coral">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Produk Stok Rendah
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Produk</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset($produk->foto ?? 'images/outfit-sample.jpg') }}" class="product-img-thumb" alt="Product">
                                            <span class="fw-semibold">{{ $produk->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">{{ $produk->stok }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-check-circle-fill fs-1 d-block mb-2 text-success"></i>
                                        Semua stok masih aman
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    {{ $produkStokRendah->links() }}
                </div>
            </div>
        </div>

        {{-- Produk Habis --}}
        <div class="col-lg-6">
            <div class="dashboard-card h-100 shadow-sm border-0 rounded-4">
                <div class="card-header border-0 py-3 px-4" style="background:#fde8e5; border-radius:18px 18px 0 0;">
                    <h5 class="mb-0 fw-bold text-coral">
                        <i class="bi bi-x-circle-fill me-2"></i> Produk Habis
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Produk</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($produkStokHabis as $index => $produk)
                                <tr>
                                    <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset($produk->foto ?? 'images/outfit-sample.jpg') }}" class="product-img-thumb" alt="Product">
                                            <span class="fw-semibold">{{ $produk->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">{{ $produk->stok }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                        Tidak ada produk yang habis
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    {{ $produkStokHabis->links() }}
                </div>
            </div>
        </div>

    </div>

    {{-- =========================
         BEST SELLER
    ========================= --}}
    <div class="dashboard-card mb-5 shadow-sm border-0 rounded-4">
        <div class="card-header border-0 py-3 px-4" style="background:#fde8e5; border-radius:18px 18px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0 text-coral">
                    <i class="bi bi-trophy-fill me-2"></i> Best Seller Products
                </h4>
                <span class="badge bg-white text-coral px-3 py-2 rounded-pill">
                    {{ count($produkTerlaris) }} Produk
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="8%">#</th>
                            <th>Nama Produk</th>
                            <th width="20%" class="text-center">Sisa Stok</th>
                            <th width="20%" class="text-center">Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($produkTerlaris as $index => $produk)
                        <tr>
                            <td class="fw-bold">
                                @if($index == 0) 🥇
                                @elseif($index == 1) 🥈
                                @elseif($index == 2) 🥉
                                @else {{ $index + 1 }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset($produk->foto ?? 'images/outfit-sample.jpg') }}" class="product-img-thumb" alt="Product">
                                    <div class="fw-bold">{{ $produk->nama }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $produk->stok }}</span>
                            </td>
                            <td class="text-center">
                                <strong class="fw-bold text-coral fs-5">{{ $produk->total_terjual }}</strong>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-bar-chart-line-fill fs-1 d-block mb-3 text-secondary"></i>
                                Belum ada data penjualan.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Footer Dashboard --}}
    <div class="text-center mt-5 mb-3">
        <small class="text-muted">
            © {{ date('Y') }} POS Dashboard • Made with
            <i class="bi bi-heart-fill text-coral"></i>
        </small>
    </div>

</div>
@endsection