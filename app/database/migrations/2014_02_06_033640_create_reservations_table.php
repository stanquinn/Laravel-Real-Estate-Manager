<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('property_id');
			$table->integer('agent_id');
			$table->integer('user_id');
			$table->string('terms');
			$table->string('unit_type');
			$table->integer('total_contract_price');
			$table->integer('downpayment');
			$table->integer('reservation_fee');
			$table->decimal('equity');
			$table->integer('total_months');
			$table->datetime('deleted_at')->nullable();
			$table->decimal('monthly_fee');
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
		Schema::drop('reservations');
	}

}
