<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('posts',function($table){
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->enum('post_type', array('page', 'news'));
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
        Schema::drop('posts');
	}

}