<?php

use Illuminate\Database\Migrations\Migration;

class AddFieldsReservations extends Migration {

	public function up()
	{
		//
		Schema::table('reservations',function($table){
			$table->integer('total_contract_price',0);
			$table->integer('equity',0);
			$table->integer('reservation_fee',0);
			$table->integer('loanable_amount',0);
			$table->integer('downpayment',0);
			$table->integer('number_of_months',0);
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