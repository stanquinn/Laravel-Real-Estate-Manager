<?php

use Illuminate\Database\Migrations\Migration;

class AlterPriceField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('properties', function($table)
        {
            $table->dropColumn('amount');
            $table->decimal('price', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('properties');
    }

}
