<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('location_id');
			$table->integer('type_id');
			$table->integer('developer_id');
			$table->string('model_number', 50);
			$table->string('name', 50);
			$table->text('description');
			$table->integer('beds');
			$table->integer('baths');
			$table->integer('floor_area');
			$table->integer('lot_area');
			$table->text('map');
			$table->string('block', 50);
			$table->string('lot', 50);
			$table->integer('reservation_fee');
			$table->boolean('status');
			$table->integer('price');
			$table->text('computation');
			$table->datetime('deleted_at')->nullable();
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
		Schema::drop('properties');
	}

}
