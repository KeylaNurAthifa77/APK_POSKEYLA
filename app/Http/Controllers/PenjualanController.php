<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // 🔒 Filter berdasarkan role kasir
            ->when($user && optional($user->role)->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // 🔍 Search nama user/kasir
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::where('nama', 'like', '%' . $keyword . '%')
                ->orderBy('nama')
                ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
        }

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Penjualan::create([
            'user_id' => Auth::id(),
            'total_pembayaran' => $request->input('total_pembayaran'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'status' => $request->input('status'),
        ]);

        // 💡 Langsung kembali ke daftar transaksi
        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualan = Penjualan::with(['itemPenjualan.produk', 'user'])->findOrFail($id);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;
        $sale->load('itemPenjualan.produk');

        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage (CHECKOUT PROCESS).
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses!');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong!');
        }

        DB::transaction(function () use ($penjualan, $request) {

            // 1. Potong Stok Produk untuk setiap item di keranjang
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->decrement('stok', $item->kuantitas);
                }
            }

            // 2. Hitung ulang total pembayaran dari subtotal item
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            // 3. Update status transaksi menjadi COMPLETED
            $penjualan->update([
                'metode_pembayaran' => $request->input('payment_method'),
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED'
            ]);
        });

        // 💡 PERBAIKAN: Langsung redirect ke daftar Penjualan (penjualan.index)
        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diproses!');
    }

    /**
     * Remove the specified resource from storage (BATALKAN TRANSAKSI).
     */
    public function destroy(Penjualan $penjualan)
    {
        // Memastikan metode authorize dapat mendeteksi policy
        $this->authorize('delete', $penjualan);

        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('errors', 'Transaksi yang sudah selesai tidak bisa dibatalkan!');
        }

        DB::transaction(function () use ($penjualan) {

            // Hapus item keranjang dan hapus draft penjualan
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();

        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan.');
    }
}   