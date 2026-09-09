

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4 p-4">

        <!-- Judul Halaman -->
        <h2 class="fw-bold text-dark mb-3">Halaman Jenis</h2>

        <!-- Alert Notifikasi -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 mb-3" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tombol Tambah Jenis -->
        <div class="mb-3">
            <button type="button" class="btn btn-danger px-3 py-2 rounded-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahJenis">
                + Tambah Jenis
            </button>
        </div>

        <!-- Form Search Full Width -->
        <form action="<?php echo e(route('jenis.index')); ?>" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control py-2 rounded-start-3" placeholder="Cari nama jenis" value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-outline-secondary px-4 rounded-end-3">Search</button>
            </div>
        </form>

        <!-- Tabel Data Jenis -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr class="text-secondary small">
                        <th style="width: 60px;">#</th>
                        <th>Nama Jenis</th>
                        <th>Dibuat Oleh</th> <!-- Header Kolom Baru -->
                        <th>Jumlah Produk</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jenisList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-bold"><?php echo e($index + 1); ?></td>
                            <td class="fw-semibold text-dark"><?php echo e($item->nama_jenis); ?></td>
                            
                            <!-- Isi Kolom User Pengunggah -->
                            <td>
                                <span class="badge bg-light text-secondary border px-2 py-1 rounded">
                                    <?php echo e($item->user->name ?? 'Tidak Diketahui'); ?>

                                </span>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    <?php echo e($item->produk_count); ?> Produk
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Tombol Edit Modal -->
                                    <button type="button" class="btn btn-warning btn-sm text-white px-2 py-1 rounded" data-bs-toggle="modal" data-bs-target="#modalEditJenis<?php echo e($item->id); ?>">
                                        Edit
                                    </button>

                                    <!-- Form Hapus -->
                                    <form action="<?php echo e(route('jenis.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Yakin hapus jenis ini?');" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm px-2 py-1 rounded">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Jenis -->
                        <div class="modal fade" id="modalEditJenis<?php echo e($item->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow rounded-4">
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title fw-bold">Edit Jenis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?php echo e(route('jenis.update', $item->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Nama Jenis</label>
                                                <input type="text" name="nama_jenis" class="form-control rounded-3" value="<?php echo e($item->nama_jenis); ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger rounded-3">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data jenis produk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Modal Tambah Jenis -->
<div class="modal fade" id="modalTambahJenis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Tambah Jenis Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo e(route('jenis.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control rounded-3" placeholder="Contoh: Makanan / Minuman" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POSKEYLA\resources\views/jenis/index.blade.php ENDPATH**/ ?>