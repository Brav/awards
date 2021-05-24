<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolesToAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->json('roles')
                ->nullable()
                ->default(null)
                ->after('period_type');

            $table->json('roles_can_access_for_nomination')
                ->nullable()
                ->default(null)
                ->after('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->dropColumn('roles');
            $table->dropColumn('roles_can_access_for_nomination');
        });
    }
}
