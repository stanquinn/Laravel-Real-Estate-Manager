<?php

use Illuminate\Database\Migrations\Migration;

class DropCreatedColumnProperties extends Migration {

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
            $table->dropColumn('created');
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