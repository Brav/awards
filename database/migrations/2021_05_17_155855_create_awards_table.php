<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('options');
            $table->json('fields');
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('order')->default(0);
            $table->boolean('always_visible')->nullable()->default(false);
            $table->tinyInteger('period_type');
            $table->dateTime('starting_at')->nullable()->default(null);
            $table->dateTime('ending_at')->nullable()->default(null);
            $table->softDeletes();
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
        Schema::dropIfExists('awards');
    }
}
