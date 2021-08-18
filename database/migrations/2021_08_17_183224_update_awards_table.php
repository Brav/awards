<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $awards = DB::table('awards')->get();

        Schema::table('awards', function (Blueprint $table) {
            $table->dropColumn('background');
        });

        Schema::table('awards', function (Blueprint $table) {
            $table->json('background')->after('description');
        });

        foreach ($awards as $award)
        {
            $data = [
                'award'  => $award->background,
                'winner' => null,
            ];
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('awards', function (Blueprint $table) {
            //
        });
    }
}
