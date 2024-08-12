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
        Schema::create('progress_rb_tematik', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tambahkan kolom sesuai kebutuhan Anda
            $table->text('description')->nullable(); // Contoh kolom lain
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_rb_tematik');
    }
};
