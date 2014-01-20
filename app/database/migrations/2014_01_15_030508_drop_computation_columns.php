<?php

use Illuminate\Database\Migrations\Migration;

class DropComputationColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('reservations', function($table)
		{
		    $table->dropColumn('reservation_fee');
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
		Schema::drop('reservations');
	}

}