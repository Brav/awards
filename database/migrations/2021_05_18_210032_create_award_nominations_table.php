<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_nominations', function (Blueprint $table) {
            $table->id();
            $table->string('member_logged');
            $table->string('member_logged_email');
            $table->string('nominee');
            $table->json('options');
            $table->json('fields');
            $table->unsignedBigInteger('award_id');
            $table->unsignedBigInteger('clinic_id')->nullable()->default(null);
            $table->unsignedBigInteger('department_id')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('award_id')->references('id')->on('awards');
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('award_nominations', function (Blueprint $table) {
            $table->dropForeign(['award_id', 'clinic_id', 'department_id']);
        });

        Schema::dropIfExists('award_nominations');
    }
}
