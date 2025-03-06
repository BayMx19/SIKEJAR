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
        Schema::create('master_imunisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('master_anak')->onDelete('cascade');
            $table->date('tanggal_imunisasi');
            $table->float('berat_badan')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->string('status')->default('Belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_imunisasi');
    }
};