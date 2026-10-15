<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('wa_account_id')->constrained('wa_accounts')->restrictOnDelete();
            $table->foreignId('kategori_pesan_id')->nullable()->constrained('kategori_pesan')->nullOnDelete();
            $table->string('judul_campaign', 150);
            $table->text('isi_pesan'); // Mengandung placeholder {nama}, {instansi}
            $table->dateTime('waktu_jadwal')->nullable();
            $table->integer('delay_detik')->default(10);
            $table->enum('status', ['draft', 'scheduled', 'processing', 'completed', 'failed'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
