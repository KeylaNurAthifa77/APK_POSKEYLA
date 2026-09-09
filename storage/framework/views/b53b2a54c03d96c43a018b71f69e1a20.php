

<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-body p-4">

            
            <h1 class="h2 fw-bold mb-3" style="color: #4b3b43;">Halaman Produk</h1>

            
            <div class="mb-3">
                <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-cream fw-semibold">
                    + Tambah Produk
                </a>
            </div>

            
            <form action="<?php echo e(route('produk.index')); ?>" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="<?php echo e(request('search')); ?>"
                           class="form-control"
                           placeholder="Cari nama produk...">

                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>

            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            
            <div class="table-responsive">
                <table class="table align-middle border-0 mb-0 w-100" style="font-size: 14px;">
                    <thead>
                        <tr>
                            <th scope="col" style="color: #4b3b43; width: 3%;">#</th>
                            <th scope="col" style="color: #4b3b43; width: 20%;">User</th>
                            <th scope="col" style="color: #4b3b43; width: 8%;">Foto</th>
                            <th scope="col" style="color: #4b3b43; width: 18%;">Nama Produk</th>
                            <th scope="col" style="color: #4b3b43; width: 12%;">Jenis</th> 
                            <th scope="col" style="color: #4b3b43; width: 12%;">Harga Beli</th>
                            <th scope="col" style="color: #4b3b43; width: 12%;">Harga Jual</th>
                            <th scope="col" style="color: #4b3b43; width: 5%;" class="text-center">Stok</th>
                            <th scope="col" style="color: #4b3b43; width: 10%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-0">
                            <td><?php echo e($products->firstItem() + $loop->index); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    
                                    <div class="rounded-circle text-white d-inline-flex align-items-center justify-content-center fw-bold fs-7" 
                                         style="width: 32px; height: 32px; background-color: #d97706; flex-shrink: 0;">
                                        <?php echo e(strtoupper(substr($product->user->name ?? 'U', 0, 2))); ?>

                                    </div>

                                    <div style="line-height: 1.2;">
                                        <div class="fw-medium text-dark text-truncate" style="max-width: 130px;">
                                            <?php echo e($product->user->name ?? 'Tidak ada user'); ?>

                                        </div>
                                        <small class="text-muted d-block text-truncate" style="font-size: 10px; max-width: 130px;">
                                            <?php echo e($product->user->email ?? ''); ?>

                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($product->foto): ?>
                                    <img src="<?php echo e(asset('storage/'.$product->foto)); ?>"
                                         class="rounded shadow-sm"
                                         width="40"
                                         height="40"
                                         style="object-fit:cover;"
                                         alt="Foto Produk">
                                <?php else: ?>
                                    <div class="rounded border bg-light d-flex align-items-center justify-content-center text-muted" 
                                         style="width: 40px; height: 40px; font-size: 9px;">
                                        No Img
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-medium"><?php echo e($product->nama); ?></td>

                            
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">
                                    <?php echo e($product->jenis->nama_jenis ?? '-'); ?>

                                </span>
                            </td>

                            <td class="text-nowrap">
                                Rp <?php echo e(number_format($product->harga_beli < 1000 ? $product->harga_beli * 1000 : $product->harga_beli, 0, ',', '.')); ?>

                            </td>
                            <td class="text-nowrap">
                                Rp <?php echo e(number_format($product->harga_jual < 1000 ? $product->harga_jual * 1000 : $product->harga_jual, 0, ',', '.')); ?>

                            </td>

                            <td class="text-center">
                                <?php if($product->stok > 50): ?>
                                    <span class="badge bg-success px-2 py-1"><?php echo e($product->stok); ?></span>
                                <?php elseif($product->stok > 10): ?>
                                    <span class="badge bg-warning text-dark px-2 py-1"><?php echo e($product->stok); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger px-2 py-1"><?php echo e($product->stok); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    
                                    <a href="<?php echo e(route('produk.edit', $product)); ?>" class="btn btn-sm btn-warning fw-bold text-white px-2 py-1" style="font-size: 12px;">
                                        Edit
                                    </a>

                                    <span class="text-muted mx-1">|</span>

                                    
                                    <form action="<?php echo e(route('produk.destroy', $product)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger fw-bold px-2 py-1" style="font-size: 12px;" onclick="return confirm('Yakin ingin menghapus produk?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="border-0">
                            
                            <td colspan="9" class="text-center py-4 text-muted">
                                Belum ada data produk
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-3 d-flex justify-content-end border-0 pt-0">
                <?php echo e($products->links()); ?>

            </div>

        </div>
    </div>

</div>


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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POSKEYLA\resources\views/produk/index.blade.php ENDPATH**/ ?>