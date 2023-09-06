<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGraduatedYearColumnToAwardNominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('award_nominations', function (Blueprint $table) {
            $table->smallInteger('graduated_year')
                ->after("fields")
                ->nullable()
                ->default(null);
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
            $table->dropColumn('graduated_year');
        });
    }
}
