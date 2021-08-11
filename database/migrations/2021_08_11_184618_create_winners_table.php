<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('reason');
            $table->string('clinic')->nullable()->default(null);
            $table->string('award')->nullable()->default(null);
            $table->tinyInteger('order')->default(1);
            $table->unsignedBigInteger('award_nomination_id');
            $table->unsignedBigInteger('clinic_id');
            $table->timestamps();

            $table->foreign('award_nomination_id')->references('id')->on('award_nominations');
            $table->foreign('clinic_id')->references('id')->on('clinics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->dropForeign(['award_nomination_id',]);
            $table->dropForeign(['clinic_id',]);
        });

        Schema::dropIfExists('winners');
    }
}
