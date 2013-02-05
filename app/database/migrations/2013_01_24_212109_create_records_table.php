<?php

use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function($table)
        {
            $table->increments('id');
            $table->integer('stage_id');
            $table->integer('vehicle_id');
            $table->integer('player_id');
            $table->integer('meters');
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
        Schema::drop('records');
    }

}
