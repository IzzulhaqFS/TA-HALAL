<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 200);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('gender', 10);
            $table->string('phone', 100);
            $table->string('id_card');
            $table->string('umkm_id', 100)->nullable();
            $table->string('umkm_name', 100);
            $table->string('umkm_address', 200)->nullable();
            $table->string('umkm_city', 100)->nullable();
            $table->string('umkm_country', 100)->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
