@csrf

{{-- Row Foto Saat Ini & Preview Foto Baru --}}
<div class="row mb-3">
    @if (!empty($produk->foto))
        <div class="col-md-6 mb-2">
            <label class="form-label fw-semibold">Foto Saat Ini</label><br>
            <img src="{{ asset('storage/' . $produk->foto) }}"
                 alt="Foto Produk"
                 class="img-thumbnail rounded"
                 style="max-height:120px;object-fit:cover;">
        </div>
    @endif

    <div class="col-md-6 mb-2" id="preview-container" style="display:none;">
        <label class="form-label fw-semibold">Preview Foto Baru</label><br>
        <img id="preview"
             class="img-thumbnail rounded"
             style="max-height:120px;object-fit:cover;">
    </div>
</div>

{{-- Upload Gambar --}}
<div class="mb-3">
    <label for="foto" class="form-label fw-semibold">Gambar</label>
    <input
        type="file"
        id="foto"
        name="foto"
        onchange="previewImage(this)"
        class="form-control @error('foto') is-invalid @enderror">

    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Nama Produk (DIPERBAIKI) --}}
<div class="mb-3">
    <label for="nama" class="form-label fw-semibold">Nama Produk</label>
    <input
        type="text"
        id="nama"
        name="nama"
        class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $produk->nama ?? '') }}">

    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Jenis --}}
<div class="mb-3">
    <label for="jenis_id" class="form-label fw-semibold">Jenis</label>
    <select
        id="jenis_id"
        name="jenis_id"
        class="form-select @error('jenis_id') is-invalid @enderror"
        required>

        <option value="">-- Pilih Jenis --</option>
        @foreach($jenisList as $item)
            <option value="{{ $item->id }}"
                {{ old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_jenis }}
            </option>
        @endforeach
    </select>

    @error('jenis_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Harga Beli (DIPERBAIKI) --}}
<div class="mb-3">
    <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
    <input
        type="number"
        id="harga_beli"
        name="harga_beli"
        class="form-control @error('harga_beli') is-invalid @enderror"
        value="{{ old('harga_beli', $produk->harga_beli ?? '') }}">

    @error('harga_beli')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Harga Jual (DIPERBAIKI) --}}
<div class="mb-3">
    <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
    <input
        type="number"
        id="harga_jual"
        name="harga_jual"
        class="form-control @error('harga_jual') is-invalid @enderror"
        value="{{ old('harga_jual', $produk->harga_jual ?? '') }}">

    @error('harga_jual')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Stok --}}
<div class="mb-3">
    <label for="stock" class="form-label fw-semibold">Stok</label>
    <input
        type="number"
        id="stock"
        name="stock"
        class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $produk->stok ?? '') }}">

    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Tombol Akses (Simpan & Kembali) --}}
<div class="d-flex align-items-center gap-2 mt-4">
    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #E87A5D; border: none;">
        Simpan
    </button>

    <a href="{{ route('produk.index') }}" class="btn px-4 py-2 rounded-3 fw-semibold" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
        Kembali
    </a>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const container = document.getElementById('preview-container');

    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}
</script>