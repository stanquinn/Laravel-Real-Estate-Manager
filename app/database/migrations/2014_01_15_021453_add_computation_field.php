<?php

use Illuminate\Database\Migrations\Migration;

class AddComputationField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('properties',function($table){
			$table->text('computation');
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