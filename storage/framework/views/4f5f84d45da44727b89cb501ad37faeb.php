<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title'); ?> | POS</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background: linear-gradient(135deg, #fff2f0 0%, #fbe4e1 50%, #fceae6 100%) !important;
            background-attachment: fixed !important;
            color:#4b3b43;
            min-height:100vh;
        }

        a{
            text-decoration:none;
        }

        /* ===========================
                NAVBAR
        =========================== */

        .navbar-custom{
            background: linear-gradient(90deg, #fde8e5, #fff2f0) !important;
            box-shadow: 0 4px 20px rgba(220, 170, 160, 0.12);
            padding: 14px 0;
            border-bottom: 1px solid #fae1dd;
        }

        .navbar-brand{
            display:flex;
            align-items:center;
            gap:12px;
            font-size:28px;
            font-weight:700;
            color:#d86c58 !important;
        }

        .logo-box{
            width:46px;
            height:46px;
            background:#f3a697;
            color:white;
            border-radius:14px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            font-weight:bold;
            box-shadow:0 8px 16px rgba(243, 166, 151, 0.3);
        }

        .navbar-nav{
            gap:12px;
        }

        .nav-link{
            color:#7a5a54 !important;
            font-weight:500;
            border-radius:10px;
            padding:10px 18px !important;
            transition:.3s;
        }

        .nav-link:hover{
            background:#fde8e5;
            color:#d86c58 !important;
        }

        .nav-link.active{
            background:#f3a697 !important;
            color:white !important;
            box-shadow:0 8px 18px rgba(243, 166, 151, 0.35);
        }

        /* Tombol Logout & Danger Primary */
        .btn-logout, .btn-danger{
            background:#e58b7a !important;
            border-color:#e58b7a !important;
            color:white !important;
            border:none;
            border-radius:12px;
            padding:10px 22px;
            font-weight:600;
            transition:.3s;
        }

        .btn-logout:hover, .btn-danger:hover{
            background:#d86c58 !important;
            border-color:#d86c58 !important;
            transform:translateY(-2px);
            color:white !important;
        }

        /* ===========================
            PAGE CONTENT
        =========================== */

        .page-content{
            padding-top:40px;
            padding-bottom:60px;
        }

        /* ===========================
             CARD
        =========================== */

        .dashboard-card{
            background:white;
            border:1px solid #fae1dd;
            border-radius:18px;
            box-shadow:0 8px 20px rgba(220, 170, 160, 0.08);
            transition:.3s;
            overflow:hidden;
        }

        .dashboard-card:hover{
            transform:translateY(-4px);
            box-shadow:0 14px 35px rgba(220, 170, 160, 0.15);
        }

        .card-header{
            border:none;
        }

        /* ===========================
            TABLE
        =========================== */

        .table{
            margin-bottom:0;
        }

        .table thead{
            background:#fde8e5;
        }

        .table thead th{
            color:#8c4a3e;
            border:none;
            font-weight:600;
        }

        .table tbody td{
            border-color:#fae1dd;
            vertical-align:middle;
        }

        .table td,
        .table th{
            padding:16px;
        }

        .table tbody tr{
            transition:.25s;
        }

        .table tbody tr:hover{
            background:#fff5f3;
        }

        /* ===========================
            BADGE
        =========================== */

        .badge-pink{
            background:#fde8e5 !important;
            color:#d86c58 !important;
            padding:8px 14px;
            border-radius:20px;
            font-weight:600;
        }

        .badge-danger-soft{
            background:#fcd5ce !important;
            color:#b03a2e !important;
            padding:8px 12px;
            border-radius:20px;
            font-weight:600;
        }

        .badge-warning-soft{
            background:#fde28d !important;
            color:#8a6200 !important;
            padding:8px 12px;
            border-radius:20px;
            font-weight:600;
        }

        /* ===========================
            PAGINATION
        =========================== */

        .pagination{
            justify-content:center;
        }

        .page-link{
            border:none;
            color:#d86c58;
            margin:0 4px;
            border-radius:10px;
        }

        .page-link:hover{
            background:#fde8e5;
            color:#d86c58;
        }

        .page-item.active .page-link{
            background:#f3a697 !important;
            color:white !important;
            border:none;
        }

        /* ===========================
            PROGRESS BAR & SCROLLBAR
        =========================== */

        .progress{
            background:#fde8e5;
            border-radius:20px;
        }

        .progress-bar{
            background-color:#f3a697;
            border-radius:20px;
        }

        ::-webkit-scrollbar{
            width:8px;
        }

        ::-webkit-scrollbar-thumb{
            background:#f3a697;
            border-radius:20px;
        }

        /* ===========================
            RESPONSIVE
        =========================== */

        @media(max-width:992px){
            .navbar-nav{
                margin-top:15px;
                gap:8px;
            }

            .btn-logout{
                width:100%;
                margin-top:10px;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('css'); ?>

</head>

<body>

    
    <?php if(auth()->guard()->check()): ?>
        <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    
    <main class="page-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html><?php /**PATH C:\laragon\www\APK_POSKEYLA\resources\views/layouts/app.blade.php ENDPATH**/ ?>