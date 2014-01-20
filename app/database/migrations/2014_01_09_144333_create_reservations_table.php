<?php

use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('reservations',function($table){
			$table->increments('id');
			$table->integer('property_id')->unsigned();
			$table->string('firstname',60);
			$table->string('lastname',60);
			$table->string('home_address',250);
			$table->string('work_address',250);
			$table->string('phone',12);
			$table->string('mobile',12);
			$table->string('email',60);
			$table->string('work',60);
			$table->string('tin_number',60);
			$table->string('company',60);
			$table->enum('terms', array('cash', 'installment','pagibig','in-house'));
			$table->enum('unit_type', array('lot','house and lot'));
			$table->timestamps();
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