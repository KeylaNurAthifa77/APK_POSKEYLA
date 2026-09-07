<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';

    protected $fillable = [
        'nama_jenis',
        'keterangan',
        'user_id' // <-- Ditambahkan agar user_id bisa disimpan
    ];

    // Relasi One-to-Many ke Produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'jenis_id');
    }

    // Relasi BelongsTo ke User (Pengunggah/Pembuat)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}