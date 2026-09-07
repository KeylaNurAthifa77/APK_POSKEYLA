<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'jenis_id',
        'nama',
        'jenis_makanan',
        'harga_beli',
        'harga_jual',
        'stok',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Jenis
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id')->withDefault([
            'nama_jenis' => '-'
        ]);
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}