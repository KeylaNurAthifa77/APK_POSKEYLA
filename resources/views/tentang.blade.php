@extends('layouts.app')

@section('content')
<!-- Import Font Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<div style="background-color: #FDEEE9; font-family: 'Inter', sans-serif; padding: 35px 20px; min-height: 88vh;">
    
    <!-- Header Judul -->
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="color: #2D2D2D; font-weight: 800; font-size: 1.75rem; margin-bottom: 6px;">Tentang Aplikasi POS</h2>
        <p style="color: #6C757D; font-size: 0.88rem; margin: 0;">Sistem Informasi Pengelolaan Penjualan & Stok Barang</p>
    </div>

    <!-- Layout Container Utama -->
    <div style="max-width: 1140px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 24px; justify-content: center; align-items: stretch;">
        
        <!-- KARTU KIRI: Profil Pengembang -->
        <div style="background: #FFFFFF; border-radius: 18px; padding: 28px 24px; flex: 1 1 360px; max-width: 420px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); display: flex; flex-direction: column; justify-content: space-between; text-align: center;">
            <div>
                <!-- Avatar Foto Profil Bulat -->
                <div style="width: 105px; height: 105px; border-radius: 50%; border: 2.5px solid #E85D4E; padding: 4px; margin: 0 auto 14px auto; background-color: #FFFFFF; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <img 
                        src="img/Profile.jpeg" 
                        alt="Foto Profil" 
                        style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; background-color: #E0E0E0;"
                        onerror="this.onerror=null; this.src='https://via.placeholder.com/150/e0e0e0/808080?text=User';"
                    />
                </div>

                <h5 style="color: #2D2D2D; font-weight: 700; font-size: 1rem; margin-bottom: 6px;">Pengembang Web & Desainer</h5>
                
                <!-- Badge Versi -->
                <div style="margin-bottom: 14px;">
                    <span style="background-color: #FFE3DD; color: #E85D4E; font-size: 0.7rem; font-weight: 700; padding: 4px 14px; border-radius: 50px; display: inline-block;">
                        Versi 1.0.0
                    </span>
                </div>

                <!-- Deskripsi Profil -->
                <p style="color: #6C757D; font-size: 0.78rem; line-height: 1.55; margin-bottom: 24px;">
                    Halo! Saya seorang pengembang web yang berfokus pada pembuatan aplikasi web modern, responsif, dan mudah digunakan.
                </p>
            </div>

            <!-- Informasi Kontak -->
            <div style="border-top: 1px solid #F0F0F0; padding-top: 16px; text-align: left;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.82rem;">
                    <tbody>
                        <tr style="height: 28px;">
                            <td style="color: #6C757D; font-weight: 600;">Pengembang:</td>
                            <td style="text-align: right; font-weight: 700; color: #2D2D2D;">littlreskeyya</td>
                        </tr>
                        <tr style="height: 28px;">
                            <td style="color: #6C757D; font-weight: 600;">Email:</td>
                            <td style="text-align: right; color: #6C757D;">keyla@gmail.com</td>
                        </tr>
                        <tr style="height: 28px;">
                            <td style="color: #6C757D; font-weight: 600;">Telepon:</td>
                            <td style="text-align: right; color: #6C757D;">+62 812 6767 9989</td>
                        </tr>
                        <tr style="height: 28px;">
                            <td style="color: #6C757D; font-weight: 600;">Alamat:</td>
                            <td style="text-align: right; color: #6C757D;">Tasikmalaya, Indonesia</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- KARTU KANAN: Fitur Layanan & Hak Akses -->
        <div style="background: #FFFFFF; border-radius: 18px; padding: 28px 28px; flex: 2 1 580px; max-width: 680px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); display: flex; flex-direction: column; justify-content: space-between;">
            
            <!-- Fitur Layanan -->
            <div>
                <h5 style="color: #2D2D2D; font-weight: 700; font-size: 1rem; margin-bottom: 16px;">Fitur Layanan Aplikasi</h5>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; margin-bottom: 24px;">
                    <!-- Fitur 1 -->
                    <div style="background-color: #F8F9FA; border-radius: 12px; padding: 14px 16px; border: 1px solid #F0F0F0;">
                        <h6 style="font-weight: 700; color: #2D2D2D; font-size: 0.85rem; margin: 0 0 5px 0;">Manajemen Produk</h6>
                        <p style="color: #6C757D; font-size: 0.75rem; margin: 0; line-height: 1.45;">Kelola daftar barang, harga jual, serta pemantauan stok menipis dan habis.</p>
                    </div>
                    <!-- Fitur 2 -->
                    <div style="background-color: #F8F9FA; border-radius: 12px; padding: 14px 16px; border: 1px solid #F0F0F0;">
                        <h6 style="font-weight: 700; color: #2D2D2D; font-size: 0.85rem; margin: 0 0 5px 0;">Transaksi Penjualan</h6>
                        <p style="color: #6C757D; font-size: 0.75rem; margin: 0; line-height: 1.45;">Prosedur transaksi kasir cepat dengan riwayat item terperinci.</p>
                    </div>
                    <!-- Fitur 3 -->
                    <div style="background-color: #F8F9FA; border-radius: 12px; padding: 14px 16px; border: 1px solid #F0F0F0;">
                        <h6 style="font-weight: 700; color: #2D2D2D; font-size: 0.85rem; margin: 0 0 5px 0;">Manajemen Pengguna</h6>
                        <p style="color: #6C757D; font-size: 0.75rem; margin: 0; line-height: 1.45;">Pengaturan data pengguna sistem dengan pembagian role bertingkat.</p>
                    </div>
                    <!-- Fitur 4 -->
                    <div style="background-color: #F8F9FA; border-radius: 12px; padding: 14px 16px; border: 1px solid #F0F0F0;">
                        <h6 style="font-weight: 700; color: #2D2D2D; font-size: 0.85rem; margin: 0 0 5px 0;">Ringkasan Dashboard</h6>
                        <p style="color: #6C757D; font-size: 0.75rem; margin: 0; line-height: 1.45;">Statistik pendapatan, total transaksi, dan indikator produk terlaris.</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Hak Akses Sistem (Warna Disesuaikan dengan Tema POS) -->
            <div>
                <h5 style="color: #2D2D2D; font-weight: 700; font-size: 1rem; margin-bottom: 12px;">Hak Akses Sistem</h5>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <!-- Role Admin (Solid Salmon/Coral Accent) -->
                    <span style="background-color: #E85D4E; color: #FFFFFF; font-size: 0.75rem; font-weight: 700; padding: 8px 16px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 8px rgba(232, 93, 78, 0.25);">
                        Role Admin: Full Access
                    </span>
                    <!-- Role Kasir (Soft Peach Accent) -->
                    <span style="background-color: #FFE3DD; color: #E85D4E; font-size: 0.75rem; font-weight: 700; padding: 8px 16px; border-radius: 8px; border: 1px solid #FCD3CB; display: inline-block;">
                        Role Kasir: Transaksi & Stok
                    </span>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection