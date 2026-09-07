@extends('layouts.app')

@section('title', 'POS')

@section('content')
<div class="container py-4">

    {{-- Alert Error --}}
    @if(session('errors'))
        <div class="alert alert-danger mb-3 rounded-3">
            {{ session('errors') }}
        </div>
    @endif

    {{-- Container Card Utama --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-4">

            {{-- Header & Judul Halaman --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="h2 fw-bold m-0" style="color: #4b3b43;">
                    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
                </h1>
                
                {{-- Tombol Kembali --}}
                <a href="{{ route('penjualan.index') }}" 
                   class="btn px-4 py-2 rounded-3 fw-semibold shadow-sm" 
                   style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                    Kembali
                </a>
            </div>

            <div class="row g-4">

                {{-- ================= SISI KIRI: DAFTAR PRODUK ================= --}}
                <div class="col-lg-6">

                    {{-- Search Form --}}
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control rounded-start-3"
                                       placeholder="Cari produk...">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>

                    {{-- Scroll Area Produk --}}
                    <div class="product-list" style="max-height: 480px; overflow-y: auto; padding-right: 5px;">
                        @foreach ($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="mb-2">
                                @csrf
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="card border rounded-3 shadow-sm hover-shadow">
                                    <div class="card-body p-2 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($product->foto)
                                                <img src="{{ asset('storage/'.$product->foto) }}"
                                                     class="rounded shadow-sm"
                                                     style="width:48px; height:48px; object-fit:cover;">
                                            @else
                                                <div class="rounded bg-light border d-flex align-items-center justify-content-center text-muted"
                                                     style="width:48px; height:48px; font-size:10px;">
                                                    No Img
                                                </div>
                                            @endif

                                            <div>
                                                <div class="fw-bold text-dark">{{ $product->nama }}</div>
                                                <small class="text-muted">
                                                    Rp {{ number_format($product->harga_jual < 1000 ? $product->harga_jual * 1000 : $product->harga_jual, 0, ',', '.') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <input type="number"
                                                   name="quantity"
                                                   value="1"
                                                   min="1"
                                                   class="form-control form-control-sm text-center"
                                                   style="width: 55px;">

                                            {{-- Tombol Tambah Produk (+) --}}
                                            <button type="submit" class="btn btn-sm text-white fw-bold px-3 rounded-3" style="background-color: #E87A5D; border: none;">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>

                </div>

                {{-- ================= SISI KANAN: KERANJANG CHECKOUT ================= --}}
                <div class="col-lg-6">

                    <div class="p-3 rounded-4 bg-light border">

                        {{-- Tabel Keranjang --}}
                        <div class="table-responsive mb-3" style="max-height: 280px; overflow-y: auto;">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom text-muted small">
                                        <th scope="col" style="width: 30%;">Produk</th>
                                        <th scope="col" class="text-center" style="width: 22%;">Harga</th>
                                        <th scope="col" class="text-center" style="width: 15%;">Qty</th>
                                        <th scope="col" class="text-end" style="width: 23%;">Subtotal</th>
                                        @can('delete', $sale)
                                            <th scope="col" class="text-center" style="width: 10%;">Aksi</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sale->itemPenjualan as $item)
                                        @php
                                            $hargaItem = $item->produk?->harga_jual ?? 0;
                                            $hargaFixed = $hargaItem < 1000 ? $hargaItem * 1000 : $hargaItem;
                                            $subtotalFixed = $item->subtotal < 1000 ? $item->subtotal * 1000 : $item->subtotal;
                                        @endphp
                                        <tr>
                                            <td class="fw-medium text-dark text-truncate" style="max-width: 110px;">
                                                {{ $item->produk?->nama ?? 'Produk Dihapus' }}
                                            </td>

                                            <td class="text-center text-muted small">
                                                Rp {{ number_format($hargaFixed, 0, ',', '.') }}
                                            </td>

                                            <td class="text-center">
                                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number"
                                                           name="quantity"
                                                           value="{{ $item->kuantitas }}"
                                                           min="1"
                                                           class="form-control form-control-sm text-center mx-auto px-1"
                                                           style="width: 55px;"
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>

                                            <td class="text-end fw-bold" style="color: #E87A5D;">
                                                Rp {{ number_format($subtotalFixed, 0, ',', '.') }}
                                            </td>

                                            @can('delete', $sale)
                                                <td class="text-center">
                                                    <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm py-1 px-2 fw-bold" style="font-size: 11px;">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            @endcan
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ Auth::user()->can('delete', $sale) ? 5 : 4 }}" class="text-center text-muted py-4">
                                                Keranjang masih kosong
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        {{-- Total Pembayaran --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fs-5 fw-bold text-dark">Total</span>
                            <span class="fs-4 fw-bold" style="color: #E87A5D;">
                                Rp {{ number_format($sale->total_pembayaran < 1000 ? $sale->total_pembayaran * 1000 : $sale->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Form Checkout --}}
                        <form method="POST"
                              action="{{ route('penjualan.update', $sale->id) }}"
                              onsubmit="return confirm('Yakin ingin checkout?')">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <select name="payment_method" class="form-select rounded-3" required>
                                    <option value="" disabled {{ empty($sale->metode_pembayaran) ? 'selected' : '' }}>Pilih Pembayaran</option>
                                    <option value="CASH" @selected($sale->metode_pembayaran === 'CASH')>Cash</option>
                                    <option value="QRIS" @selected($sale->metode_pembayaran === 'QRIS')>QRIS</option>
                                </select>
                            </div>

                            {{-- Tombol Checkout --}}
                            <button type="submit" class="btn text-white fw-bold w-100 py-2 rounded-3 shadow-sm" style="background-color: #E87A5D; border: none;">
                                Checkout
                            </button>
                        </form>

                        {{-- Tombol Batal Transaksi --}}
                        @can('delete', $sale)
                            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                                  class="mt-2">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn fw-bold w-100 py-2 rounded-3" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                                    Batalkan Transaksi
                                </button>
                            </form>
                        @endcan

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection