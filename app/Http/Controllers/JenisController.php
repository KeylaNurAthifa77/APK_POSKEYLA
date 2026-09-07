<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mengambil data jenis + relasi user + jumlah produk + pencarian
        $jenisList = Jenis::with(['user'])->withCount('produk') // <-- Ditambahkan with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama_jenis', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('jenis.index', compact('jenisList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ]);

        // Menyimpan nama_jenis sekaligus user_id pengunggah
        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
            'user_id'    => auth()->id(), // <-- Ditambahkan untuk menangkap ID user login
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $jenis = Jenis::findOrFail($id);

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,' . $id,
        ]);

        $jenis->update($request->only('nama_jenis'));

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenis = Jenis::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus!');
    }
}