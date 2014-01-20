<?php

use Illuminate\Database\Migrations\Migration;

class UpdatePropertiesFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('properties', function($table)
        {
            $table->dropColumn('price');
            $table->decimal('price', 5, 2);
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
        Schema::drop('properties');
	}

}