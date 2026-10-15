<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wa_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_akun', 100);
            $table->string('no_wa_pengirim', 20);
            $table->string('provider', 50)->default('official');
            $table->text('api_key')->nullable();
            $table->string('phone_number_id', 100)->nullable();
            $table->enum('account_status', ['connected', 'disconnected', 'banned'])->default('disconnected');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wa_accounts');
    }
};
