<?php
    
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKepmenTableAllowNullSk extends Migration
{
    public function up()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            $table->text('SK')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('kepmen', function (Blueprint $table) {
            $table->text('SK')->change();
        });
    }
}