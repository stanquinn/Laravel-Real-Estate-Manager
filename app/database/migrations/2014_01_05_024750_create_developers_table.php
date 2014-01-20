<?php

use Illuminate\Database\Migrations\Migration;

class CreateDevelopersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('developers', function($table)
        {
            $table->increments('id');
            $table->string('name');
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