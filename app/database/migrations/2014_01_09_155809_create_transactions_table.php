<?php

use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('transactions', function($table)
        {
			$table->increments('id');
			$table->string('reference_number');
			$table->unique('reference_number');
			$table->integer('property_id');
			$table->integer('reservation_id');
			$table->enum('status',array('Paid','Pending','Cancelled'));
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
		Schema:drop('transactions');
	}

}