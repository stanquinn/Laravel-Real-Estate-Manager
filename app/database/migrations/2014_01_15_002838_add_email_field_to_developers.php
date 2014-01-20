<?php

use Illuminate\Database\Migrations\Migration;

class AddEmailFieldToDevelopers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('developers',function($table){
			$table->string('email',60);
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
		Schema::drop('developers');
	}

}