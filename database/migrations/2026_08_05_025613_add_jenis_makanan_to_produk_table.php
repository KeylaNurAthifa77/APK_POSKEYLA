<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('produk', function (Blueprint $table) { // Ganti 'produks' jadi 'produk'
        $table->string('jenis_makanan')->nullable();
    });
}

public function down(): void
{
    Schema::table('produk', function (Blueprint $table) { // Ganti 'produks' jadi 'produk'
        $table->dropColumn('jenis_makanan');
    });
}
};
