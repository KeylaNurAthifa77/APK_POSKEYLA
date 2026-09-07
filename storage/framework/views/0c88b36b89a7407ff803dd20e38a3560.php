
<?php $__env->startPush('css'); ?>
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
</style>
<?php $__env->stopPush(); ?>





<?php $__env->startSection('title', 'Dashboard Ringkasan'); ?>


<?php $__env->startSection('content'); ?>
<div class="container">

    
    <div class="row mb-4 align-items-center">
        <div class="col-lg-8">
            <h2 class="fw-bold text-dark mb-1">Dashboard Ringkasan</h2>
            <p class="text-secondary fs-5 mb-0">
                <?php echo e($tanggalHariIni->translatedFormat('l, d F Y')); ?>

            </p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <span class="badge rounded-pill px-4 py-3 fs-6" style="background:#fde8e5; color:#d86c58;">
                <i class="bi bi-calendar-heart me-2"></i> Hari Ini
            </span>
        </div>
    </div>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
    <div class="row g-4 mb-5">

        
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Total Penjualan</small>
                        <h3 class="fw-bold mt-2 text-coral">
                            Rp <?php echo e(number_format($ringkasan['total_penjualan'])); ?>

                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-cash-stack fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Jumlah Transaksi</small>
                        <h3 class="fw-bold mt-2 text-coral">
                            <?php echo e($ringkasan['total_transaksi']); ?>

                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-cart-check-fill fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Pembayaran Tunai</small>
                        <h3 class="fw-bold mt-2 text-coral">
                            Rp <?php echo e(number_format($ringkasan['total_cash'])); ?>

                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-wallet2 fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-medium">Non Tunai</small>
                        <h3 class="fw-bold mt-2 text-coral">
                            Rp <?php echo e(number_format($ringkasan['total_non_tunai'])); ?>

                        </h3>
                    </div>
                    <div class="icon-shape-soft">
                        <i class="bi bi-credit-card-2-front-fill fs-3 text-coral"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php endif; ?>

    
    <div class="row g-4 mb-5">

        
        <div class="col-lg-6">
            <div class="dashboard-card h-100">
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
                                    <th width="15%">No</th>
                                    <th>Produk</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($produkStokRendah->firstItem() + $index); ?></td>
                                    <td class="fw-semibold"><?php echo e($produk->nama); ?></td>
                                    <td class="text-center">
                                        <span class="badge-warning-soft"><?php echo e($produk->stok); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-check-circle-fill fs-1 d-block mb-2 text-success"></i>
                                        Semua stok masih aman
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    <?php echo e($produkStokRendah->links()); ?>

                </div>
            </div>
        </div>

        
        <div class="col-lg-6">
            <div class="dashboard-card h-100">
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
                                    <th width="15%">No</th>
                                    <th>Produk</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($produkStokHabis->firstItem() + $index); ?></td>
                                    <td class="fw-semibold"><?php echo e($produk->nama); ?></td>
                                    <td class="text-center">
                                        <span class="badge-danger-soft"><?php echo e($produk->stok); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                        Tidak ada produk yang habis
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    <?php echo e($produkStokHabis->links()); ?>

                </div>
            </div>
        </div>

    </div>

    
    <div class="dashboard-card mb-5">
        <div class="card-header border-0 py-3 px-4" style="background:#fde8e5; border-radius:18px 18px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0 text-coral">
                    <i class="bi bi-trophy-fill me-2"></i> Best Seller Products
                </h4>
                <span class="badge badge-pink">
                    <?php echo e(count($produkTerlaris)); ?> Produk
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
                    <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($index == 0): ?>
                                    🥇
                                <?php elseif($index == 1): ?>
                                    🥈
                                <?php elseif($index == 2): ?>
                                    🥉
                                <?php else: ?>
                                    <?php echo e($index + 1); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold"><?php echo e($produk->nama); ?></div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-pink"><?php echo e($produk->stok); ?></span>
                            </td>
                            <td class="text-center">
                                <strong class="fw-bold text-coral"><?php echo e($produk->total_terjual); ?></strong>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-bar-chart-line-fill fs-1 d-block mb-3 text-secondary"></i>
                                Belum ada data penjualan.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="text-center mt-5 mb-3">
        <small class="text-muted">
            © <?php echo e(date('Y')); ?> POS Dashboard • Made with
            <i class="bi bi-heart-fill text-coral"></i>
        </small>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS9\resources\views/dashboard.blade.php ENDPATH**/ ?>