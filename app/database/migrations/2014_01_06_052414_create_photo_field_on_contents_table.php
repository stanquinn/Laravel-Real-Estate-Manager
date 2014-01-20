<?php

use Illuminate\Database\Migrations\Migration;

class CreatePhotoFieldOnContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::table('posts',function($table){
           $table->text('photo',250);
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
        Schema::drop('posts');
	}

}