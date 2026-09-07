<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request) 
    {
        $keyword = $request->input('search');

        if ($keyword) {
            $users = User::where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('email', 'LIKE', "%{$keyword}%");
            })
            ->paginate(10)
            ->withQueryString();
        } else {
            $users = User::query()->paginate(10)->withQueryString();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $dataReq = $request->validated();

        $data['name']     = $dataReq['name'];
        $data['email']    = $dataReq['email'];
        $data['password'] = Hash::make($dataReq['password']);
        $data['role_id']  = $dataReq['role_id'];

        User::create($data);

        return redirect()->route('admin.users')->with('success', 'User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $dataReq = $request->validated();

        $user->name    = $dataReq['name']; 
        $user->email   = $dataReq['email'];
        $user->role_id = $dataReq['role_id']; 

        // Update password hanya jika input password diisi
        if (!empty($dataReq['password'])) {
            $user->password = Hash::make($dataReq['password']); 
        }
        
        $user->save(); 

        // Redirect ke daftar users dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari user berdasarkan ID (mencegah error jika Route tidak cocok dengan Route Model Binding)
        $user = User::findOrFail($id);

        // 1. Mencegah user menghapus akunnya sendiri yang sedang dipakai login
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Kamu tidak dapat menghapus akunmu sendiri!');
        }

        try {
            // 2. Eksekusi hapus data
            $user->delete();
            return redirect()->back()->with('success', 'User berhasil dihapus!');

        } catch (QueryException $e) {
            // 3. Tangkap error Foreign Key (SQLSTATE 23000)
            if ($e->getCode() == '23000' || isset($e->errorInfo[1]) && $e->errorInfo[1] == 1451) {
                return redirect()->back()->with('error', 'User tidak dapat dihapus karena sudah memiliki riwayat transaksi/penjualan!');
            }

            return redirect()->back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}