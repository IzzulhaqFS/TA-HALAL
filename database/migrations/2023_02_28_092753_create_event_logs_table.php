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
        Schema::create('event_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('code')->unique();
            $table->text('activity');
            $table->string('status_halal', 20);
            $table->dateTime('timestamp');
            $table->foreignUuid('ingredient_id')->constrained('ingredients')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->uuid('user_id');
            $table->uuid('product_id');
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
        Schema::dropIfExists('event_logs');
    }
};
