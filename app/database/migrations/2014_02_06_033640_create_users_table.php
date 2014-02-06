<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email', 255);
			$table->string('password', 255);
			$table->text('permissions')->nullable();
			$table->boolean('activated');
			$table->string('activation_code', 255)->nullable();
			$table->datetime('activated_at')->nullable();
			$table->datetime('last_login')->nullable();
			$table->string('persist_code', 255)->nullable();
			$table->string('reset_password_code', 255)->nullable();
			$table->string('first_name', 255)->nullable();
			$table->string('last_name', 255)->nullable();
			$table->string('tin_number', 255);
			$table->string('landline', 255);
			$table->string('mobile', 255);
			$table->string('work_address', 255);
			$table->string('home_address', 255);
			$table->string('company', 255);
			$table->string('occupation', 255);
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
		Schema::drop('users');
	}

}
