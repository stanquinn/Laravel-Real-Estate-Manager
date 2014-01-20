<?php

use Illuminate\Database\Migrations\Migration;

class AddPropertyField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('properties',function($table){

            $table->integer('developer_id')->unsigned();
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