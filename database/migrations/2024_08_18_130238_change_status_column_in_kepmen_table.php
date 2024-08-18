<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusColumnInKepmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            // Ubah kolom status menjadi ENUM
            $table->enum('status', ['aktif', 'nonaktif'])->change();
        });

        Schema::table('kepmen_db', function (Blueprint $table) {
            // Ubah kolom status menjadi ENUM
            $table->enum('status', ['aktif', 'nonaktif'])->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            // Kembalikan tipe data ke tipe asli jika diperlukan, misalnya string
            $table->string('status')->change();
        });

        Schema::table('kepmen_db', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
}
