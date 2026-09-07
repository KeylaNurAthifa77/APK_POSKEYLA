<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        $query = Produk::with(['user', 'jenis']);

        if ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        }

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $jenisList = Jenis::all();
        return view('produk.create', compact('jenisList'));
    }

    public function store(Request $request)
    {
        // 1. Sesuaikan nama inputan dengan Form Blade (Bahasa Indonesia)
        $dataReq = $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_id'      => 'nullable|exists:jenis,id',
            'jenis_makanan' => 'nullable|string|max:255',
            'harga_beli'    => 'required|numeric',
            'harga_jual'    => 'required|numeric',
            'stok'          => 'nullable|numeric',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $hargaBeli = $dataReq['harga_beli'] < 1000 ? $dataReq['harga_beli'] * 1000 : $dataReq['harga_beli'];
        $hargaJual = $dataReq['harga_jual'] < 1000 ? $dataReq['harga_jual'] * 1000 : $dataReq['harga_jual'];

        // 2. Pemetaan data ke kolom database
        $data = [
            'user_id'       => Auth::id(),
            'jenis_id'      => $dataReq['jenis_id'] ?? null,
            'nama'          => $dataReq['nama'],
            'jenis_makanan' => $dataReq['jenis_makanan'] ?? '',
            'harga_beli'    => $hargaBeli,
            'harga_jual'    => $hargaJual,
            'stok'          => $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Produk $produk)
    {
        $jenisList = Jenis::all();
        return view('produk.edit', compact('produk', 'jenisList'));
    }

    public function update(Request $request, Produk $produk)
    {
        // Sesuaikan juga untuk method update
        $dataReq = $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis_id'      => 'nullable|exists:jenis,id',
            'jenis_makanan' => 'nullable|string|max:255',
            'harga_beli'    => 'required|numeric',
            'harga_jual'    => 'required|numeric',
            'stok'          => 'nullable|numeric',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $hargaBeli = $dataReq['harga_beli'] < 1000 ? $dataReq['harga_beli'] * 1000 : $dataReq['harga_beli'];
        $hargaJual = $dataReq['harga_jual'] < 1000 ? $dataReq['harga_jual'] * 1000 : $dataReq['harga_jual'];

        $data = [
            'user_id'       => Auth::id(),
            'jenis_id'      => $dataReq['jenis_id'] ?? null,
            'nama'          => $dataReq['nama'],
            'jenis_makanan' => $dataReq['jenis_makanan'] ?? '',
            'harga_beli'    => $hargaBeli,
            'harga_jual'    => $hargaJual,
            'stok'          => $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        try {
            $produk->delete();

            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            return redirect()
                ->route('produk.index')
                ->with('success', 'Produk berhasil dihapus!');

        } catch (QueryException $e) {
            if ($e->getCode() === '23000' || (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1451)) {
                return redirect()
                    ->route('produk.index')
                    ->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi penjualan!');
            }

            return redirect()
                ->route('produk.index')
                ->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}