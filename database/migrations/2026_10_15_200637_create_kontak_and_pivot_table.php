<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontak', 100);
            $table->string('no_wa', 20)->unique();
            $table->string('instansi', 100)->nullable();
            $table->string('sumber_data', 50)->default('manual'); // 'manual', 'excel', 'gmaps_scraper'
            $table->json('meta_data')->nullable();               // Alamat, rating, koordinat gmaps
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('kontak_has_kategori', function (Blueprint $table) {
            $table->foreignId('kontak_id')->constrained('kontak')->cascadeOnDelete();
            $table->foreignId('kategori_kontak_id')->constrained('kategori_kontak')->cascadeOnDelete();
            $table->primary(['kontak_id', 'kategori_kontak_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_has_kategori');
        Schema::dropIfExists('kontak');
    }
};
