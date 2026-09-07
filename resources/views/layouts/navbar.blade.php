<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="logo-box">
                <i class="bi bi-bag-heart-fill"></i>
            </div>
            <div>POS</div>
        </a>

        {{-- Button Mobile --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <i class="bi bi-list fs-2 text-danger"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>

                {{-- Users --}}
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill me-1"></i> Users
                    </a>
                </li>

                {{-- Menu Jenis (Baru) --}}
                <li class="nav-item">
                    <a href="{{ route('jenis.index') }}" class="nav-link {{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill me-1"></i> Jenis
                    </a>
                </li>

                {{-- Produk --}}
                <li class="nav-item">
                    <a href="{{ route('produk.index') }}" class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam me-1"></i> Produk
                    </a>
                </li>

                {{-- Penjualan --}}
                <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link {{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
                        <i class="bi bi-cart-check-fill me-1"></i> Penjualan
                    </a>
                </li>

                {{-- Tentang --}}
                <li class="nav-item">
                    <a href="{{ route('tentang.index') }}" class="nav-link {{ request()->routeIs('tentang.*') ? 'active' : '' }}">
                        <i class="bi bi-info-circle-fill me-1"></i> Tentang
                    </a>
                </li>

            </ul>

            {{-- Right Menu --}}
            <div class="d-flex align-items-center gap-3">
                @auth
                <a href="{{ route('profile.show') }}" class="d-none d-lg-flex align-items-center text-decoration-none">
                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width:42px;height:42px;">
                        <i class="bi bi-person-fill text-danger fs-5"></i>
                    </div>
                    <div class="ms-2">
                        <small class="text-muted d-block style-subtext" style="font-size: 11px;">Selamat Datang</small>
                        <strong style="color: #4b3b43;">{{ Auth::user()->name }}</strong>
                    </div>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout d-flex align-items-center gap-1">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
                @endauth
            </div>
        </div>

    </div>
</nav>