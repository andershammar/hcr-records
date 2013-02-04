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
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('stages', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('vehicles', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('records', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
