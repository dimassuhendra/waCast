<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_pengiriman_wa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('broadcast_id')->constrained('broadcasts')->cascadeOnDelete();
            $table->foreignId('kontak_id')->constrained('kontak')->cascadeOnDelete();
            $table->string('no_wa_tujuan', 20);
            $table->text('pesan_rendered'); // Hasil replace variabel {nama}, {instansi}
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('response_api')->nullable(); // Log JSON error/success API
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_pengiriman_wa');
    }
};
