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
        Schema::create('screening_nabati', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk', 200);
            $table->string('nama_bahan', 200);
            $table->boolean('tidak_diolah');
            $table->boolean('mikrobial');
            $table->boolean('alkohol');
            $table->boolean('bahan_penolong');
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
        Schema::dropIfExists('screening_nabati');
    }
};
