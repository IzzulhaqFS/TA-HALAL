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
        Schema::create('screening_hewani', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk', 200);
            $table->string('jenis_bahan', 200);
            $table->string('nama_hewan', 200);
            $table->boolean('hewan_halal');
            $table->boolean('sembelih_syariat');
            $table->boolean('pengolahan_lanjutan');
            $table->string('halal');
            $table->foreignUuid('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('screening_hewani');
    }
};
