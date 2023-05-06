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
        Schema::create('app_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('product_id');
            $table->uuid('ingredient_id');
            $table->dateTime('timestamp');
            $table->string('status_halal', 32);
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
        Schema::dropIfExists('app_histories');
    }
};
