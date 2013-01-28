<?php

use Illuminate\Database\Migrations\Migration;

class RemoveTimestamps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('players', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('stages', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('vehicles', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('records', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('players', function($table)
        {
            $table->timestamps();
        });

        Schema::table('stages', function($table)
        {
            $table->timestamps();
        });

        Schema::table('vehicles', function($table)
        {
            $table->timestamps();
        });

        Schema::table('records', function($table)
        {
            $table->timestamps();
        });
	}

}
