use Illuminate\Database\Migrations\Migration;
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->unsignedBigInteger('perangkat_daerah_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Foreign key untuk perangkat_daerah
            $table->foreign('perangkat_daerah_id')->references('id')->on('perangkat_daerah')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
