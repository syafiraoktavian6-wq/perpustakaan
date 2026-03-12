<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ulasanbuku', function (Blueprint $table) {
            $table->id('UlasanID');
            $table->foreignId('UserID')->constrained('users', 'UserID')->onDelete('cascade');
            $table->foreignId('BukuID')->constrained('buku', 'BukuID')->onDelete('cascade');
            $table->text('Ulasan');
            $table->integer('Rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasanbuku');
    }
};
