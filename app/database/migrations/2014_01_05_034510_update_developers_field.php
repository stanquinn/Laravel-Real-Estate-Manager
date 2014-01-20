<?php

use Illuminate\Database\Migrations\Migration;

class UpdateDevelopersField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('developers', function($table)
        {
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
        Schema::drop('developers');
    }

}