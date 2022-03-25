<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupportOfficeFieldToAwardNominationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('award_nominations', function (Blueprint $table) {
            $table->tinyInteger('support_office_value')
                ->nullable()
                ->after('nominee');

            $table->text('support_office_description')->after('support_office_value');
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
            $table->dropColumn('support_office_value');
            $table->dropColumn('support_office_description');
        });
    }
}
