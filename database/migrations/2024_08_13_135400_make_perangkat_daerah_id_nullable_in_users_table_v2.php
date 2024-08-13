<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePerangkatDaerahIdNullableInUsersTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom perangkat_daerah_id agar nullable
            $table->unsignedBigInteger('perangkat_daerah_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom perangkat_daerah_id menjadi tidak nullable
            $table->unsignedBigInteger('perangkat_daerah_id')->nullable(false)->change();
        });
    }
}