<?php

use Illuminate\Database\Migrations\Migration;

class AddTimestamps extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

        DB::update('UPDATE players SET created_at = ?, updated_at = ?', [
            new \DateTime('2013-02-01 08:00:00'), new \DateTime('2013-02-01 08:00:00')]);

        DB::update('UPDATE stages SET created_at = ?, updated_at = ?', [
            new \DateTime('2013-02-01 08:00:00'), new \DateTime('2013-02-01 08:00:00')]);

        DB::update('UPDATE vehicles SET created_at = ?, updated_at = ?', [
            new \DateTime('2013-02-01 08:00:00'), new \DateTime('2013-02-01 08:00:00')]);

        DB::update('UPDATE records SET created_at = ?, updated_at = ?', [
            new \DateTime('2013-02-01 08:00:00'), new \DateTime('2013-02-01 08:00:00')]);
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

}