<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perangkat_daerah', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->string('nama'); // Nama perangkat daerah
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('perangkat_daerah_id')->after('role')->nullable();
    
            // Jika Anda ingin menambahkan foreign key (opsional, hanya jika Anda memiliki tabel perangkat_daerah)
            $table->foreign('perangkat_daerah_id')->references('id')->on('perangkat_daerah')->onDelete('cascade');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('perangkat_daerah');
        });
    }

    public function down(): void
    {
        
    }
};
