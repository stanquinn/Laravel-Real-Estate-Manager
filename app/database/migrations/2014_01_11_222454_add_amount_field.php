<?php

use Illuminate\Database\Migrations\Migration;

class AddAmountField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('transactions', function($table)
        {
            $table->string('firstname');
            $table->string('lastname');
            $table->string('contact_number');
            $table->string('address');
            $table->string('email');
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
		Schema::drop('transactions');
	}

}