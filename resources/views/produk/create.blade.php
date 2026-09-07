@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container py-4">

    {{-- Card Container Pembungkus --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mx-auto" style="max-width: 800px;">
        <div class="card-body p-4">

            {{-- Judul Halaman --}}
            <h1 class="h2 fw-bold mb-4" style="color: #4b3b43;">Tambah Produk</h1>

            {{-- Alert Tampilan Error Jika Ada Validasi yang Gagal --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <div class="fw-bold mb-1">Terjadi kesalahan input:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Form Tambah Produk --}}
            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- 1. Gambar --}}
                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">Gambar</label>

                    {{-- Pratinjau Gambar --}}
                    <div class="mb-3 d-none" id="previewContainer">
                        <p class="text-muted small mb-1">Pratinjau Foto:</p>
                        <img id="imgPreview" 
                             src="#" 
                             alt="Pratinjau Gambar" 
                             class="img-thumbnail rounded-3 shadow-sm" 
                             style="max-height: 150px; object-fit: cover;">
                    </div>

                    {{-- Input File --}}
                    <input type="file"
                           class="form-control @error('foto') is-invalid @enderror"
                           id="foto"
                           name="foto"
                           accept="image/*"
                           onchange="previewImage(event)">

                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 2. Nama Produk --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text"
                           class="form-control @error('nama') is-invalid @enderror"
                           id="nama"
                           name="nama"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama produk"
                           required>

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 3. Jenis (Dinamis mengambil data $jenisList) --}}
                <div class="mb-3">
                    <label for="jenis_id" class="form-label fw-semibold">Jenis</label>

                    <select
                        class="form-select @error('jenis_id') is-invalid @enderror"
                        id="jenis_id"
                        name="jenis_id"
                        required>

                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenisList as $jenis)
                            <option value="{{ $jenis->id }}" {{ old('jenis_id') == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis ?? $jenis->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('jenis_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. Harga Beli --}}
                <div class="mb-3">
                    <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                    <input type="number"
                           class="form-control @error('harga_beli') is-invalid @enderror"
                           id="harga_beli"
                           name="harga_beli"
                           value="{{ old('harga_beli') }}"
                           placeholder="Masukkan harga beli"
                           required>

                    @error('harga_beli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 5. Harga Jual --}}
                <div class="mb-3">
                    <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                    <input type="number"
                           class="form-control @error('harga_jual') is-invalid @enderror"
                           id="harga_jual"
                           name="harga_jual"
                           value="{{ old('harga_jual') }}"
                           placeholder="Masukkan harga jual"
                           required>

                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 6. Stok --}}
                <div class="mb-4">
                    <label for="stok" class="form-label fw-semibold">Stok</label>
                    <input type="number"
                           class="form-control @error('stok') is-invalid @enderror"
                           id="stok"
                           name="stok"
                           value="{{ old('stok') }}"
                           placeholder="Masukkan jumlah stok"
                           required>

                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol (Simpan & Kembali) --}}
                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #E87A5D; border: none;">
                        Simpan
                    </button>

                    <a href="{{ route('produk.index') }}" class="btn px-4 py-2 rounded-3 fw-semibold" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- Script JS Preview Gambar Instan --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('previewContainer');
        const imgPreview = document.getElementById('imgPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
@endsection