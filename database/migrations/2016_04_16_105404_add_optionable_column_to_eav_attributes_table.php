<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionableColumnToEavAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(eav_table('attributes'), function ($table) {
            $table->boolean('optionable')->default(false);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(eav_table('attributes'), function ($table) {
            $table->dropColumn('optionable');
        });
    }
}
