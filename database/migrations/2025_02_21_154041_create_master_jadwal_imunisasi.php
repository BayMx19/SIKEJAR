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
        Schema::create('master_jadwal_imunisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('master_anak')->onDelete('cascade');
            $table->date('tanggal_jadwal');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jadwal_imunisasi');
    }
};